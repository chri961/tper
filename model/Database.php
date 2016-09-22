<?php
require_once __DIR__.'/../conf/Config.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Database
 *
 * @author christianberti
 */
class Database {
    private $conn=null;
    
    function __construct() {
        $this->conn=new mysqli(Config::DBHOST, Config::DBUSER, Config::DBPASSWD, Config::DBSCHEMA);
        if ($this->isConnected()) {
        }
    }
    public function isConnected(){
        return $this->conn!=null;
    }

    public function query($sql){
        return $this->conn->query($sql);
    }
}
