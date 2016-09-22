<?php
require_once __DIR__.'/PageInterface.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HTMLPage
 *
 * @author christianberti
 */
class HtmlPage implements PageInterface{
  private $title;
  private $contentIncludeFile;
  private $contentObjects;
  
  function __construct() {
      $this->title='';
      $this->contentIncludeFile='';
      $this->contentObjects=array();
  }

  
  public function setTitle($title){
    $this->title=$title;
  }

  function setContentIncludFile($file) {
    $this->contentIncludeFile=$file;
  }
  
  public function addObject($key,$object){
      $this->contentObjects[$key]=$object;
  }
  
  private function setContent() {
    include __DIR__."/{$this->contentIncludeFile}";
  }
  
  private function setNavigationBar($nav){
    echo "<ul>\n";
      foreach ($nav as $action => $item ){
        echo "<li";
        if ($this->contentIncludeFile=="$action.php") echo ' class="selected"';
        echo "><a href=\"index.php?r=$action\">$item</a></li>\n";
      }
    echo "</ul>\n";                      
  }
  
  private function setNavigationBarWithLast($nav){
    echo "<ul>\n";
      $last=count($nav);
      $i=0;
      foreach ($nav as $action => $item ){
        $i++;
        echo "<li";
        if ($i<$last) {
          if ($this->contentIncludeFile=="$action.php") echo ' class="selected"';
        }
        else {
          echo ' class="';
          if ($this->contentIncludeFile=="$action.php") echo 'selected ';
          echo 'last"';
        }
        echo "><a href=\"index.php?r=$action\">$item</a></li>\n";
      }
      /*
        <li<?php if ($this->contentIncludeFile=='index.php') echo ' class="selected"'; ?>><a href="index.php">Home</a></li>
        <li<?php if ($this->contentIncludeFile=='packagetour.php') echo ' class="selected"'; ?>><a href="packagetour.php">Package Tour</a></li>
        <li class="<?php if ($this->contentIncludeFile=='contact.php') echo 'selected '; ?>last"><a href="contact.php">Contact us</a></li>
       */
    echo "</ul>\n";                      

  }

  function show($title=NULL,$file=NULL){
    if ($title!==NULL){
      $this->setTitle($title);
    }
    if ($file!==NULL){
      $this->setContentIncludFile($file);
    }
    include __dir__.'/template.php';
  }
}