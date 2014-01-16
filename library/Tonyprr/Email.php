<?php
/**
 * Description of Tonyprr_Email
 *
 * @author Antonio Ramos
 */
class Tonyprr_Email extends Zend_Mail {
    protected $cn_mail;
    protected $mail;
    protected $name;

    function  __construct($user="",$pass="",$name="") {
        parent::__construct();
        $this->name=($name!="")?$name:'Contacto Reset';
            
        $this->mail=($user!="")?$user:'tonyprr@gmail.com';
        $config = array(
                'ssl' => 'tls',
                'port' => 25,
                'auth' => 'login',
                'username' => $this->mail,
                'password' => ($pass!="")?$pass:'ramos12345'
        );
//        $this->cn_mail = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
        
        $this->cn_mail = new Zend_Mail_Transport_Sendmail();
        
//        $this->mail=($user!="")?$user:'machu.picchu@mpf.com.pe';
//        $this->cn_mail = new Zend_Mail_Transport_Smtp();
//        $protocolo = new Zend_Mail_Protocol_Smtp("localhost",25);
//        $this->cn_mail->setConnection($protocolo);
//        $protocolo->connect();
//        $protocolo->helo("localhost");
        
        
        Zend_Mail::setDefaultTransport($this->cn_mail);
    }
    
    function getMailTrans(){
        return $this->cn_mail;
    }

    function getAccount(){
        return $this->mail;
    }


    function getName(){
        return $this->name;
    }

    function convertString($string){
        return stripslashes(iconv("UTF-8","ISO-8859-1//TRANSLIT", $string));
        return $string;
    }

}
?>
