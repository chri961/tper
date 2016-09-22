<?php
require_once __DIR__.'/DB.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBSQLite
 *
 * @author christianberti
 */
class DBSQLite extends DB{
    public function __construct() {
    $this->db=new SQLite3(__DIR__."/../data/".Config::DBFILE);
  }
  public function query($query){
    return ResultDB::factory($this->db->query($query));
  }

  public function exec($query){
    return ResultDB::factory($this->db->exec($query));
  }
}
