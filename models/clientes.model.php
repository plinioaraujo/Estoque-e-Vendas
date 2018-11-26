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

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
}
