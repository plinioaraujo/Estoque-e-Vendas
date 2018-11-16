<?php

class ControllerCategorias{

/*=============================================
	ADICIONAR CATEGORIAS
=============================================*/

	static public function ctrAdicionarCategoria(){

		if(isset($_POST["novaCategoria"])){
			if(preg_match('/^[a-zA-Z0-9çÇãÃõÕâÂáéíóúÁÉÍÓÚ ]+$/', $_POST["novaCategoria"])){	

				$tabela = "categorias";

				$dados = $_POST["novaCategoria"];

				$resposta = ModelCategorias::mdlAdicionarCategoria($tabela, $dados);

					if($resposta == "ok"){

						echo '<script>

								swal({
									  type: "success",
								  	title: "Gravado com sucesso!",
								  	showConfirmButton: true,
								  	confirmButtonText: "Fechar"
								  	}).then(function(result){
										if (result.value) {

											window.location = "categorias";

										}
									})

							</script>';

					}

				}else{

				echo'<script>

						swal({
							  type: "error",
							  title: "Favor preencher a categoria. Não pode haver caracteres especiais!",
							  showConfirmButton: true,
							  confirmButtonText: "Fechar"
							  }).then(function(result){
								if (result.value) {

								window.location = "categorias"


								}
							})

			  	</script>';
			}

		}

	}	


	/*=============================================
	LISTAR CATEGORIAS
	=============================================*/

	static public function ctrListarCategorias($item, $valor){

		$tabela = "categorias";

		$resposta = ModelCategorias::mdlListarCategorias($tabela, $item, $valor);

		return $resposta;
	
	}

	/*=============================================
	EDITAR CATEGORIAS
	=============================================*/
	static public function ctrEditarCategoria(){
		
		if(isset($_POST["editarCategoria"])){

			if(preg_match('/^[a-zA-Z0-9çÇãÃõÕâÂáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){	



				$tabela = "categorias";

				$dados = array("descricao"=>$_POST["editarCategoria"],"id"=>$_POST["idCategoria"]);

				$resposta = ModelCategorias::mdlEditarCategoria($tabela, $dados);

						if($resposta == "ok"){

							echo'<script>

							swal({
								  type: "success",
								  title: "A categoria foi alterada corretamente!",
								  showConfirmButton: true,
								  confirmButtonText: "Fechar"
								  }).then(function(result){
											if (result.value) {

											window.location = "categorias";

											}
										})

							</script>';

						}

			}else{
				echo'<script>

						swal({
							  type: "error",
							  title: "Favor preencher a categoria. Não pode haver caracteres especiais!",
							  showConfirmButton: true,
							  confirmButtonText: "Fechar"
							  }).then(function(result){
								if (result.value) {

								window.location = "categorias"


								}
							})

			  	</script>';
			}
		}		

	}

static public function ctrExcluirCategoria(){

		if(isset($_GET["idCategoria"])){

			$tabela ="categorias";
			$dados = $_GET["idCategoria"];

			$resposta = ModelCategorias::mdlExcluirCategoria($tabela, $dados);
			var_dump($resposta);
			if($resposta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "A categoria foi excluída com sucesso!",
						  showConfirmButton: true,
						  confirmButtonText: "Fechar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
			}
		}
		
	}



}//FINAL DA CLASSE