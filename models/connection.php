<?php


class Connection{
    
    
  static public function conectar(){
        $link = new PDO("mysql:host=localhost;dbname=inventory","root","");
        
        $link-> exec("set names utf8");
        
        return $link;
    }
}
