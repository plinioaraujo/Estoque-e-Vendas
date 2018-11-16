<?php

require_once "../controller/produtos.controller.php";
require_once "../models/produtos.model.php";
require_once "../controller/categorias.controller.php";
require_once "../models/categorias.model.php";


class TabelaProdutos{

/*/==================================================
	MOSTRAR A TABELA DE PRODUTOS
=====================================================*/
	public function mostrarTabelaProdutos(){


		$item = null;
		$valor = null;

		$produtos = ControllerProdutos::ctrListarProdutos($item,$valor);

		$dadosJson = '{
		  "data": [';

		for ($i=0; $i < count($produtos) ; $i++) {

			/*=============================================
 	 		TRAZEMOS A IMAGEM  			=============================================*/ 

		  	$imagem = "<img src='".$produtos[$i]["imagem"]."' width='40px'>";

				/*=============================================
 	 		TRAZEMOS A CATEGORiA
  			=============================================*/ 

		  	$item = "id";
		  	$valor = $produtos[$i]["id_categoria"];

		  	$categorias = ControllerCategorias::ctrListarCategorias($item, $valor);


			/*=============================================
 	 		estoque
  			=============================================*/ 

  			if($produtos[$i]["estoque"] <= 10){
						
  				$estoque = "<span class='badge bg-red' style='text-align:center'>".$produtos[$i]["estoque"]."</span>";
  				//"<button class='btn btn-danger'>".$produtos[$i]["estoque"]."</button>";

  			}else if($produtos[$i]["estoque"] > 11 && $produtos[$i]["estoque"] <= 15){

  				$estoque = 	$estoque = "<span class='badge bg-yellow'>".$produtos[$i]["estoque"]."</span>";
  				//"<button class='btn btn-warning'>".$produtos[$i]["estoque"]."</button>";

  			}else{

  				$estoque = 	$estoque = "<span class='badge bg-green'>".$produtos[$i]["estoque"]."</span>";
  				//"<button class='btn btn-success'>".$produtos[$i]["estoque"]."</button>";

  			}


			 	/*=============================================
 	 		TRAZEMOS AS AÇÕES
  			=============================================*/ 

		  	$botoes =  "<div class='btn-group'><button class='btn btn-warning btnEditarProduto' idProduto='".$produtos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProduto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnExcluirProduto' idProduto='".$produtos[$i]["id"]."' codigo='".$produtos[$i]["codigo"]."' imagem='".$produtos[$i]["imagem"]."'><i class='fa fa-times'></i></button></div>"; 

		
			$dadosJson .='[
			      "'.($i+1).'",
			      "'.$imagem.'",
			      "'.$produtos[$i]["codigo"].'",
			      "'.$produtos[$i]["descricao"].'",
			      "'.$categorias["descricao"].'",
			      "'.$estoque.'",
			      "'.$produtos[$i]["preco_compra"].'",
			      "'.$produtos[$i]["preco_venda"].'",
			      "'.$produtos[$i]["data_criacao"].'",
			      "'.$botoes.'"
			],';
		}

		$dadosJson = substr($dadosJson, 0, -1);

		 $dadosJson .=   '] 

		 }';

	echo  $dadosJson;


			
	}
}

/*/==================================================
		ATIVAR TABELA DE PRODUTOS
	=====================================================*/
$ativarProdutos = new TabelaProdutos();
$ativarProdutos -> mostrarTabelaProdutos();