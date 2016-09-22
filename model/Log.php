<?php
require_once __DIR__."/DB.php";
require_once __DIR__.'/LogIterator.php';
/**
 * Description of Log
 *
 * @author christianberti
 */
class Log {
    private $id;
    private $utenteid;
    private $ip;
    private $token;
    private $lastdate;
    
    function __construct($id, $utenteid, $ip, $token, $lastdate) {
        $this->id = $id;
        $this->utenteid = $utenteid;
        $this->ip = $ip;
        $this->token = $token;
        $this->lastdate = $lastdate;
    }
    function getId() {
        return $this->id;
    }

    function getUtenteid() {
        return $this->utenteid;
    }

    function getIp() {
        return $this->ip;
    }

    function getToken() {
        return $this->token;
    }

    function getLastdate() {
        return $this->lastdate;
    }

    static function factoryByRow($row){
            $id=$row['id'];
            $user=$row['utenteid'];
            $i=$row['ip'];
            $toke=$row['token'];
            $date= $row['lastdate'];
            return new Log($id, $user, $i, $toke, $date);
    }
    static function findAllLog(){
        $db=DB::factory();
        $result = $db->query("SELECT * FROM log ");
        return new LogIterator($result);
    }
    
    static function setNewLog($id,$token){
        if(isset($_SERVER['REMOTE_ADDR'])){
            $ip = $_SERVER['REMOTE_ADDR'];
            $db=DB::factory();
            $db->query("INSERT INTO log(utenteid,ip,token)"
                . "VALUES('$id','$ip','$token') ");
        }
        
    }
    static function hexpiredSession($id,$token){
        $db=DB::factory();
        $db->query("UPDATE log SET token='NULL' WHERE utenteid='$id' AND token='$token'");
    }
    static function findUserLog($id){
        $db=DB::factory();
        $result = $db->query("SELECT * FROM log WHERE utenteid='$id' ");
        return new LogIterator($result);
    }
    static function generateToken(){
      //Dopo aver controllato login genera il token e lo memorizza nel DB.
      //D'ora in poi la sessione viene gestita con token che ha una validità.
      $token = bin2hex(openssl_random_pseudo_bytes(16));
      return $token;
  }
  static function checkToken($id, $token){
        $db=DB::factory();
        $result = $db->query("SELECT * FROM log WHERE utenteid='$id' AND token='$token' AND token IS NOT NULL");
        return new LogIterator($result);
  }
}
