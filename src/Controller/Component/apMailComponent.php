<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Mailer\Email;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;

/**
 * UploadFile component
 */
class apMailComponent extends Component{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    /* returns an Email object with basic conf */
    public function createEmail(){
        
        $Email = new Email();
        $Email->setEmailFormat('html')->setTemplate('default', 'fancy');
        $Email->setFrom([ AP_DELIVERY_EMAIL => "Appaloosa Books"]);      

        return $Email;
    }

    /* 
        sends an inform email 
    */
    public function inform( $dest = [], $message = "" ){

        $Email = $this->createEmail();
        $Email->setSubject("Informe");

        foreach( $dest as $to ){

            if( !empty($to) && !empty($message) ){

                $Email->setTo( $to );
                return $Email->send($message) ? true : false;
            }
        }
    }

    /* 
        sends a contact email 
    */
    public function contactEmail( $data ){

        $Email = $this->createEmail();
        $Email->setSubject( $data["subject"] );

        $message = $data["message"] . "<br/><br/>" . "Sender : " . $data["name"] . " - " . $data["email"];
        $dest = [ AP_CONTACT_EMAIL, $data["email"] ];

        foreach( $dest as $to ){

            if( !empty($to) && !empty($message) ){
                $Email->setTo( $to );
                $Email->send($message);
            }
        }
    }    

    /* 
        sends an author email 

        data = [
            name =>
            email =>
            message =>
            author_id => ];
    */
    public function authorEmail( $data ){

        $Email = $this->createEmail();
        $Email->setSubject( "Mensagem do Leitor/a" );

        $name  = isset( $data["name"] ) && $data["name"] != null ? $data["name"] : "Anônimo";
        $sender = isset( $data["email"] ) && $data["email"] != null ? $data["email"] : "Anônimo"; 

        $credits = "<br/><br/>Mensagem enviada por solicitação de: <br/>Nome: " . $name . " - Email: " . $sender;
        $message = "Mensagem enviada por um leitor/a sobre o livro: " . $data["book_name"] . ". <br/><br/> \"" . $data["message"] . "\"" . $credits;

        // envia uma copia do email para a Appaloosa e para o autor escolhido
        $author_data = TableRegistry::get("authors")->getAuthorEmailById( $data["author_id"] )[0];
        $author_email = $author_data["author_email"];
        $author_name = $author_data["author_first_name"] . " " . $author_data["author_last_name"];

        $dest = [ AP_CONTACT_EMAIL, $author_email ];

        foreach( $dest as $to ){

            if( !empty($to) && !empty($message) ){
                $Email->setTo( $to );
                $Email->send( $message );
            }
        }

        // caso nao seja anonimo, envia uma copia para o remetente

        if( !empty($sender) && $sender != "Anônimo" ){
            $Email->setTo( $sender );
            $Email->send( "A Appaloosa enviou sua mensagem para o autor/a " . $author_name . " com sucesso. Mensagem original :: <br/><br/>" . $message );            
        }
    }        

    /* 
        sends a new subscriber email 
    */
    public function newSub( $dest = [] ){


        $Email = $this->createEmail();
        $Email->setSubject("Bem vindo");

        foreach( $dest as $to ){
        
        $unsub = Router::url(["controller"=>"appaloosa", "action"=>"unsubscribe" . "?email=" . $to ], true);
        $message = "Bem vindo a Appaloosa! <br/><br/> Você agora está incrito em nossa Newletter. Obrigado e até breve! <br/><br/><br/><a href=" . $unsub . ">Clique aqui se deseja cancelar sua assinatura</a>";

            if( !empty($to) && !empty($message) ){
            
                $Email->setTo( $to );
                return $Email->send($message) ? true : false;
            }
        }
    }    

    /* 
        sends a new user email 
    */
    public function newUserEmail( $dest = [], $new_pass ){


        $Email = $this->createEmail();
        $Email->setSubject("Inscrição - Bem vindo");

        foreach( $dest as $to ){

            $message = "Bem vindo a Appaloosa! 
            Abaixo estão seus dados de acesso. Você agora deve seguir alguns passos para consolidar a sua inscrição:<br/> 
            
            ------------------------------
            Usuário: " . $to . "
            Senha: " . $new_pass . "
            ------------------------------
            
            1 . Acesse o endereço <a href='http://www.appaloosabooks.com/admin' target='_blank'>www.appaloosabooks.com/admin</a>
            2 . Após entrar com os seus novos dados, você deve preencher o seu perfil de usuário e autor no menu esquerdo.
            3 . Caso você esteja aguardando por uma publicação, assegure de ter preenchido seus dados de maneira apropriada.
            
            Estamos felizes de que você tenha entrado para o nosso time.
            Orgulhosamente __ Appaloosa Books.";

            if( !empty($to) && !empty($message) ){
                $Email->setTo( $to );
                return $Email->send($message) ? true : false;
            }
        }
    }    

    /* 
        sends a newsletter email 
    */
    public function Newsletter( $dest = [], $subject, $content ){

        $Email = $this->createEmail();
        $Email->setSubject( $subject );

        foreach( $dest as $to ){

            $unsub = Router::url(["controller"=>"appaloosa", "action"=>"unsubscribe" . "?email=" . $to ], true);
            $message = $content . "<br/><br/><br/><a href=" . $unsub . ">Clique aqui se deseja cancelar sua assinatura</a>";

            if( !empty($to) && !empty($message) ){
            
                $Email->setTo( $to );
                $Email->send($message);
            }
        }
    }        

    /* 
        sends an account change email. dest is the array with the destinations emails,
        mail is the new email in the change, pass is the new pass in the change
    */
    public function accountChange( $dest = [], $mail = "", $pass = "" ){

        $Email = $this->createEMail();
        $Email->setSubject("Mudança de credencial");

        foreach($dest as $to){
            
            if( !empty($to) ){

                if( ! $pass && ! $mail ){
                    return false;
                }

                $Email->setTo( $to );
                $message = "Hey, houveram alterações recentes em suas credenciais<br/><br/>";

                if( $mail ){
                    $message .= "Novo email: " . $mail . "<br/>";
                }

                if( $pass ){
                    $pass = "****" . substr($pass, 4);
                    $message .= "Nova senha: " . $pass . "<br/>";
                }

                $message .= 
                "<br/>Se você acredita que houve um engano, por favor, envie um informe para " . AP_CONTACT_EMAIL;

                $Email->send( $message );
            }
        } 
    }        
}
