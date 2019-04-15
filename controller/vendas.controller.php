<?php

class ControllerVendas {
  

    /*========================================
             LISTAR VENDAS
    ==========================================*/

    static public function ctrListarVendas($item, $valor){
    
        $tabela = "vendas";

		$resposta = VendasModel::mdlListarVendas($tabela, $item, $valor);

		return $resposta; 

    }


   
    /*========================================s
             CADASTRAR VENDA
    ==========================================*/
 	static public function ctrCriarVenda(){
 		
 	 		if ( isset($_POST["novaVenda"])  ){

 			/*=============================================
				ATUALIAR AS COMPRAS DO CLIENTE E REDUZIR O ESTOQUE E AUMENTAR AS VENDAS DOS PRODUTOS
			=============================================*/

			 $listaProdutos = json_decode($_POST["listaProdutos"],true);
			

			 $totalProdutosComprados = array();


			 	 //VALIDA SE HÁ PRODUTOS NA LISTA 
			 if(empty($listaProdutos)){

					echo'<script>

					swal({
						  type: "error",
						  title: "Oops...",
						  text: "Não tem produtos na lista",
						  footer: "<a href>Tem alguma dúvida?</a>"
						})

					</script>';

				} else  {

	 	 	foreach ($listaProdutos as $key => $value) {
	 			
	 	 		array_push($totalProdutosComprados, $value["quantidade"]);	

			 	$tabelaProdutos = "produtos";

			 	$item = "id";
			 	$valor = $value["id"];

			 	$trazerProduto = ProdutosModel::mdlListarProdutos($tabelaProdutos, $item, $valor);

			 	//var_dump($trazerProduto["vendas"]);

			 	$item1a = "vendas";
			 	$valor1a = $value["quantidade"] + $trazerProduto["vendas"];

			 	$novasVendas = ProdutosModel::mdlAtualizarProduto($tabelaProdutos, $item1a, $valor1a, $valor);

			 	$item1b = "estoque";
			 	$valor1b = $value["estoque"]; 

			 	$novoEstoque = ProdutosModel::mdlAtualizarProduto($tabelaProdutos, $item1b, $valor1b, $valor);

			 }


				$tabelaClientes = "clientes";

				$item = "id";
				$valor = $_POST["selecionarCliente"];

				$trazerCliente = ClientesModel::mdlListarClientes($tabelaClientes, $item, $valor);

				//var_dump($trazerCliente["compras"]);

				$item1 = "compras";
				$valor1 = array_sum($totalProdutosComprados) + $trazerCliente["compras"]; 

				$comprasCliente = ClientesModel::mdlAtualizarCliente($tabelaClientes, $item1, $valor1, $valor);


					$item1b = "ultima_compra";
				
				 date_default_timezone_set("America/Sao_Paulo");

				  $data = date("Y-m-d");
				  $hora = date("H:i:s");
				  $valor1b = $data. ' '. $hora;

				  $dataCliente = ClientesModel::mdlAtualizarCliente($tabelaClientes, $item1b, $valor1b, $valor);


				/*=============================================
					GUARDAR A COMPRA
				=============================================*/	


				$tabelaVendas = "vendas";

				$dados = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["selecionarCliente"],
						   "codigo"=>$_POST["novaVenda"],
						   "produtos"=>$_POST["listaProdutos"],
						   "juros"=>$_POST["novoValorImposto"],
						   "valor"=>$_POST["totalAPagarSemImposto"],
						   "valor_total"=>$_POST["totalVenda"],
						   "metodo_pagamento"=>$_POST["listaMetodoPagamento"]);

				$resposta = VendasModel::mdlAdicionarVenda($tabelaVendas, $dados);




				//var_dump($dados);
				if($resposta == "ok"){

					echo'<script>

					localStorage.removeItem("rango");

					swal({
						  type: "success",
						  title: "Venda gravada com sucesso!",
						  showConfirmButton: true,
						  confirmButtonText: "Fechar"
						  }).then((result) => {
									if (result.value) {

									window.location = "vendas";

									}
								})

					</script>';

				}


			}

			
			} // Fim de verificação se há produtos na lista

 		  	} // FIM FUNÇAO CRIAR VENDA 


 /*========================================s
            EDITAR VENDA
    ==========================================*/
 	static public function ctrEditarVenda(){
 		
 	 		if ( isset($_POST["editarVenda"])  ){

 	 		/*=============================================
				FORMATAR TABELA DE DADOS DE PRODUTOS E DE CLIENTES
			=============================================*/
				$tabelaVenda = "vendas";

				$item = "codigo";
			 	$valor = $_POST["editarVenda"];

			 	$trazerVenda = VendasModel::mdlListarVendas($tabelaVenda, $item, $valor);

			 	$produtos = json_decode($trazerVenda["produtos"],true);	

			 	//var_dump($produtos);

			 	$totalProdutosComprados = array();

			 	foreach ($produtos as $key => $value) {
			 		
			 		$tabelaProdutos = "produtos";

			 		$item = "id";
				  	$valor = $value["id"];

				  	$trazerProduto = ProdutosModel::mdlListarProdutos($tabelaProdutos, $item, $valor);

				  	$item1a = "vendas";
				  	$valor1a = $trazerProduto["vendas"] - $value["quantidade"];

				  	$novasVendas = ProdutosModel::mdlAtualizarProduto($tabelaProdutos, $item1a, $valor1a, $valor);

				  	$item1b = "estoque";
					$valor1b = $value["quantidade"] + $trazerProduto["estoque"]; 

				  	$novoEstoque = ProdutosModel::mdlAtualizarProduto($tabelaProdutos, $item1b, $valor1b, $valor);



			 	}

			 	 	$tabelaClientes = "clientes";

				 	$itemEditarCliente = "id";
				 	$valorEditarCliente = $_POST["selecionarCliente"];

				 	$trazerEditarCliente = ClientesModel::mdlListarClientes($tabelaClientes, $itemEditarCliente, $valorEditarCliente);

				 	$itemEditarCompras = "compras";
					$valorEditarCompras = $trazerCliente["compras"] - array_sum($totalProdutosComprados); 

					$comprasCliente = ClientesModel::mdlAtualizarCliente($tabelaClientes, $itemEditarCompras, $valorEditarCompras, $valorEditarCliente);



 			/*=============================================
				ATUALIAR AS COMPRAS DO CLIENTE E REDUZIR O ESTOQUE E AUMENTAR AS VENDAS DOS PRODUTOS
			=============================================*/

			//  $listaProdutos = json_decode($_POST["listaProdutos"],true);
			

			//  $totalProdutosComprados = array();


			//  	 //VALIDA SE HÁ PRODUTOS NA LISTA 
			//  if(empty($listaProdutos)){

			// 		echo'<script>

			// 		swal({
			// 			  type: "error",
			// 			  title: "Oops...",
			// 			  text: "Não tem produtos na lista",
			// 			  footer: "<a href>Tem alguma dúvida?</a>"
			// 			})

			// 		</script>';

			// 	} else  {

	 	//  	foreach ($listaProdutos as $key => $value) {
	 			
	 	//  		array_push($totalProdutosComprados, $value["quantidade"]);	

			//  	$tabelaProdutos = "produtos";

			//  	$item = "id";
			//  	$valor = $value["id"];

			//  	$trazerProduto = ProdutosModel::mdlListarProdutos($tabelaProdutos, $item, $valor);

			//  	//var_dump($trazerProduto["vendas"]);

			//  	$item1a = "vendas";
			//  	$valor1a = $value["quantidade"] + $trazerProduto["vendas"];

			//  	$novasVendas = ProdutosModel::mdlAtualizarProduto($tabelaProdutos, $item1a, $valor1a, $valor);

			//  	$item1b = "estoque";
			//  	$valor1b = $value["estoque"]; 

			//  	$novoEstoque = ProdutosModel::mdlAtualizarProduto($tabelaProdutos, $item1b, $valor1b, $valor);

			//  }


			// 	$tabelaClientes = "clientes";

			// 	$item = "id";
			// 	$valor = $_POST["selecionarCliente"];

			// 	$trazerCliente = ClientesModel::mdlListarClientes($tabelaClientes, $item, $valor);

			// 	//var_dump($trazerCliente["compras"]);

			// 	$item1 = "compras";
			// 	$valor1 = array_sum($totalProdutosComprados) + $trazerCliente["compras"]; 

			// 	$comprasCliente = ClientesModel::mdlAtualizarCliente($tabelaClientes, $item1, $valor1, $valor);


			// 		$item1b = "ultima_compra";
				
			// 	 date_default_timezone_set("America/Sao_Paulo");

			// 	  $data = date("Y-m-d");
			// 	  $hora = date("H:i:s");
			// 	  $valor1b = $data. ' '. $hora;

			// 	  $dataCliente = ClientesModel::mdlAtualizarCliente($tabelaClientes, $item1b, $valor1b, $valor);


			// 	/*=============================================
			// 		GUARDAR A COMPRA
			// 	=============================================*/	


		

			// 	$dados = array("id_vendedor"=>$_POST["idVendedor"],
			// 			   "id_cliente"=>$_POST["selecionarCliente"],
			// 			   "codigo"=>$_POST["novaVenda"],
			// 			   "produtos"=>$_POST["listaProdutos"],
			// 			   "juros"=>$_POST["novoValorImposto"],
			// 			   "valor"=>$_POST["totalAPagarSemImposto"],
			// 			   "valor_total"=>$_POST["totalVenda"],
			// 			   "metodo_pagamento"=>$_POST["listaMetodoPagamento"]);

			// 	$resposta = VendasModel::mdlAdicionarVenda($tabelaVendas, $dados);




			// 	//var_dump($dados);
			// 	if($resposta == "ok"){

			// 		echo'<script>

			// 		localStorage.removeItem("rango");

			// 		swal({
			// 			  type: "success",
			// 			  title: "Venda gravada com sucesso!",
			// 			  showConfirmButton: true,
			// 			  confirmButtonText: "Fechar"
			// 			  }).then((result) => {
			// 						if (result.value) {

			// 						window.location = "vendas";

			// 						}
			// 					})

			// 		</script>';

			// 	}


			// }

			
			 } // Fim de verificação se há produtos na lista

 		  	} // FIM FUNÇAO EDITAR VENDA 



} //FIM DO CONTROLLER DE VENDA
   