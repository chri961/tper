<?php
require_once __DIR__.'/ResultDBMySQL.php';
require_once __DIR__.'/ResultDBSQLite.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResultDB
 *
 * @author christianberti
 */
abstract class ResultDB {
    protected $res;
    function __construct($res) {
        $this->res = $res;
    }

    abstract function fetch_assoc();
    abstract function reset();
    
  static function factory($res=NULL){
      if ($res===null || $res===true || $res===false){
          return $res;
      }
      if (Config::DBMS==Config::DBMSMYSQL){
          //MySQL
          return new ResultDBMySQL($res);
      }
      if (Config::DBMS==Config::DBMSSQLITE){
          //SQLite
          return new ResultDBSQLite($res);
      }
      return null;
  }
    
}
