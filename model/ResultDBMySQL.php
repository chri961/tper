<?php
require_once __DIR__.'/ResultDB.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResultDBMySQL
 *
 * @author christianberti
 */
class ResultDBMySQL extends ResultDB{
    function fetch_assoc(){
          return $this->res->fetch_assoc();
    }
    public function reset() {
        $this->res->data_seek(0);
    }
}
