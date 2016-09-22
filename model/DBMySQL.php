<?php
require_once __DIR__."/../conf/Config.php";
require_once __DIR__.'/DB.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBMySQL
 *
 * @author christianberti
 */
class DBMySQL  extends DB{
    public function __construct() {
    $this->db=new mysqli(Config::DBHOST,Config::DBUSER,Config::DBPASSWD,Config::DBSCHEMA);

  }
  public function query($query){
    return ResultDB::factory($this->db->query($query));
//    $array= $dbresult->fetch_assoc();
//    return $array;
  }

  public function exec($query){
    return ResultDB::factory($this->db->query($query));
  }
}
