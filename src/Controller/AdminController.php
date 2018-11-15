<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Utility\Security;
use Cake\ORM\Table;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\I18n\Number;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AdminController extends Controller
{

    public $helpers = array("Form", "Html");

    // =================================================================================
    // Inits and checks
    // =================================================================================

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent("Flash");
        $this->viewBuilder()->setLayout("admin");
    }
    
    protected function checkAdmin(){
        /*
            Reads the Admin.data session data. if there is a session, brings
            all user data from the db and put in the $admin_data. if has no
            session, goes to the login screen
        */
        $admin_session = $this->getRequest()->getSession()->read('Admin.data');
        if( ! $admin_session ){
            $this->redirect(array('controller'=>'admin', 'action'=>'login'));
        } else {
            // if logged, put the user complete data fron db to admin_data and current session
            // this keeps the data in view always updated with the last changes maded by user
            $admin_data = $this->loadModel("users")->getAllUserDataById( $admin_session['id'] );
            $this->getRequest()->getSession()->write( 'Admin.data', $admin_data );
            // send the data to view and return it to be used in other methods       
            $this->set("admin_data", $admin_data);
            return $admin_data;
        }
    }

    // =================================================================================
    // Login Logout
    // =================================================================================

    public function index(){
        $admin_data = $this->checkAdmin();
        $books_count = str_replace( ",", ".", Number::precision($this->loadModel("books")->getBooksCount(), 0) );
        $this->set( "books_count", $books_count );
    }

    public function login(){
        // if already logged, goes to admin - this method prevents too many redirections
        $admin_data = $this->getRequest()->getSession()->read('Admin.data');
        if( ! empty($admin_data) ){
            $this->redirect(array('controller'=>'admin', 'action'=>'index'));
        } else {
            $this->viewBuilder()->setLayout(false);
        }
    }

    public function logout(){
        $this->render(false);
        $this->getRequest()->getSession()->delete('Admin.data');
        $this->redirect(array('controller'=>'appaloosa', 'action'=>'index'));
    }

    // =================================================================================
    // Pages
    // =================================================================================

    public function myaccount(){
        $admin_data = $this->checkAdmin();
        if ($this->request->is('post')) {
            $errors = [];
            $form_data = $this->request->getData();
            /* 
                EMAIL AND PASS

                if a email and password field is in the form_data, the data came from de login form
                so, its a request to change email or password. if there is no email and password field,
                its another type of post. this action takes separated forms for any kind of information
                to handle with sensitive info like pass and email, or binary info as profile image. 
                dont take this view as a paramether to construct other simple form views, 
                prefere authors view as a reference.
            */
            if( isset($form_data['email']) && isset($form_data['pass']) ){
                /* encry pass if changed */
                if( ! empty( $form_data['pass'] ) ){
                    if( strlen($form_data['pass']) < 8 ){
                        $this->Flash->error("Sua nova senha deve conter 8 (oito) caracteres no mínimo");
                        return null;
                    }
                    $plain_pass = $form_data['pass'];                    
                    $form_data['pass'] = Security::hash($form_data['pass'],'sha1',true);
                } else {
                    /* remove unmodified keys before send query */
                    unset($form_data['pass']);
                }
                /* check if email has changed */
                if( $form_data['email'] == $admin_data['email'] || empty($form_data['email']) ){
                    unset($form_data['email']);
                }
                /* just refresh if has no changes */
                if( empty($form_data) ){
                    $this->redirect(['controller'=>'admin','action'=>'myaccount']);    
                    return null;
                }
                /* dont change if the email already exists */
                if( isset($form_data['email']) && $this->loadModel('users')->exists(['email' => $form_data['email'] ]) ){
                    $this->Flash->error("Este e-mail já existe em nosso banco de dados");
                    return null;
                }
                /* stores the modified date */
                $form_data['modified'] = Time::now();                
                /* 
                    send email about info change (email or pass); 
                    if cant, is an invalid new email, abort process
                */
                try{
                    $this->loadComponent("apMail")
                         ->accountChange([(isset( $form_data["email"] ) ? $form_data["email"] : "")], 
                                        (isset( $form_data["email"] ) ? $form_data["email"] : ""), 
                                        (isset( $plain_pass ) ? $plain_pass : "") 
                    );
                } catch(\Exception $e){
                    $this->Flash->error("Novo E-mail : Erro : ".$e->getMessage());
                    return null;   
                }
                /*
                    if changed try to warn the old email 
                    if cant, continue process, but warn user
                */
                try{
                    $this->loadComponent("apMail")
                         ->accountChange([(isset( $admin_data["email"] ) ? $admin_data["email"] : "")], 
                                        (isset( $form_data["email"] ) ? $form_data["email"] : ""), 
                                        (isset( $plain_pass ) ? $plain_pass : "") 
                    );
                } catch(\Exception $e) {
                    $this->Flash->error("E-mail antigo : Erro : ".$e->getMessage());
                }
                /* save the info on the database */
                $this->loadModel("users")->updateUserData( $form_data, $admin_data['id']);
                // refresh after update the table
                $this->getRequest()->getSession()->delete('Admin.data');
                $this->redirect(['controller'=>'admin','action'=>'login']);
            } else {
                /* 
                    USER INFORMATION

                    1. stores upload image data in the toUpload var to pass to upload function
                    2. get the form file extension to mount the new name
                    3. create a name with user_id.file_extension
                    4. set the new name $filename as the image name to be saved at db
                    5. call the upload with $toUpload file info, asking to renamte to $filename
                    6. if all gone right, the file will be uploaded and new name saved at db
                    7. if something gone wrong, an error will be raised, neither post or upload will finish
                */
                if( !empty($form_data['image']['name']) ){
                    $toUpload = $form_data['image'];
                    $extension = pathinfo( $form_data['image']['name'], PATHINFO_EXTENSION );
                    $filename = $admin_data['id'] . "." . $extension;        
                    $form_data['image'] = $filename;
                    // save the profile img with id as name, if ! raise an error
                    if( ! $this->loadComponent("upload")->uploadFile( $toUpload, "admin_root/img/ups/avatars", 1000000, $filename )){
                        $errors[] = "Erro ao carregar a imagem";
                    }
                } else {
                    $form_data['image'] = $admin_data['image'];
                }
                // stores the modified date
                $form_data['modified'] = Time::now();
                // parse the brazillian date to db date yyyy-mm-dd format
                $form_data['birth'] = \DateTime::createFromFormat('d-m-Y', str_replace("/","-",$form_data['birth']))->format('Y-m-d');
                // check errors. if had at least one, flash it and stop
                if(!empty($errors)){
                    foreach( $errors as $error ):
                        $this->Flash->error($error);
                    endforeach;
                    return null;
                }
                // save to database
                $this->loadModel("users")->updateUserData( $form_data, $admin_data['id']);
                // refresh the admin_data to get the new data
                $this->Flash->success("Dados salvos com sucesso");
                $admin_data = $this->checkAdmin();
            }
        }
    }

    public function author(){
        $admin_data = $this->checkAdmin();
        // check if a author profiles exists, if not creates one
        if( $admin_data && !$this->loadModel('authors')->exists([ 'author_id' => $admin_data['id'] ]) ){
            $this->Flash->success("Seu perfil de autor acaba de ser criado.");
            $this->loadModel('authors')->createAuthorProfile($admin_data['id']);
        }
        // if had changes in the author profile
        if ($this->request->is('post')) {
            $errors = [];            
            $form_data = $this->request->getData();
            // stores the modified date
            $form_data['author_modified'] = Time::now();
            // prepare the profile image if had
            if( !empty($form_data['author_image']['name']) ){
                $toUpload = $form_data['author_image'];
                $extension = pathinfo( $form_data['author_image']['name'], PATHINFO_EXTENSION );
                $filename = $admin_data['id'] . "." . $extension;        
                $form_data['author_image'] = $filename;
                // save the profile img with id as name, if ! raise an error
                if( ! $this->loadComponent("upload")->uploadFile( $toUpload, "freestore/avatars", 1000000, $filename )){
                    $errors[] = "Erro ao carregar a imagem";
                }
            } else {
                $form_data['author_image'] = $admin_data['author']['author_image'];
            }
            // prepare the links and options
            $form_data['author_links'] = json_encode( $form_data['author_links'] );
            $form_data['author_options'] = json_encode( $form_data['author_options'] );
            // send the changes to db
            $this->loadModel("authors")->updateAuthorData( $form_data, $admin_data['id'] );
            // refresh the admin_data to get the new data
            $this->Flash->success("Dados salvos com sucesso");
            $admin_data = $this->checkAdmin();
        }        
    }

    public function myBooks(){
        $admin_data = $this->checkAdmin();
    }

    // =================================================================================
    // Super User Views
    // =================================================================================

    public function newUser(){
        $admin_data = $this->checkAdmin();
        if( $admin_data['role'] != 'admin' ){
            $this->redirect([ 'controller' => 'appaloosa', 'action' => 'index' ]);
        }
        //
        if( $this->request->is("post") ){
            $data = $this->request->getData();
            /* dont change if the email already exists */
            if( ! empty($data['email']) && $this->loadModel('users')->exists(['email' => $data['email'] ]) ){
                $this->Flash->error("Este e-mail de Admin já existe em nosso banco de dados");
                return null;
            }
            /* dont change if author_email exists */
            if( ! empty($data['author_email']) && $this->loadModel('authors')->exists(['author_email' => $data['author_email'] ]) ){
                $this->Flash->error("Este e-mail de autor já existe em nosso banco de dados");
                return null;
            }                     
            // creates a new user
            $users_model = $this->loadModel('users');
            $new_user = $users_model->newEntity();
            // new user data
            $new_user->status = 1;
            $new_user->created = Time::now();
            $new_user->role = $data["role"];
            $new_user->first_name = $data["first_name"];
            $new_user->last_name = $data["last_name"];
            $new_user->email = $data["email"];
            $new_user->pass = Security::hash( $data['pass'], 'sha1', true );
            $new_user->birth = \DateTime::createFromFormat('d-m-Y', str_replace("/","-",$data['birth']))->format('Y-m-d');
            // saves the new user on db and retrive its created id
            // the last id will be the id of this account author profile
            $new_user_created = $users_model->save($new_user);
            $new_user_created_id = $new_user_created->id;
            // creates a new author 
            $authors_model = $this->loadModel('authors');
            $new_author = $authors_model->newEntity();
            // new author data
            $new_author->author_status = 1;
            $new_author->author_id = $new_user_created_id;
            $new_author->author_created = Time::now();
            $new_author->author_first_name = $data['author_first_name'];
            $new_author->author_last_name = $data['author_last_name'];
            $new_author->author_email = $data['author_email'];
            $new_author->author_about = $data['author_about'];
            $new_author->author_links = json_encode( $data['author_links'] );
            $new_author->author_options = json_encode( $data['author_options'] );
            // new author image handle, if cant, the default will be used
            if( !empty($data['author_image']['name']) ){
                $toUpload = $data['author_image'];
                $extension = pathinfo( $data['author_image']['name'], PATHINFO_EXTENSION );
                $filename = $new_user_created_id . "." . $extension;        
                $data['author_image'] = $filename;
                // save the profile img with id as name, if ! raise an warning
                // and the default image will be used by default
                if( ! $this->loadComponent("upload")->uploadFile( $toUpload, "freestore/avatars", 1000000, $filename )){
                    $warnings[] = "Autor Salvo, mas houve um erro ao carregar a imagem";
                    $new_author->author_image = "default.jpg";
                }
                // will send the new image name to author data on db
                $new_author->author_image = $filename;
            }
            // saves the author and clears the request using the redirect
            // the redirect will clear the form and all the request data
            $authors_model->save($new_author);
            $this->Flash->success("Os dados foram salvos com sucesso");
            return $this->redirect(['controller' => 'admin', 'action'=>'newuser']);
        }
    }

    public function newBook(){
        $admin_data = $this->checkAdmin();
        if( $admin_data['role'] != 'admin' ){
            $this->redirect([ 'controller' => 'appaloosa', 'action' => 'index' ]);
        }
        // get useful data
        $authors = $this->loadModel("authors")
            ->find()
            ->select(["author_id", "author_first_name", "author_last_name"])
            ->all();
        $this->set("authors", $authors);
        $reviewers = $this->loadModel("reviewers")
            ->find()
            ->select(["id", "name"])
            ->all();
        $this->set("reviewers", $reviewers);
        $genders = $this->loadModel("genders")
            ->find()
            ->select(["id", "name"])
            ->all();
        $this->set("genders", $genders);        
        // the post request
        if( $this->request->is("post") ){
            $books_model = $this->loadModel("books");
            $book_data = $this->request->getData();
            $new_book = $books_model->newEntity();
            //
            $new_book->title = $book_data["title"];
            $new_book->asbn = $book_data["asbn"];
            $new_book->gender_id = $book_data["gender_id"];
            $new_book->author_id = $book_data["author_id"];
            $new_book->status = $book_data["status"];
            //
            $new_book->description = $book_data["description"];
            $new_book->short_description = $book_data["short_description"];
            $new_book->reviewer_id = $book_data["reviewer_id"];
            $new_book->views = $book_data["views"];
            // dates
            if( $book_data["status"] == 1 ){
                $new_book->publish_date = Time::now();
            }
            $new_book->created = Time::now();
            $new_book->files = [];
            //$new_book->publish_date = $book_data['publish_date'] = \DateTime::createFromFormat('d-m-Y', str_replace("/","-",$book_data['publish_date']))->format('Y-m-d');
            // cover ----------
            if( !empty($book_data['cover']['name']) ){
                $toUpload = $book_data['cover'];
                $extension = pathinfo( $book_data['cover']['name'], PATHINFO_EXTENSION );
                $filename = $book_data["asbn"] . "." . $extension;        
                if( ! $this->loadComponent("upload")->uploadFile( $toUpload, "freestore/covers", 40194304, $filename )){
                    $warnings[] = "Autor Salvo, mas houve um erro ao carregar a imagem";
                    $new_book->cover = "default.jpg";
                }
                $new_book->cover = $filename;
            }            
            // files ----------
            $files = [];
            foreach( $book_data["files"] as $file => $key ){    
                if( !empty($book_data['files'][$file]['name']) ){
                    $toUpload = $book_data['files'][$file];
                    $extension = pathinfo( $book_data['files'][$file]['name'], PATHINFO_EXTENSION );
                    $filename = $book_data["asbn"] . "." . $extension;        
                    // saves the file on store - max 4MB
                    if( ! $this->loadComponent("upload")->uploadFile( $toUpload, "freestore/binaries", 40194304, $filename )){
                        $this->Flash->error("Erro ao salvar o arquivo : ".$filename);
                        return null;
                    }                    
                    $files[$file] = $filename; 
                }
            }
            $new_book->files = json_encode($files);
            // saves the whole thing
            $books_model->save($new_book);
            $this->Flash->success("Livro adicionado com sucesso");
            return $this->redirect(['controller' => 'admin', 'action'=>'newbook']);
        }
    }    

    public function allUsers( $action = "", $id = ""){
        $admin_data = $this->checkAdmin();
        if( $admin_data['role'] != 'admin' ){
            $this->redirect([ 'controller' => 'appaloosa', 'action' => 'index' ]);
        }
        // SEND COMMON DATA TO THE VIEW
        $users_model_data = $this->loadModel("users")->listAll();
        $this->set("users", $users_model_data);
        // EDIT ACTION
        if( $this->request->is("post") && $action=="edit" ){
            $users = $this->loadModel("users");
            $edit_data = $this->request->getData();
            if( $users->exists( ["id" => $edit_data["id"]] )){
                try{
                    $this->loadModel("users")->query()->update()
                    ->set($edit_data)
                    ->where(["id"=>$edit_data["id"]])
                    ->execute();
                    $this->Flash->success(" O Usuário ".$edit_data["first_name"]." ".$edit_data["last_name"]." foi editado");
                    $this->redirect(["controller"=>"admin", "action"=>"allusers"]);
                } catch(\Exception $e){
                    $this->Flash->error("Gênero não editado : Erro : ".$e->getMessage());
                    return null;  
                }
            } else {
                $this->Flash->error(" Gênero não encontrado '" . $edit_data['name'] . " : " . $edit_data["id"] );
            }
        }
        // DELETE ACTION
        if( $id && $action == "del" ){
            try{
                $users = $this->loadModel("users");
                $users->delete( $users->get($id) );
                $this->Flash->success(" O Usuário ".$id." foi deletado");
                $this->redirect(["controller"=>"admin", "action"=>"allusers"]);
            } catch(\Exception $e){
                $this->Flash->error("Campo não deletado : Erro : ".$e->getMessage());
                return null;  
            }
        }        
    }

    public function allbooks( $action = "", $id = "" ){
        $admin_data = $this->checkAdmin();
        if( $admin_data['role'] != 'admin' ){
            $this->redirect([ 'controller' => 'appaloosa', 'action' => 'index' ]);
        }
        // SEND COMMON DATA TO THE VIEW
        $books_model_data = $this->loadModel("books")->listAll();
        $this->set("books", $books_model_data);
        // get useful data
        $authors = $this->loadModel("authors")
            ->find()
            ->select(["author_id", "author_first_name", "author_last_name"])
            ->all();
        $this->set("authors", $authors);
        $reviewers = $this->loadModel("reviewers")
            ->find()
            ->select(["id", "name"])
            ->all();
        $this->set("reviewers", $reviewers);
        $genders = $this->loadModel("genders")
            ->find()
            ->select(["id", "name"])
            ->all();
        $this->set("genders", $genders);
        // EDIT ACTION
        if( $this->request->is("post") && $action=="edit" ){
            $books = $this->loadModel("books");
            $edit_data = $this->request->getData();
            if( $books->exists( ["id" => $edit_data["id"]] )){
                try{
                    $this->loadModel("books")->query()->update()
                    ->set($edit_data)
                    ->where(["id"=>$edit_data["id"]])
                    ->execute();
                    $this->Flash->success(" O livro '" . $edit_data['title'] . "' foi editado");
                    $this->redirect(["controller"=>"admin", "action"=>"allbooks"]);
                } catch(\Exception $e){
                    $this->Flash->error(" Livro não editado : Erro : ".$e->getMessage());
                    return null;  
                }
            } else {
                $this->Flash->error(" Livro não encontrado '" . $edit_data['title'] . " : " . $edit_data["id"] );
            }
        }
        // DELETE ACTION
        if( $id && $action == "del" ){
            try{
                $books = $this->loadModel("books");
                $books->delete( $books->get($id) );
                $this->Flash->success(" O book id : $id foi deletado");
                $this->redirect(["controller"=>"admin", "action"=>"allbooks"]);
            } catch(\Exception $e){
                $this->Flash->error("Campo não deletado : Erro : ".$e->getMessage());
                return null;  
            }
        }
    }

    public function reviewers( $action = "", $id = "" ){
        $admin_data = $this->checkAdmin();
        if( $admin_data['role'] != 'admin' ){
            $this->redirect([ 'controller' => 'appaloosa', 'action' => 'index' ]);
        }
        // SEND COMMON DATA TO THE VIEW
        $reviewers_model_data = $this->loadModel("reviewers")->listAll();
        $this->set("reviewers", $reviewers_model_data);
        // CREATE ACTION (default)
        if( $this->request->is("post") && ! $action ){
            $reviewers = $this->loadModel("reviewers");
            $new_reviewer = $this->request->getData();
            if( ! $reviewers->exists( ["name" => $new_reviewer["name"]] )){
                $new_reviewer = $reviewers->newEntity( $new_reviewer );
                $reviewers->save($new_reviewer);
                $this->Flash->success(" O Reviewer ". $new_reviewer["name"] ." foi criado");
                $this->redirect(["controller"=>"admin", "action"=>"reviewers"]);
            } else {
                $this->Flash->error(" O Reviewer '" . $new_reviewer['name'] . "' já existe");
            }
        }
        // EDIT ACTION
        if( $this->request->is("post") && $action=="edit" ){
            $reviewers = $this->loadModel("reviewers");
            $edit_data = $this->request->getData();
            if( $reviewers->exists( ["id" => $edit_data["id"]] )){
                try{
                    $this->loadModel("reviewers")->query()->update()
                    ->set($edit_data)
                    ->where(["id"=>$edit_data["id"]])
                    ->execute();
                    $this->Flash->success(" O Reviewer '" . $edit_data['name'] . "' foi editado");
                    $this->redirect(["controller"=>"admin", "action"=>"reviewers"]);
                } catch(\Exception $e){
                    $this->Flash->error("Reviewer não editado : Erro : ".$e->getMessage());
                    return null;  
                }
            } else {
                $this->Flash->error(" Reviewer não encontrado '" . $edit_data['name'] . " : " . $edit_data["id"] );
            }
        }
        // DELETE ACTION
        if( $id && $action == "del" ){
            try{
                $reviewers = $this->loadModel("reviewers");
                $reviewers->delete( $reviewers->get($id) );
                $this->Flash->success(" O Reviewer id : $id foi deletado");
                $this->redirect(["controller"=>"admin", "action"=>"reviewers"]);
            } catch(\Exception $e){
                $this->Flash->error("Campo não deletado : Erro : ".$e->getMessage());
                return null;  
            }
        }
    }

    public function genders( $action = "", $id = "" ){
        $admin_data = $this->checkAdmin();
        if( $admin_data['role'] != 'admin' ){
            $this->redirect([ 'controller' => 'appaloosa', 'action' => 'index' ]);
        }
        // SEND COMMON DATA TO THE VIEW
        $genders_model_data = $this->loadModel("genders")->listAll();
        $this->set("genders", $genders_model_data);
        // CREATE ACTION (default)
        if( $this->request->is("post") && ! $action ){
            $genders = $this->loadModel("genders");
            $new_gender = $this->request->getData();
            if( ! $genders->exists( ["name" => $new_gender["name"]] )){
                $new_gender = $genders->newEntity( $new_gender );
                $genders->save($new_gender);
                $this->Flash->success(" O Reviewer ". $new_gender["name"] ." foi criado");
                $this->redirect(["controller"=>"admin", "action"=>"genders"]);
            } else {
                $this->Flash->error(" O genêro '" . $new_gender['name'] . "' já existe");
            }
        }
        // EDIT ACTION
        if( $this->request->is("post") && $action=="edit" ){
            $genders = $this->loadModel("genders");
            $edit_data = $this->request->getData();
            if( $genders->exists( ["id" => $edit_data["id"]] )){
                try{
                    $this->loadModel("genders")->query()->update()
                    ->set($edit_data)
                    ->where(["id"=>$edit_data["id"]])
                    ->execute();
                    $this->Flash->success(" O Reviewer ". $edit_data["name"] ." foi editado");
                    $this->redirect(["controller"=>"admin", "action"=>"genders"]);
                } catch(\Exception $e){
                    $this->Flash->error("Gênero não editado : Erro : ".$e->getMessage());
                    return null;  
                }
            } else {
                $this->Flash->error(" Gênero não encontrado '" . $edit_data['name'] . " : " . $edit_data["id"] );
            }
        }
        // DELETE ACTION
        if( $id && $action == "del" ){
            try{
                $genders = $this->loadModel("genders");
                $genders->delete( $genders->get($id) );
                $this->Flash->success(" O Reviewer ". $id ." foi deletado");
                $this->redirect(["controller"=>"admin", "action"=>"genders"]);
            } catch(\Exception $e){
                $this->Flash->error("Campo não deletado : Erro : ".$e->getMessage());
                return null;  
            }
        }
    }  

    public function editUser( $id = null ){
        $admin_data = $this->checkAdmin();
        if( $admin_data['role'] != 'admin' || empty($id) ){
            $this->redirect([ 'controller' => 'admin', 'action' => 'allusers' ]);
        }
        // GET THE USER BY ID
        try{
            $user_data = $this->loadModel('users')->getAllUserDataById($id);
            $this->set("user_data", $user_data);
        } catch ( \Exception $e ){
            $this->redirect(['controller'=>'admin', 'action'=>'allusers']);
        }
        //
        if ($this->request->is('post')) {
            $errors = [];
            $form_data = $this->request->getData();
            /* 
                EMAIL AND PASS 
            */
            if( isset($form_data['email']) && isset($form_data['pass']) ){
                /* encry pass if changed */
                if( ! empty( $form_data['pass'] ) ){
                    if( strlen($form_data['pass']) < 8 ){
                        $this->Flash->error("Sua nova senha deve conter 8 (oito) caracteres no mínimo");
                        return null;
                    }
                    $plain_pass = $form_data['pass'];                    
                    $form_data['pass'] = Security::hash($form_data['pass'],'sha1',true);
                } else {
                    /* remove unmodified keys before send query */
                    unset($form_data['pass']);
                }
                /* check if email has changed */
                if( $form_data['email'] == $user_data['email'] || empty($form_data['email']) ){
                    unset($form_data['email']);
                }
                /* just refresh if has no changes */
                if( empty($form_data) ){
                    $this->redirect(['controller'=>'admin','action'=>'myaccount']);    
                    return null;
                }
                /* dont change if the email already exists */
                if( isset($form_data['email']) && $this->loadModel('users')->exists(['email' => $form_data['email'] ]) ){
                    $this->Flash->error("Este e-mail já existe em nosso banco de dados");
                    return null;
                }
                /* stores the modified date */
                $form_data['modified'] = Time::now();                
                /* 
                    send email about info change (email or pass); 
                    if cant, is an invalid new email, abort process
                */
                try{
                    $this->loadComponent("apMail")
                         ->accountChange([(isset( $form_data["email"] ) ? $form_data["email"] : "")], 
                                        (isset( $form_data["email"] ) ? $form_data["email"] : ""), 
                                        (isset( $plain_pass ) ? $plain_pass : "") 
                    );
                } catch(\Exception $e){
                    $this->Flash->error("Novo E-mail : Erro : ".$e->getMessage());
                    return null;   
                }
                /*
                    if changed try to warn the old email 
                    if cant, continue process, but warn user
                */
                try{
                    $this->loadComponent("apMail")
                         ->accountChange([(isset( $user_data["email"] ) ? $user_data["email"] : "")], 
                                        (isset( $form_data["email"] ) ? $form_data["email"] : ""), 
                                        (isset( $plain_pass ) ? $plain_pass : "") 
                    );
                } catch(\Exception $e) {
                    $this->Flash->error("E-mail antigo : Erro : ".$e->getMessage());
                }
                /* save the info on the database */
                $this->loadModel("users")->updateUserData( $form_data, $id);
                // refresh after update the table
                $this->getRequest()->getSession()->delete('Admin.data');
                $this->redirect(['controller'=>'admin','action'=>'login']);
            } else {
                /* 
                    USER INFORMATION
                */
                if( !empty($form_data['image']['name']) ){
                    $toUpload = $form_data['image'];
                    $extension = pathinfo( $form_data['image']['name'], PATHINFO_EXTENSION );
                    $filename = $id . "." . $extension;        
                    $form_data['image'] = $filename;
                    // save the profile img with id as name, if ! raise an error
                    if( ! $this->loadComponent("upload")->uploadFile( $toUpload, "admin_root/img/ups/avatars", 400000, $filename )){
                        $errors[] = "Erro ao carregar a imagem";
                    }
                } else {
                    $form_data['image'] = $user_data['image'];
                }
                // stores the modified date
                $form_data['modified'] = Time::now();
                // parse the brazillian date to db date yyyy-mm-dd format
                $form_data['birth'] = \DateTime::createFromFormat('d-m-Y', str_replace("/","-",$form_data['birth']))->format('Y-m-d');
                // check errors. if had at least one, flash it and stop
                if(!empty($errors)){
                    foreach( $errors as $error ):
                        $this->Flash->error($error);
                    endforeach;
                    return null;
                }
                // save to database
                $this->loadModel("users")->updateUserData( $form_data, $id);
                // refresh the user_data to get the new data
                $user_data = $this->checkAdmin();
            }
        }
    }

    public function editBook( $id ){
        $admin_data = $this->checkAdmin();
        if( $admin_data['role'] != 'admin' ){
            $this->redirect([ 'controller' => 'appaloosa', 'action' => 'index' ]);
        }
        // get useful data
        $authors = $this->loadModel("authors")
            ->find()
            ->select(["author_id", "author_first_name", "author_last_name"])
            ->all();
        $this->set("authors", $authors);
        $reviewers = $this->loadModel("reviewers")
            ->find()
            ->select(["id", "name"])
            ->all();
        $this->set("reviewers", $reviewers);
        $genders = $this->loadModel("genders")
            ->find()
            ->select(["id", "name"])
            ->all();
        $this->set("genders", $genders);        
        // GET THE USER BY ID
        try{
            $book_data = $this->loadModel('books')->getAllBookDataById($id);
            $this->set("book_data", $book_data);
        } catch ( \Exception $e ){
            $this->redirect(['controller'=>'admin', 'action'=>'allbooks']);
        }        
        // the post request
        if( $this->request->is("post") ){
            $form_data = $this->request->getData();
            // cover ----------
            if( !empty($form_data['cover']['name']) ){
                $toUpload = $form_data['cover'];
                $extension = pathinfo( $form_data['cover']['name'], PATHINFO_EXTENSION );
                $filename = $form_data["asbn"] . "." . $extension;        
                if( ! $this->loadComponent("upload")->uploadFile( $toUpload, "freestore/covers", 9194304, $filename )){
                    $warnings[] = "Autor Salvo, mas houve um erro ao carregar a imagem";
                    $form_data["cover"] = "default.jpg";
                }
                $form_data["cover"] = $filename;
            } else {
                unset($form_data["cover"]);
            }
            // files ----------
            $current_files = json_decode( $book_data["files"], true);
            foreach( $form_data["files"] as $file => $key ){    
                if( !empty($form_data['files'][$file]['name']) ){
                    $toUpload = $form_data['files'][$file];
                    $extension = pathinfo( $form_data['files'][$file]['name'], PATHINFO_EXTENSION );
                    $filename = $form_data["asbn"] . "." . $extension;        
                    // saves the file on store - max 4MB
                    if( ! $this->loadComponent("upload")->uploadFile( $toUpload, "freestore/binaries", 90194304, $filename )){
                        $this->Flash->error("Erro ao salvar o arquivo : ".$filename);
                        return null;
                    }
                    $current_files[$file] = $filename;
                }
            }
            $form_data["files"] = json_encode($current_files);
            // save to database
            $this->loadModel("books")->updateBookData( $form_data, $id );
            $this->Flash->success("Livro editado");
            $this->redirect(["controller"=>"admin", "action"=>"editbook/".$id]);
        }
    }  

    public function allauthors( $action="", $id="" ){

        $admin_data = $this->checkAdmin();
        if( $admin_data['role'] != 'admin' ){
            $this->redirect([ 'controller' => 'appaloosa', 'action' => 'index' ]);
        }
        // SEND COMMON DATA TO THE VIEW
        $authors_model_data = $this->loadModel("authors")->listAll();
        $this->set("authors", $authors_model_data);
        // EDIT ACTION
        if( $this->request->is("post") && $action=="edit" ){
            $authors = $this->loadModel("authors");
            $edit_data = $this->request->getData();
            if( $authors->exists( ["author_id" => $edit_data["author_id"]] )){
                try{
                    $this->loadModel("authors")->query()->update()
                    ->set($edit_data)
                    ->where(["author_id"=>$edit_data["author_id"]])
                    ->execute();
                    $this->Flash->success(" O Autor ". $edit_data["author_first_name"] . " " . $edit_data["author_last_name"] ." foi editado");
                    $this->redirect(["controller"=>"admin", "action"=>"allauthors"]);
                } catch(\Exception $e){
                    $this->Flash->error("Autor não editado : Erro : ".$e->getMessage());
                    return null;  
                }
            } else {
                $this->Flash->error(" Autor não encontrado '" . $edit_data['author_first_name'] . " " . $edit_data['author_last_name'] . " : " . $edit_data["author_id"] );
            }
        }
        // DELETE ACTION
        if( $id && $action == "del" ){
            try{
                $authors = $this->loadModel("authors");
                $authors->delete( $authors->get($id) );
                $this->Flash->success(" O autor ". $id ." foi deletado");
                $this->redirect(["controller"=>"admin", "action"=>"authors"]);
            } catch(\Exception $e){
                $this->Flash->error("Campo não deletado : Erro : ".$e->getMessage());
                return null;  
            }
        }
    }

    public function editauthor( $id = null ){
        $admin_data = $this->checkAdmin();
        if( $admin_data['role'] != 'admin' || empty($id) ){
            $this->redirect([ 'controller' => 'admin', 'action' => 'allauthors' ]);
        }
        // GET THE author BY ID
        try{
            $author_data = $this->loadModel('authors')->getAllauthorDataById($id);
            $this->set("author_data", $author_data);
        } catch ( \Exception $e ){
            $this->redirect(['controller'=>'admin', 'action'=>'allauthors']);
        }
        // if had changes in the author profile
        if ($this->request->is('post')) {
            $errors = [];            
            $form_data = $this->request->getData();
            // stores the modified date
            $form_data['author_modified'] = Time::now();
            // prepare the profile image if had
            if( !empty($form_data['author_image']['name']) ){
                $toUpload = $form_data['author_image'];
                $extension = pathinfo( $form_data['author_image']['name'], PATHINFO_EXTENSION );
                $filename = $id . "." . $extension;        
                $form_data['author_image'] = $filename;
                // save the profile img with id as name, if ! raise an error
                if( ! $this->loadComponent("upload")->uploadFile( $toUpload, "freestore/avatars", 400000, $filename )){
                    $errors[] = "Erro ao carregar a imagem";
                }
            } else {
                $form_data['author_image'] = $author_data['author_image'];
            }
            // prepare the links and options
            $form_data['author_links'] = json_encode( $form_data['author_links'] );
            $form_data['author_options'] = json_encode( $form_data['author_options'] );
            // send the changes to db
            $this->loadModel("authors")->updateAuthorData( $form_data, $id );
            $this->redirect(["controller"=>"admin", "action"=>"editauthor/".$id]);
        } 
    } 

    public function subscribers( $action = "", $id = "" ){
        $admin_data = $this->checkAdmin();
        if( $admin_data['role'] != 'admin' ){
            $this->redirect([ 'controller' => 'admin', 'action' => 'index' ]);
        }
        //
        // SEND COMMON DATA TO THE VIEW
        $subscriber_model_data = $this->loadModel("subscribers")->listAll();
        $this->set("subscribers", $subscriber_model_data);
        // EDIT ACTION
        if( $this->request->is("post") && $action=="edit" ){
            $subscriber = $this->loadModel("subscribers");
            $edit_data = $this->request->getData();
            if( $subscriber->exists( ["id" => $edit_data["id"]] )){
                try{
                    $this->loadModel("subscribers")->query()->update()
                    ->set($edit_data)
                    ->where(["id"=>$edit_data["id"]])
                    ->execute();
                    $this->Flash->success(" O Subscriber ". $edit_data["id"] ." foi editado");
                    $this->redirect(["controller"=>"admin", "action"=>"subscribers"]);
                } catch(\Exception $e){
                    $this->Flash->error("Subscriber não editado : Erro : ".$e->getMessage());
                    return null;  
                }
            } else {
                $this->Flash->error(" Subscriber não encontrado '" . $edit_data['id'] );
            }
        }
        // DELETE ACTION
        if( $id && $action == "del" ){
            try{
                $subscriber = $this->loadModel("subscribers");
                $subscriber->delete( $subscriber->get($id) );
                $this->Flash->success(" O Subscriber ". $id ." foi deletado");
                $this->redirect(["controller"=>"admin", "action"=>"subscribers"]);
            } catch(\Exception $e){
                $this->Flash->error("Campo não deletado : Erro : ".$e->getMessage());
                return null;  
            }
        }    
    } 

    public function analytics(){
        $admin_data = $this->checkAdmin();
        if( $admin_data['role'] != 'admin' ){
            $this->redirect([ 'controller' => 'appaloosa', 'action' => 'index' ]);
        }
    }  
}
