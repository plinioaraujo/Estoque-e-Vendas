<?php

require_once "../controller/produtos.controller.php";
require_once "../models/produtos.model.php";

class TabelaProdutosVendas{

/*/==================================================
	MOSTRAR A TABELA DE PRODUTOS
=====================================================*/
	public function mostrarTabelaVendas(){


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
              



		  	$botoes =  "<div class='btn-group'><button class='btn btn-primary adicionarProduto recuperarBotao' idProduto='".$produtos[$i]["id"]."'>Adicionar</button></div>"; 

		
			$dadosJson .='[
			      "'.($i+1).'",
			      "'.$imagem.'",
			      "'.$produtos[$i]["codigo"].'",
			      "'.$produtos[$i]["descricao"].'",
			      "'.$estoque.'",
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
$ativarProdutosVendas = new TabelaProdutosVendas();
$ativarProdutosVendas -> mostrarTabelaVendas();