<?php

require_once("connection.php");

class ModelCategorias{

	/*=============================================
	ADIDICONAR CATEGORIA
	=============================================*/

	static public function MdlAdicionarCategoria($tabela,$dados){ 

		$stmt = Connection::conectar()->prepare("INSERT INTO $tabela(descricao) VALUES (:descricao)");
		$stmt->bindParam(":descricao", $dados, PDO::PARAM_STR);


			 if($stmt->execute()){

			return "ok";	

			}else{

				return "error";
			
			}

		$stmt->close();
		
		$stmt = null;

	}


	/*=============================================
	LISTAR CATEGORIAS
	=============================================*/

	static public function mdlListarCategorias($tabela, $item, $valor){

		if($item != null){

			$stmt = Connection::conectar()->prepare("SELECT * FROM $tabela WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();
			
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
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarCategoria($tabela, $dados){

		$stmt = Connection::conectar()->prepare("UPDATE $tabela SET descricao = :descricao WHERE id = :id");

		$stmt -> bindParam(":descricao", $dados["descricao"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $dados["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


/*=============================================
	EXCLUIR CATEGORIA
	=============================================*/

	static public function mdlExcluirCategoria($tabela, $dados){

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



}//Final da Classe