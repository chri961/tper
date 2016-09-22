<?php
require_once __DIR__.'/PageInterface.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiPage
 *
 * @author christianberti
 */
class ApiPage implements PageInterface {
    //definizione metodo interface
    public function show($title = NULL, $file = NULL) {
        echo $title;
    }

}
