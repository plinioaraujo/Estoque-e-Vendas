<?php

require_once "connection.php";

class VendasModel{

static public function mdlListarVendas($tabela, $item, $valor){

    if($item != null){
            
        $stmt = Connection::conectar()->prepare("SELECT * FROM $tabela WHERE $item = :$item ORDER BY data DESC");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        
        $stmt -> execute();

        return $stmt -> fetch();
            
        }else{
            
           $stmt = Connection::conectar()->prepare("SELECT * FROM $tabela ORDER BY data DESC");
        
            $stmt -> execute();
                
        return $stmt -> fetchAll();
            
        }
        
        $stmt -> close();
        $stmt = null;

}

}