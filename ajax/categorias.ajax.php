<?php

require_once "../controller/categorias.controller.php";
require_once "../models/categorias.model.php";

class AjaxCategorias{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idCategoria;

	public function ajaxEditarCategoria(){

		$item = "id";
		$valor = $this->idCategoria;

		$resposta = ControllerCategorias::ctrListarCategorias($item, $valor);

		echo json_encode($resposta);

	}
}



/*=============================================
EDITAR CATEGORIA
=============================================*/	
if(isset($_POST["idCategoria"])){

	$categoria = new AjaxCategorias();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> ajaxEditarCategoria();
}
