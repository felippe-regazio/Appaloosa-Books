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

use Cake\Routing\Router;
use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Utility\Text;
use Cake\Event\Event;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class AppaloosaController extends AppController
{

    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException Whesn the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function initialize(){
        $this->viewBuilder()->setLayout('default');    
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
    }

    public function index(){ 
        $this->set("title", "Appaloosa Books - Livros Independentes Online");
        // Metatags for a loaded Book
        if($this->request->getQuery("b")){
            $book = $this->loadModel('books')->getBookMetas($this->request->getQuery("b"));
            if( !empty($book) && $book['status'] == 1 ){
                $this->set('meta', $meta = [
                    "name" =>  "Appaloosa Books : " . $book["title"] . " - " . $book["author"]["author_first_name"]. " " . $book["author"]["author_last_name"],
                    "title" => "Appaloosa Books : " . $book["title"] . " - " . $book["author"]["author_first_name"]. " " . $book["author"]["author_last_name"],
                    "image" => Router::url("/", true) . "freestore/covers/" . $book["cover"],
                    "description" => Text::truncate( $book['description'], 250, ["ellipsis"=>"..."] )
                ]);
            } else {
                $this->set("booknotfound", true);
            }
        };
    }

    public function uiKit(){

    }

    public function info(){
        $this->set("title", "Appaloosa Books - Informações úteis");
    }

    public function unsubscribe(){
        $this->set("title", "Appaloosa Books - Unsubscribe");
        $email = $this->request->getQuery("email");
        if( empty($email) ) $this->redirect(["controller"=>"appaloosa", "action"=>"index"]);
        $this->loadModel("subscribers")->unsubscribe($email);
    }

    public function join(){
        $this->set("title", "Appaloosa Books - Quero fazer parte");
    }

    public function terms(){
        $this->set("title", "Appaloosa Books - Termos e condições");
    }
}
