<?php

require_once "connection.php";

class ProdutosModel{

static public function mdlListarProdutos($tabela, $item, $valor){

	  if($item != null){
            
        $stmt = Connection::conectar()->prepare("SELECT * FROM $tabela WHERE $item = :$item ORDER BY ID DESC");
        
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        
        $stmt -> execute();
//var_dump($stmt);   
        return $stmt -> fetch();
            
        }else{
            
           $stmt = Connection::conectar()->prepare("SELECT * FROM $tabela");
        
            $stmt -> execute();
                
        return $stmt -> fetchAll();
            
        }
        
        $stmt -> close();
        $stmt = null;

}

	/*=============================================
	CADASTRAR PRODUTO
        =============================================*/
        
        static public function mdlAdicionarProduto($tabela, $dados){

                $stmt = Connection::conectar()->prepare("INSERT INTO $tabela(id_categoria, descricao, codigo, imagem, estoque, preco_compra, preco_venda) VALUES (:id_categoria, :descricao, :codigo, :imagem, :estoque, :preco_compra, :preco_venda)");

		$stmt->bindParam(":id_categoria", $dados["id_categoria"], PDO::PARAM_INT);
                $stmt->bindParam(":descricao", $dados["descricao"], PDO::PARAM_STR);
                $stmt->bindParam(":codigo", $dados["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":imagem", $dados["imagem"], PDO::PARAM_STR);
		$stmt->bindParam(":estoque", $dados["estoque"], PDO::PARAM_STR);
		$stmt->bindParam(":preco_compra", $dados["preco_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":preco_venda", $dados["preco_venda"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;


        }

        /*=============================================
	EDITAR PRODUTO
	=============================================*/
	static public function mdlEditarProduto($tabela, $dados){

		$stmt = Connection::conectar()->prepare("UPDATE $tabela SET id_categoria = :id_categoria, descricao = :descricao, imagem = :imagem, estoque = :estoque, preco_compra = :preco_compra, preco_venda = :preco_venda WHERE codigo = :codigo");

		$stmt->bindParam(":id_categoria", $dados["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $dados["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descricao", $dados["descricao"], PDO::PARAM_STR);
		$stmt->bindParam(":imagem", $dados["imagem"], PDO::PARAM_STR);
		$stmt->bindParam(":estoque", $dados["estoque"], PDO::PARAM_STR);
		$stmt->bindParam(":preco_compra", $dados["preco_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":preco_venda", $dados["preco_venda"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

        }
        

        /*=============================================
	EXCLUIR PRODUTO
	=============================================*/

	static public function mdlExcluirProduto($tabela, $dados){

		$stmt = Connection::conectar()->prepare("DELETE FROM $tabela WHERE id = :id");

		$stmt -> bindParam(":id", $dados, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}