<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author christianberti
 */
class Config {
  const DBMSMYSQL='MySQL';
  const DBMSSQLITE='SQLite';
  const DBMS=self::DBMSMYSQL;
//  const DBMS=self::DBMSSQLITE;
  // per SQLite
  const DBFILE='tperDump';
  const DATAFOLDER = '/data';
  const SQLITEADMINPASSWD='Tper';
  const SQLITEADMINPATH='lib/phpliteAdmin_v1-9-5/phpliteadmin.php';
  //--------
  //per MySQL
  const DBHOST='localhost';
  const DBUSER='root';
  const DBPASSWD='';
  const DBSCHEMA='tper';
  //--------
  const SAMPLETHRESHOLD=2000;
  const APPLICATIONFOLDER='logger';
//  const APPLICATIONHOSTURL="http://tper.ddns.net/services";
  const APPLICATIONHOSTURL="http://localhost";
  const APPLICATIONHEADERH1="LOG TPer";
}