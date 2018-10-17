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
use Cake\Event\Event;
use Cake\I18n\Time;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AjaxController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */    
    public function initialize()
    {
        // prevent direct access to this methods
        // if ( !$this->request->is('ajax') ) exit(0);
        //
        $this->autoRender = false; 
        $this->viewBuilder()->setLayout("ajax");
        $this->response->withType('application/json'); 
    }

    /**
     * delete elements from an array.
     *
     * Use this method to delete a list of index from an array
     *
     *
     * @return array
     */
    public function arrayUnset( $array, $remove ){
        foreach( $remove as $key ){
            unset( $array[$key]);
        }
        return $array;
    }

    /*
    ============================================================================================
        LOGIN METHODS
    ============================================================================================
    */

    public function login(){
        $result = 0;
        // request email and pass from form
        $email = $this->request->getData('email');
        $pass = $this->request->getData('pass');
        // retrieve user and pass by email from db
        if( ! empty($pass) && !empty($email) ){
            $data = $this->loadModel('users')->getCredentialsByEmail($email);
        }
        /* 
            login logic - if a pass and email came from the ajax and the 
            query found something in database, check if status != 0. when
            a user status is 0, it means that user is unable to login. if
            status ok, lets hash,
        */
        if( ! empty($data) && $data['status'] != 0 ){
            // hash the form pass
            $pass = Security::hash( $pass, 'sha1', true );
            // compare
            if( $pass == $data['pass'] ){
                // opens the admin data ( contains user id, status, email, pass hashed )
                $this->getRequest()->getSession()->write( 'Admin.data', $data );
                $result = 1;
            }
        }
        // output the login $result status
        // 0 - user or password incorrect
        // 1 - logged
        echo json_encode($result);
    }

    /*
    ============================================================================================
        JOIN US
    ============================================================================================
    */

    public function joinUs(){
        $data = $this->request->getData();
        $users_model = $this->loadModel('users');
        /* no data */
        if( empty($data["first_name"]) || empty($data["last_name"]) || empty($data["email"]) || empty($data["pass"]) ){
            $response = [
                "status" => false,// true or false
                "message" => ! empty( $error ) ? $error : "Os dados não foram completamente preenchidos."
            ];
            $this->response = $this->response->withStringBody( json_encode($response) );
            return;
        }
        /* differ pass */
        if( $data["pass"] != $data["pass_confirm"] ){
            $response = [
                "status" => false,// true or false
                "message" => ! empty( $error ) ? $error : "As senhas digitadas não conferem."
            ];
            $this->response = $this->response->withStringBody( json_encode($response) );
            return;
        }        
        /* dont create if the email already exists */
        if( ! empty($data['email']) && $users_model->exists(['email' => $data['email'] ]) ){
            $response = [
                "status" => false,// true or false
                "message" => ! empty( $error ) ? $error : "Seu e-mail já está cadastrado em nosso banco de dados."
            ];
            $this->response = $this->response->withStringBody( json_encode($response) );
            return;
        }
        // creates a new user
        $new_user = $users_model->newEntity();
        // new user data
        $new_user->status = 1;
        $new_user->created = Time::now();
        $new_user->role = "author";
        $new_user->first_name = $data["first_name"];
        $new_user->last_name = $data["last_name"];
        $new_user->email = $data["email"];
        $new_user->pass = Security::hash( $data['pass'], 'sha1', true );
        // saves the new user on db and retrive its created id
        $new_user_created = $users_model->save($new_user);
        // sends the e-mail
        try{
            $this->loadComponent("apMail")->newUserEmail( [ $data["email"] ], $data["pass"] );
        } catch(\Exception $e){
            $response = [
                "status" => false,// true or false
                "message" => ! empty( $error ) ? $error : "Sua conta não foi criada pois não conseguimos contacta-lo no e-mail fornecido."
            ];
            $this->response = $this->response->withStringBody( json_encode($response) );
            return;
        }
        // result
        $response = [
            "status" => true,// true or false
            "message" => ! empty( $error ) ? $error : "Seu dados foram cadastrados com sucesso. Um e-mail lhe foi enviado contendo maiores informações."
        ];
        //
        $this->response = $this->response->withStringBody( json_encode($response) );
    }    


    /*
    ============================================================================================
        DATA METHODS
    ============================================================================================
    */

    public function getAuthorBasicInfoById(){
        $id = $this->request->getData('id');
        $data = $this->loadModel('authors')->getDataById($id);
        $data = json_decode($data,true);
        // remove non front end useful data
        $data = $this->arrayUnset( $data, [
            'author_created',
            'author_email',
            'author_modified',
            'author_options',
            'author_status'
        ]);
        //
        echo json_encode($data);
    }

    public function getBooks(){        

        // components
        $this->loadComponent('Paginator');
        
        // request and model data
        $params = $this->request->getQuery();
        $books = $this->loadModel("books")->listAllAvailableWith( $params );

        // paginate the results
        $page = isset($params["page"]) & !empty($params["page"]) ? $params["page"] : 1;

        $paginate = [
            'limit' => 15,
            'page' => $page,
            'order' => [
                'books.created' => 'DESC'
            ]
        ];

        // return results
        $data["books"] = $this->paginate( $books, $paginate );
        $data["pages"] = $this->request->getParam(['paging']);
        $this->response = $this->response->withStringbody( json_encode($data) );
    }

    public function getBookByAsbn( $asbn ){
        $book = $this->loadModel("books")->listAllAvailableWithByAsbn( $asbn );
        $data = $book;
        $this->response = $this->response->withStringbody( json_encode($data) );
    }

    public function subscribe(){
        $data = $this->request->getData();
        $error = false;
        // subscribings
        try{
            $this->loadModel("subscribers")->subscribe($data["email"]);
        } catch(\Exception $e){
            $error = $e->getMessage();
        }    
        // sends the e-mail about the newslitter applying
        try{
            $this->loadComponent ("apMail")->newSub([ $data["email"] ]);
        } catch(\Exception $e){
            $error = $e->getMessage();
        }        
        $response = [
            "status" => true,// true or false
            "message" => ! empty( $error ) ? $error : "Inscrição efetuada com sucesso"
        ];
        $this->response = $this->response->withStringbody( json_encode($response) );
    }

    public function contactEmail(){
        $data = $this->request->getData();
        $error = "";
        // sends an appaloosa data email
        $this->loadComponent("apMail");
        // sends the e-mail about the newslitter applying
        try{
            $this->loadComponent ("apMail")->contactEmail( $data );
        } catch(\Exception $e){
            $error = $e->getMessage();
        }        
        //
        $response = [
            "status" => true,
            "message" => ! empty( $error ) ? $error : "Mensagem enviada com sucesso"
        ];
        $this->response = $this->response->withStringbody( json_encode($response) );
    }

    public function authorEmail(){
        $data = $this->request->getData();
        $error = "";
        //
        try{
            $this->loadComponent ("apMail")->authorEmail( $data );
        } catch(\Exception $e){
            $error = $e->getMessage();
        }        
        //
        $response = [
            "status" => true,
            "message" => ! empty( $error ) ? $error : "Mensagem enviada com sucesso"
        ];
        $this->response = $this->response->withStringbody( json_encode($response) );
    }

    public function getAuthorsNameList(){
        $data = $this->loadModel("authors")->getAuthorsNameList();
        $this->response = $this->response->withStringbody( json_encode($data) );
    }

    public function getBestSellers(){
        $this->loadModel("books");
        $books = $this->books->getBestSellers();
        $data = [
            "books" => $books,
        ];
        $this->response = $this->response->withStringBody( json_encode($data) );
    }

    public function increaseBookView( $asbn ){
        $this->loadModel("books")->incView($asbn);
    }
}
