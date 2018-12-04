<?php

require_once "../controller/produtos.controller.php";
require_once "../models/produtos.model.php";

class AjaxProdutos{


	/*==================================
		GERAR CODIGO A PARTIR DO ID CATEGORIA
	===================================*/
	 public $idCategoria;
	public function ajaxCriarCodigoProduto(){

		$item = "id_categoria";
		$valor = $this->idCategoria;

		$resposta = ControllerProdutos::ctrListarProdutos($item,$valor);

		echo json_encode($resposta);
	}

	  
/*=============================================
  EDITAR PRODUTO
  =============================================*/ 

  public $idProduto;
  public $todosProdutos;
  public $nomeProduto;

  public function ajaxEditarProduto(){

	if ($this->todosProdutos == "ok") {
		
	$item = null;
    $valor = null;

	$resposta = ControllerProdutos::ctrListarProdutos($item, $valor);
	
    echo json_encode($resposta);

	}else if ($this->nomeProduto != ""){

		$item = "descricao";
		$valor = $this->nomeProduto;
	
		$resposta = ControllerProdutos::ctrListarProdutos($item, $valor);
		
		echo json_encode($resposta);

	}else  {

    $item = "id";
    $valor = $this->idProduto;

    $resposta = ControllerProdutos::ctrListarProdutos($item, $valor);
	
    echo json_encode($resposta);
	}
  }

}

if (isset($_POST["idCategoria"])) {
	
		$codigoProduto = new AjaxProdutos();
		$codigoProduto -> idCategoria = $_POST["idCategoria"];
		$codigoProduto -> ajaxCriarCodigoProduto();
}

/*=============================================
EDITAR PRODUTO
=============================================*/ 

if(isset($_POST["idProduto"])){

	$editarProduto = new AjaxProdutos();
	$editarProduto -> idProduto = $_POST["idProduto"];
	$editarProduto -> ajaxEditarProduto();
  
  }

  /*=============================================
TODOS OS PRODUTOS
=============================================*/ 

if(isset($_POST["todosProdutos"])){

	$todosProdutos = new AjaxProdutos();
	$todosProdutos -> todosProdutos = $_POST["todosProdutos"];
	$todosProdutos -> ajaxEditarProduto();
  
  }
  
   /*=============================================
TODOS OS PRODUTOS
=============================================*/ 

if(isset($_POST["nomeProduto"])){

	$nomeProduto = new AjaxProdutos();
	$nomeProduto -> nomeProduto = $_POST["nomeProduto"];
	$nomeProduto -> ajaxEditarProduto();
  
  }
  