<?php

require_once "../controller/clientes.controller.php";
require_once "../models/clientes.model.php";

class AjaxClientes{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idCliente;

		$resposta = ControllerClientes::ctrListarClientes($item, $valor);

		echo json_encode($resposta);

	}
}



/*=============================================
EDITAR Cliente
=============================================*/	
if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();
}
