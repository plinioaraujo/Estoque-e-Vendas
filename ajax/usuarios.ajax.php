<?php
 
require_once "../controller/usuarios.controller.php";
require_once "../models/usuarios.model.php";

class AjaxUsuarios{

	 /*=============================================
	EDITAR USUARIO
	=============================================*/	

	public $idUsuario;

	public function ajaxEditarUsuario(){

		$item = "id";
		$valor = $this->idUsuario;
          
       
		$resposta = ControllerUsuarios::ctrListarUsuarios($item, $valor);
                   
		echo json_encode($resposta);
	
    }

 	/*=============================================
	ATIVAR USUARIO
	=============================================*/	

	public $ativarUsuario;
	public $ativarId;

	public function ajaxAtivarUsuario(){

		$tabela = "usuarios";

		$item1 = "status";
		$valor1 = $this->ativarUsuario;

		$item2 = "id";
		$valor2 = $this->ativarId;

		$resposta = UsuariosModel::mdlAtualizarUsuario($tabela,$item1,$valor1,$item2,$valor2);

		
	}


	  /*=============================================
	VALIDAR USUARIO
	=============================================*/	
 	
 	public $validarLogin;


 	public function ajaxValidarLogin(){


 		$item = "login";
		$valor = $this->validarLogin;
          
       
		$resposta = ControllerUsuarios::ctrListarUsuarios($item, $valor);
                   
		echo json_encode($resposta);

 	}
    
}
    
    /*=============================================
    EDITAR USUARIO
    =============================================*/
    if(isset($_POST["idUsuario"])){
        
       
        $editar = new AjaxUsuarios();
        $editar -> idUsuario = $_POST["idUsuario"];
        $editar -> ajaxEditarUsuario();

    }


     /*=============================================
	ATIVAR USUARIO
	=============================================*/	
 	
 	if(isset($_POST["ativarUsuario"])){


 		$ativarUsuario = new AjaxUsuarios();
 		$ativarUsuario -> ativarUsuario = $_POST["ativarUsuario"];
 		$ativarUsuario ->  ativarId = $_POST["ativarId"];
 		$ativarUsuario -> ajaxAtivarUsuario();

 	}



	  /*=============================================
	VALIDAR LOGIN DO USUARIO
	=============================================*/	

	if(isset($_POST["validarLogin"])){

 		$validaLogin = new AjaxUsuarios();
 		$validaLogin -> validarLogin = $_POST["validarLogin"];
 		//$validarLogin ->  ativarId = $_POST["ativarId"];
 		$validaLogin -> ajaxValidarLogin();

 	}