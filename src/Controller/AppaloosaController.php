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

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

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

    }

    public function uiKit(){

    }

    public function info(){
        
        $partners = [
            
            0 => [
                "name" => "Bruno Ribeiro",
                "image" => "brunoribeiro.jpg",
                "task" => "Escritor, editor e reviewer",
                "about" => "Bruno Ribeiro, nasceu em julho de 1989, é mineiro radicado na Paraíba, com tiques argentinos. Graduado em publicidade & propaganda e mestre em Escrita Criativa pela Universidad Nacional de Tres de Febrero, de Buenos Aires, Bruno escreve, traduz, roteiriza, bagunça e experimenta. Publicou em jornais, revistas, blogues, livros e antologias mundo afora.",
                "link" => "",
            ],
            1 => [
                "name" => "Ítalo Lima",
                "image" => "italolima.jpg",
                "task" => "Escritor e conteudista",
                "about" => "Ítalo Lima nasceu em Teresina/PI. Formado em Publicidade e Propaganda e cheio de inquietações na pele. Poeta em estado constante de aflição. Em 2014 criou o projeto no Instagram (@italolimapoesias) onde vende poesia em moldura e até hoje vem curando a solidão através de quadros poéticos. Da solidão ao erotismo, Itálo escreveu 'Quando a gente se mata numa poesia', lançado em 2017, na Bienal do livro, no Rio de Janeiro.",
                "link" => "",
            ],

        ];

        $this->set( "partners", $partners );
    }

    public function unsubscribe(){
        $email = $this->request->getQuery("email");
        if( empty($email) ) $this->redirect(["controller"=>"appaloosa", "action"=>"index"]);
        $this->loadModel("subscribers")->unsubscribe($email);
    }

    public function join(){
        
    }

    public function terms(){
        
    }

    public function magazine(){
        $this->redirect("http://appaloosabooks.com/magazine/");
    }
}
