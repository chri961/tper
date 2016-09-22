<?php
require_once __DIR__."/DB.php";
require_once __DIR__.'/UserIterator.php';
require_once __DIR__.'/Log.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author christianberti
 */
class User {
    private $id;
    private $dipid;
    private $user;
    private $password;
    private $ruolo;
    function __construct($id, $dipid, $user, $password,$ruolo) {
        $this->id = $id;
        $this->dipid = $dipid;
        $this->user = $user;
        $this->password = $password;
        $this->ruolo = $ruolo;
    }
    function getId(){
        return $this->id;
    }

    function getRuolo(){
        return $this->ruolo;
    }
    function getDipId(){
        return $this->dipid;
    }

static function factoryByRow($row){
        $id=$row['utenteid'];
        $dipid=$row['dip_id'];
        $user=$row['user'];
        $password=$row['password'];
        $ruolo= $row['ruolo'];
        return new User($id, $dipid, $user, $password,$ruolo);
}
static function findUser($user, $password){
        $db=DB::factory();
        $result = $db->query("SELECT * FROM utenti u WHERE u.user='$user' AND u.password='$password'");
        return new UserIterator($result);
    }
    function writeToken($token,$userid){
        if(isset($_SERVER['REMOTE_ADDR'])){
            $ip = $_SERVER['REMOTE_ADDR'];
            $db=DB::factory();
            $db->query("INSERT INTO log(utenteid,ip,token)"
                . "VALUES('$userid','$ip','$token') ");
        }
        
        
    }
    static function findAllUser(){
        $db=DB::factory();
        $result = $db->query("SELECT * FROM utenti ");
        return new UserIterator($result);
    }
//    static function checkLogin($user, $password){
//     $use = User::findUser($user, $password);
//     if($use== NULL){
//         return FALSE;
//     }else {
//         //$user->writeToken($this->generateToken());
//         $name= $use->getUser();
//         //$token = $use->getToken();
//         $data[0]= $name;
//         //$data[1]= $token;
//         return json_encode($data);
//     }
//    }
     static function  checkLogin($usern,$password){
     $user = User::findUser($usern, $password);
        $var = array();
        $var = $user;
        $data=array();
        $i =0;
        foreach ($var as $key => $samples) {
            $p[$i]= $samples->getUser();
            $p[$i+1]= $samples->getRuolo();
            $data[$i]= $p[$i];
            $data[$i+1]= $p[$i+1];
            //$i++;
            
        }
        return json_encode($data);
     }
  
  static function  checkLoginApi($usern,$password){
     $user = User::findUser($usern, $password);
        $token= NULL;
        $token = Log::generateToken();
        $var = array();
        $var = $user;
        $data=array();
        $i =0;
        foreach ($var as $key => $samples) {
            $p[$i]= $samples->getUser();
            $p[$i+1]= $samples->getRuolo();
            $p[$i+2]= $samples->getId();
            $p[$i+3]= $token;
            $data[$i]= $p[$i];
            $data[$i+1]= $p[$i+1];
            $data[$i+2]= $p[$i+2];
            $data[$i+3]= $p[$i+3];
            Log::setNewLog($data[$i+2], $data[$i+3]);
            $i++;
            
        }
        return json_encode($data);
     }
     function getUser(){
    return $this->user;
}
  }




