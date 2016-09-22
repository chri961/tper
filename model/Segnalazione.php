<?php
require_once __DIR__."/DB.php";
require_once __DIR__.'/SegnIterator.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Segnalazione
 *
 * @author christianberti
 */
class Segnalazione {
    private $seg_id;
    private $seg_user;
    private $seg_text;
    private $seg_ip;
    private $seg_date;
    private $seg_result;
    
    function __construct($seg_id, $seg_user, $seg_text, $seg_ip, $seg_date, $seg_result) {
        $this->seg_id = $seg_id;
        $this->seg_user = $seg_user;
        $this->seg_text = $seg_text;
        $this->seg_ip = $seg_ip;
        $this->seg_date = $seg_date;
        $this->seg_result = $seg_result;
    }
    function getSeg_id() {
        return $this->seg_id;
    }

    function getSeg_user() {
        return $this->seg_user;
    }

    function getSeg_text() {
        return $this->seg_text;
    }

    function getSeg_ip() {
        return $this->seg_ip;
    }

    function getSeg_date() {
        return $this->seg_date;
    }

    function getSeg_result() {
        return $this->seg_result;
    }

    static function factoryByRow($row){
            $id=$row['seg_id'];
            $user=$row['seg_user'];
            $text=$row['seg_text'];
            $ip=$row['seg_ip'];
            $date= $row['seg_date'];
            $result= $row['seg_result'];
            return new Segnalazione($id, $user, $text, $ip, $date, $result);
    }
    
    static function findAllSegnalation(){
        $db=DB::factory();
        $result = $db->query("SELECT * FROM segnalazione ");
        return new SegnIterator($result);
    }
}
