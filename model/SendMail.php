<?php
/**
 * Description of SendMail
 * Classe generica per invio mail. Si prevede modifica al web server in modo da utilizzare
 * server SMTP di Google. Modificare file php.ini sezione sendmail. In caso in cui il web server 
 * sia dotato di server mail utilizzare localhost.
 *
 * @author christianberti
 */
class SendMail {
    private $msg = null;
    private $destination = null;
    private $subject = null;
    private $usr = null;
    
    function __construct($destinat, $msgg, $user, $sub) {
        $this->destination=$destinat;
        $this->msg=$msgg;
        $this->usr=$user;
        $this->subject=$sub;
        $this->invia();
    }
    private function invia(){
        $this->msg= "Gentile System Admin,"
                . "L'utente '$this->usr' ti ha inoltrato il seguente messaggio:"
                . "'$this->msg'";
        mail($this->destination, $this->subject, $this->msg);
    }
    
    function getMsg(){
        return $this->msg;
    }
    function getDestination(){
        return $this->destination;
    }
    function getSubject(){
        return $this->subject;
    }
    function getUsr(){
        return $this->usr;
    }
}
