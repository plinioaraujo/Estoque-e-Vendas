<?php

require_once("connection.php");

class ClientesModel{

	/*=============================================
	ADICIONAR CLIENTE
	=============================================*/

	static public function mdlAdicionarCliente($tabela, $dados){

		$stmt = Connection::conectar()->prepare("INSERT INTO $tabela(nome, cpf, email, telefone,celular, logradouro, data_nascimento) VALUES (:nome, :cpf, :email, :telefone, :celular, :logradouro, :data_nascimento)");

		$stmt->bindParam(":nome", $dados["nome"], PDO::PARAM_STR);
		$stmt->bindParam(":cpf", $dados["cpf"], PDO::PARAM_INT);
        $stmt->bindParam(":email", $dados["email"], PDO::PARAM_STR);
        $stmt->bindParam(":telefone", $dados["telefone"], PDO::PARAM_STR);
		$stmt->bindParam(":celular", $dados["celular"], PDO::PARAM_STR);
		$stmt->bindParam(":logradouro", $dados["logradouro"], PDO::PARAM_STR);
		$stmt->bindParam(":data_nascimento", $dados["data_nascimento"], PDO::PARAM_STR);
		var_dump($stmt);
		//var_dump($dados);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}
	

	/*=============================================
	LISTAR CLIENTES
	=============================================*/

	static public function mdlListarClientes($tabela, $item, $valor){

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
}
