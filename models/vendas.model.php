<?php

require_once "connection.php"; 

class VendasModel{
 

    /*=============================================
        LISTAR VENDAS
    =============================================*/

static public function mdlListarVendas($tabela, $item, $valor){

    if($item != null){
            
        $stmt = Connection::conectar()->prepare("SELECT * FROM $tabela WHERE $item = :$item ORDER BY id ASC");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        
        $stmt -> execute();

        return $stmt -> fetch();
            
        }else{
            
           $stmt = Connection::conectar()->prepare("SELECT * FROM $tabela ORDER BY id ASC");
        
            $stmt -> execute();
                
        return $stmt -> fetchAll();
            
        }
        
        $stmt -> close();
        $stmt = null;

}


/*=============================================
    ADICIONAR VENDA
    =============================================*/

    static public function mdlAdicionarVenda($tabela, $dados){

        $stmt = Connection::conectar()->prepare("INSERT INTO $tabela(codigo, id_cliente, id_vendedor, produtos, juros, valor, valor_total, metodo_pagamento)
            VALUES(:codigo, :id_cliente, :id_vendedor, :produtos, :juros, :valor, :valor_total, :metodo_pagamento)");
        
        $stmt->bindParam(":codigo", $dados["codigo"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cliente", $dados["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":id_vendedor", $dados["id_vendedor"], PDO::PARAM_INT);
        $stmt->bindParam(":produtos", $dados["produtos"], PDO::PARAM_STR);
        $stmt->bindParam(":juros", $dados["juros"], PDO::PARAM_STR);
        $stmt->bindParam(":valor", $dados["valor"], PDO::PARAM_STR);
        $stmt->bindParam(":valor_total", $dados["valor_total"], PDO::PARAM_STR);
        $stmt->bindParam(":metodo_pagamento", $dados["metodo_pagamento"], PDO::PARAM_STR);
        
        if($stmt->execute()){

            return "ok";

        }else{

            return "error";
        
        }

        $stmt->close();
        $stmt = null;

    }

}