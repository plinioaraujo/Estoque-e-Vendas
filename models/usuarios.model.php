<?php

require_once("connection.php");

class UsuariosModel{
    
    static public function MdlMostrarUsuarios($tabela, $item, $valor){
        
        if($item != null){
            
        $stmt = Connection::conectar()->prepare("SELECT * FROM $tabela WHERE $item = :$item");
        
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
    
    
    
    /*====================================
    CADASTRO DE USUARIO    
    =====================================*/
    
    static public function MdlAdicionarUsuario($tabela,$dados){
        
     $stmt = Connection::conectar()->prepare("INSERT INTO $tabela(nome,login,senha,perfil,foto) VALUES (:nome, :login, :senha, :perfil, :rota)");

		$stmt->bindParam(":nome", $dados["nome"], PDO::PARAM_STR);
		$stmt->bindParam(":login", $dados["login"], PDO::PARAM_STR);
		$stmt->bindParam(":senha", $dados["senha"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $dados["perfil"], PDO::PARAM_STR); 
        $stmt->bindParam(":rota", $dados["rota"], PDO::PARAM_STR); 
		
        if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

        
    }
        
    
    /*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabela, $dados){
	
		$stmt = Connection::conectar()->prepare("UPDATE $tabela SET nome = :nome, senha = :senha, perfil = :perfil, foto = :foto WHERE login = :login");

		$stmt -> bindParam(":nome", $dados["nome"], PDO::PARAM_STR);
		$stmt -> bindParam(":senha", $dados["senha"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $dados["perfil"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $dados["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":login", $dados["login"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	   /*====================================
   		 ATUALIZAR USUARIO    
    	=====================================*/
		static public function mdlAtualizarUsuario($tabela, $item1,$valor1,$item2,$valor2){
	
		$stmt = Connection::conectar()->prepare("UPDATE $tabela SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1,$valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2,$valor2, PDO::PARAM_STR);

		///////////print_r(Conexion::conectar()->errorInfo()); 

		if($stmt -> execute()){

			return "ok";
		}else{
			return "error";
		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	EXCLUIR USUARIO
	=============================================*/

	static public function mdlExcluirUsuario($tabela, $dados){

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