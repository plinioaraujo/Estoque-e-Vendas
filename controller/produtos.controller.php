<?php

class ControllerProdutos{

	/*=============================================
	MOSTRAR produtos
	=============================================*/

	static public function ctrListarProdutos($item, $valor){

		$tabela = "produtos";

		$resposta = ProdutosModel::mdlListarProdutos($tabela, $item, $valor);

		return $resposta; 

	}

	/*=============================================
	CADASTRAR PRODUTO
	=============================================*/

	static public function ctrAdicionarProduto(){

		if(isset($_POST["novaDescricao"])){

			if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ ]+$/', $_POST["novaDescricao"]) &&
			   preg_match('/^[0-9]+$/', $_POST["novoEstoque"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["novoPrecoCompra"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["novoPrecoVenda"])){

					$rotaImagem = "view/img/produtos/default/anonymous.png";
					
					if(isset($_FILES["novaImagem"]["tmp_name"])) {
                   
                   
						list($largura, $altura) = getimagesize($_FILES["novaImagem"]["tmp_name"]);
						 
						 $novaLargura = 500;
						 $novaAltura = 500;
						 
						   /*=============================================
							  CRIAR PASTA DAS IMAGENS CARREGADAS
						   =========================================*/
						 
						 $pasta = "view/img/produtos/".$_POST["novoCodigo"]; 
						// $pasta = strtolower($pasta);
						 mkdir($pasta,0755);
						 
						 
						 /*=============================================
						  DE ACORDO COM O TIPO DE IMAGEM APLICAMOS AS FUNÇOES DO PHP
						  =============================================*/
						 
						 if($_FILES["novaImagem"]["type"] == "image/jpeg"){
						 
						  //SALVAMOS A IMAGEM NA PASTA
							 
							 
							 $aleatorio = mt_rand(100,999);
							$rotaImagem = "view/img/produtos/".$_POST["novoCodigo"]."/".$aleatorio.".jpg";
							 
							 $origem = imagecreatefromjpeg($_FILES["novaImagem"]["tmp_name"]);						
	  
							  $destino = imagecreatetruecolor($novaLargura, $novaAltura);
	  
							  imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);
	  
							  imagejpeg($destino, $rotaImagem);
							 
						 
					   //  var_dump(getimagesize($_FILES["novaImagem"]["tmp_name"]));
					 }
						
						 
						 if($_FILES["novaImagem"]["type"] == "image/png"){
						 
						  //SALVAMOS A IMAGEM NA PASTA
							 
							 
							 $aleatorio = mt_rand(100,999);
						  	 $rotaImagem = "view/img/usuarprodutos/".$_POST["novoCodigo"]."/".$aleatorio.".jpg";
							 
							 $origem = imagecreatefrompng($_FILES["novaImagem"]["tmp_name"]);						
	  
							  $destino = imagecreatetruecolor($novaLargura, $novaAltura);
	  
							  imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);
	  
							  imagepng($destino, $rotaImagem);
							 
						 
					   //  var_dump(getimagesize($_FILES["novaImagem"]["tmp_name"]));
					 }
						 
					 }
					  

				   $tabela = "produtos";
				   
				   $dados = array(
					"id_categoria" =>$_POST["novaCategoria"],
					"descricao" =>$_POST["novaDescricao"],
					"codigo" =>$_POST["novoCodigo"],
					"estoque" =>$_POST["novoEstoque"],
					"preco_compra" =>$_POST["novoPrecoCompra"],
					"preco_venda" =>$_POST["novoPrecoVenda"],
					"imagem" =>$rotaImagem);

					$resposta = ProdutosModel::mdlAdicionarProduto($tabela,$dados);
					var_dump($resposta);
					if($resposta == "ok"){
								echo '<script>

										swal({
					
											type: "success",
											title: "Cadastrado com sucesso!",
											showConfirmButton: true,
											confirmButtonText: "Fechar"
					
										}).then(function(result){
					
											if(result.value){
											
												window.location = "produtos";
					
											}
					
										});
									
					
									</script>';
					}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "Campos obrigatórios devem ser preenchidos e não conter caracteres especiais!",
						  showConfirmButton: true,
						  confirmButtonText: "Fechar"
						  }).then(function(result){
							if (result.value) {

							window.location = "produtos";

							}
						})

			  	</script>';
			}
		}

	}


			/*=============================================
		EDITAR PRODUTO
		=============================================*/

		static public function ctrEditarproduto(){

		if(isset($_POST["editarDescricao"])){

			if(preg_match('/^[a-zA-Z0-9áéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescricao"]) &&
			preg_match('/^[0-9]+$/', $_POST["editarEstoque"]) &&	
			preg_match('/^[0-9.]+$/', $_POST["editarPrecoCompra"]) &&
			preg_match('/^[0-9.]+$/', $_POST["editarPrecoVenda"])){

				/*=============================================
				VALIDAR IMAGEM
				=============================================*/

				$rotaImagem = $_POST["imagemAtual"];

				if(isset($_FILES["editarImagem"]["tmp_name"]) && !empty($_FILES["editarImagem"]["tmp_name"])){

					list($largura, $altura) = getimagesize($_FILES["editarImagem"]["tmp_name"]);

					$novaLargura = 500;
					$novaAltura = 500;

					/*=============================================
					CRIAMOS A PASTA ONDE SERÁ GUARDADA A IMAGEM DO PRODUTO					=============================================*/

					$pasta = "view/img/produtos/".$_POST["editarCodigo"];

					/*=============================================
					PRIMEIRO PERGUNTAMOS SE EXISTE OUTRA IMAGEM NA BD
					=============================================*/

					if(!empty($_POST["imagemAtual"]) && $_POST["imagemAtual"] != "view/img/produtos/default/anonymous.png"){

						unlink($_POST["imagemAtual"]);

					}else{

						mkdir($pasta, 0755);	
					
					}
					
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImagem"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS A IMAGEM NA PASTA
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rotaImagem = "view/img/produtos/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";

						$origem = imagecreatefromjpeg($_FILES["editarImagem"]["tmp_name"]);						

						$destino = imagecreatetruecolor($novaLargura, $novaAltura);

						imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

						imagejpeg($destino, $rotaImagem);

					}

					if($_FILES["editarImagem"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL pas$pasta
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rotaImagem = "view/img/produtos/".$_POST["editarCodigo"]."/".$aleatorio.".png";

						$origem = imagecreatefrompng($_FILES["editarImagem"]["tmp_name"]);						

						$destino = imagecreatetruecolor($novaLargura, $novaAltura);

						imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

						imagepng($destino, $rotaImagem);

					}

				}

				$tabela = "produtos";

				$dados = array("id_categoria" => $_POST["editarCategoria"],
							"codigo" => $_POST["editarCodigo"],
							"descricao" => $_POST["editarDescricao"],
							"estoque" => $_POST["editarEstoque"],
							"preco_compra" => $_POST["editarPrecoCompra"],
							"preco_venda" => $_POST["editarPrecoVenda"],
							"imagem" => $rotaImagem);

				$resposta = ProdutosModel::mdlEditarproduto($tabela, $dados);

				if($resposta == "ok"){

					echo'<script>

						swal({
							type: "success",
							title: "Produto alterado com sucesso!",
							showConfirmButton: true,
							confirmButtonText: "Fechar"
							}).then(function(result){
										if (result.value) {

										window.location = "produtos";

										}
									})

						</script>';

				}


			}else{

				echo'<script>

					swal({
						type: "error",
						title: "Campos obrigatórios devem ser preenchidos e não conter caracteres especiais!",
						showConfirmButton: true,
						confirmButtonText: "Fechar"
						}).then(function(result){
							if (result.value) {

							window.location = "produtos";

							}
						})

				</script>';
			}
		}

	}

		/*=============================================
	EXCLUIR PRODUTO
	=============================================*/
	static public function ctrExcluirProduto(){

			
		if(isset($_GET["idProduto"])){	

				$tabela ="produtos";
				$dados = $_GET["idProduto"];

				if($_GET["imagem"] != "" && $_GET["imagem"] != "view/img/produtos/default/anonymous.png"){

					unlink($_GET["imagem"]);
					rmdir('view/img/produtos/'.$_GET["codigo"]);

				}

				$resposta = ProdutosModel::mdlExcluirProduto($tabela, $dados);
				//var_dump($resposta);
				if($resposta == "ok"){

					echo'<script>

					swal({
						position: "top-end",
						type: "success",
						title: "Produto excluído com sucesso!",
						showConfirmButton: false,
						timer: 1500
					}).then(function(result){
									if (result.value) {

									window.location = "produtos";

									}
								})

					</script>';

				}		
			
			}
	}
		



} //Fim da Classe