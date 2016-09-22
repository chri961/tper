<?php
require_once __DIR__.'/ResultDB.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ResultDBSQLite
 *
 * @author christianberti
 */
class ResultDBSQLite extends ResultDB{
     function fetch_assoc(){
          return $this->res->fetchArray(SQLITE3_ASSOC);
    }
    public function reset() {
        $this->res->reset();
    }
}
