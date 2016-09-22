<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserIterator
 *
 * @author christianberti
 */
class UserIterator implements Iterator {
    /** @var SQLite3Result a query result */
    private $result;
    /** @var int current row index (the key) */
    private $pos;
    /** @var Sample current row (the value) */
    private $curSample;
    /** @var boolean curPresent is valid */
    private $_valid;
    
    function __construct($result) {
        $this->result = $result;
        $this->rewind();
    }

    
    public function current() {
        return $this->curSample;
    }

    public function key() {
        return $this->pos;
    }

    public function next() {
        $row=$this->result->fetch_assoc();
        if ($row){
            $this->_valid=TRUE;
            $this->curSample= User::factoryByRow($row);
            $this->pos++;
        }
        else {
            $this->_valid=FALSE;
            $this->curSample=  NULL;
        }
    }

    public function rewind() {
        $this->result->reset();
        $this->pos = -1;
        $this->next();
    }

    public function valid() {
        return $this->_valid;
    } 
}
