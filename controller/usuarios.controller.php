<?php
   
class ControllerUsuarios{


 static public function ctrAcessoUsuario(){
         
          if(isset($_POST["inLogin"])){ 
          
          
           if(preg_match('/^[a-zA-Z0-9]+$/',$_POST["inLogin"]) && 
              preg_match('/^[a-zA-Z0-9]+$/',$_POST["senhaLogin"])){
          
               
                $encriptar = crypt($_POST["senhaLogin"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$' );
               //var_dump($_POST["senhaLogin"]);
               $tabela = "usuarios";
               
               $item = "login";
               $valor =  $_POST["inLogin"];
                              
               $retorno = UsuariosModel::MdlMostrarUsuarios($tabela, $item, $valor);
               
             
              if($retorno["login"] == $_POST["inLogin"] && $retorno["senha"] == $encriptar){

				  if($retorno["status"] == 1) {

				  $_SESSION["iniciarSessao"] = "ok";
                  $_SESSION["id"]=$retorno["id"];
                  $_SESSION["nome"]=$retorno["nome"];
                  $_SESSION["login"]=$retorno["login"];
                  $_SESSION["senha"]=$retorno["senha"];
                  $_SESSION["foto"] = $retorno["foto"];
				  $_SESSION["perfil"] = $retorno["perfil"];
                  

				  date_default_timezone_set("America/Sao_Paulo");

				  $data = date("Y-m-d");
				  $hora = date("H:i:s");

				  $dataAtual = $data. ' ' .$hora;

				  $item1 = "ultimo_login";
				  $valor1 = $dataAtual;

				  $item2 = "id";
				  $valor2 = $retorno["id"];

				  $ultimoLogin = UsuariosModel::mdlAtualizarUsuario($tabela, $item1,$valor1,$item2,$valor2);

				  if($ultimoLogin == "ok"){
              
                	echo '<script>

						window.location="home";
                      

					</script>';

				}
					
					}else{
						echo '<br><div class="alert alert-danger">Usuário ainda não está ativado, favor contactar o Administrador!</div>';
					}

				}else{

					echo '<br><div class="alert alert-danger">Erro ao acessar, Tente novamente</div>';

				}
              // var_dump($_SESSION["iniciarSessao"]);
               //var_dump($retorno["senha"]);
               //var_dump($retorno["login"]);
               

			}	

          
          }
            
          }
    
    /*========================================
             CADASTRO DE USUARIO
    ==========================================*/

    
    static public function ctrCadastrarUsuario(){
        
        if(isset($_POST["inLogin"])){
            
            if(preg_match('/^[a-zA-z0-9áéíóúÁÉÍÓÚ ]+$/',$_POST["inNome"]) &&
                   preg_match('/^[a-zA-z0-9]+$/',$_POST["inLogin"]) &&
                   preg_match('/^[a-zA-z0-9]+$/',$_POST["inSenha"])){
                
                    /*=============================================
                            VALIDAÇÃO IMAGEM
                     =========================================*/
                $rota = "";
               if(isset($_FILES["inFoto"]["tmp_name"])) {
                   
                   
                  list($largura, $altura) = getimagesize($_FILES["inFoto"]["tmp_name"]);
                   
                   $novaLargura = 500;
                   $novaAltura = 500;
                   
                     /*=============================================
                        CRIAR PASTA DAS IMAGENS CARREGADAS
                     =========================================*/
                   
                   $pasta = "view/img/usuarios/".$_POST["inLogin"]; 
                  // $pasta = strtolower($pasta);
                   mkdir($pasta,0755);
                   
                   
                   /*=============================================
					DE ACORDO COM O TIPO DE IMAGEM APLICAMOS AS FUNÇOES DO PHP
					=============================================*/
                   
                   if($_FILES["inFoto"]["type"] == "image/jpeg"){
                   
                    //SALVAMOS A IMAGEM NA PASTA
                       
                       
                       $aleatorio = mt_rand(100,999);
                      $rota = "view/img/usuarios/".$_POST["inLogin"]."/".$aleatorio.".jpg";
                       
                       $origem = imagecreatefromjpeg($_FILES["inFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($novaLargura, $novaAltura);

						imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

						imagejpeg($destino, $rota);
                       
                   
                 //  var_dump(getimagesize($_FILES["inFoto"]["tmp_name"]));
               }
                  
                   
                   if($_FILES["inFoto"]["type"] == "image/png"){
                   
                    //SALVAMOS A IMAGEM NA PASTA
                       
                       
                       $aleatorio = mt_rand(100,999);
                     $rota = "view/img/usuarios/".$_POST["inLogin"]."/".$aleatorio.".jpg";
                       
                       $origem = imagecreatefrompng($_FILES["inFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($novaLargura, $novaAltura);

						imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

						imagepng($destino, $rota);
                       
                   
                 //  var_dump(getimagesize($_FILES["inFoto"]["tmp_name"]));
               }
                   
               }
                
               
                $tabela = "usuarios";
                
                
                $encriptar = crypt($_POST["inSenha"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$' );
                
               $dados = array(
                   "nome" =>$_POST["inNome"],
                   "login" => $_POST["inLogin"],
                   "senha" =>  $encriptar,
                   "perfil" => $_POST["inPerfil"],
                   "rota" => $rota);                
                   
                $retorno = UsuariosModel::MdlAdicionarUsuario($tabela,$dados);
                var_dump($retorno);
                if($retorno == "ok"){
                    
                       
                  	echo '<script>

					swal({

						type: "success",
						title: "Cadastrado com sucesso!",
						showConfirmButton: true,
						confirmButtonText: "Fechar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';

                     
                }
            
            }else {
                    
                  	echo '<script>

					swal({

						type: "error",
						title: "O login não pode ficar vazio ou conter caracteres especiais!",
						showConfirmButton: true,
						confirmButtonText: "Fechar"

					}).then(function(result){

						if(result.value){
						
							window.location = "usuarios";

						}

					});
				

				</script>';
                        }
            }
        
        
    }
    
     
    /*=============================================
	LISTAR USUARIOS
	=============================================*/
    
    static public function ctrListarUsuarios($item, $valor){

		$tabela = "usuarios";

		$retorno = UsuariosModel::MdlMostrarUsuarios($tabela, $item, $valor);

		return $retorno;
	}



    
    /*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario(){


			if(isset($_POST["editarLogin"])){ 



				if(preg_match('/^[a-zA-Z0-áéíóúÁÉÍÓÚ ]+$/', $_POST["editarNome"])){

									/*=============================================
								VALIDAR IMAGEN
								=============================================*/

							$rota = $_POST["fotoAtual"];

							if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

										list($largura, $altura) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

										$novaLargura = 500;
										$novaAltura = 500;

									/*=============================================
										CRIAMOS A PASTA PARA GUARDAR A FOTO DO USUARIO
										=============================================*/

										$pasta = "view/img/usuarios/".$_POST["editarLogin"];
										

										/*=============================================
										PRIMEIRO PERGUNTAMOS SE A FOTO EXISTE NA PASTA
										=============================================*/

										if(!empty($_POST["fotoAtual"])){

											unlink($_POST["fotoAtual"]);

										}else{

											mkdir($pasta, 0755);

										}	//VERIFICA SE FOTO EXISTE NA BASE

										/*=============================================
										DE ACORDO COM O TIPO DE IMAGEM APLICAMOS AS FUNÇOES PADRÕES DO PHP
										=============================================*/


										if($_FILES["editarFoto"]["type"] == "image/jpeg"){

											/*=============================================
											SALVAMOS A IMAGEM NA PASTA
											=============================================*/

											$aleatorio = mt_rand(100,999);

											$rota = "view/img/usuarios/".$_POST["editarLogin"]."/".$aleatorio.".jpg";

											$origem = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

											$destino = imagecreatetruecolor($novaLargura, $novaAltura);

											imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

											imagejpeg($destino, $rota);

										} //VALIDA A IMAGEM SE É JPEG


											if($_FILES["editarFoto"]["type"] == "image/png"){

											/*=============================================
											salvamos a imagem na pasta
											=============================================*/

											$aleatorio = mt_rand(100,999);

											$rota = "view/img/usuarios/".$_POST["editarLogin"]."/".$aleatorio.".png";

											$origem = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

											$destino = imagecreatetruecolor($novaLargura, $novaAltura);

											imagecopyresized($destino, $origem, 0, 0, 0, 0, $novaLargura, $novaAltura, $largura, $altura);

											imagepng($destino, $rota);


										} //valida a imagem se é PNG
									}


									$tabela = "usuarios";

								if($_POST["editarSenha"] != ""){

											if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarSenha"])){

												$encriptar = crypt($_POST["editarSenha"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

											}else{

												echo'<script>

														swal({
															  type: "error",
															  title: "A senha não pode conter caracteres especiais!",
															  showConfirmButton: true,
															  confirmButtonText: "Fechar"
															  }).then(function(result){
																if (result.value) {

																window.location = "usuarios";

																}
															})

												  	</script>';

											} //validação da senha

								}else{

									$encriptar = $_POST["senhaAtual"];

								} //verificar se a senha venho vazia



								$dados = array("nome" => $_POST["editarNome"],
											   "login" => $_POST["editarLogin"],
											   "senha" => $encriptar,
											   "perfil" => $_POST["editarPerfil"],
											   "foto" => $rota);

								$retorno = UsuariosModel::mdlEditarUsuario($tabela, $dados);

								var_dump($retorno);


								if($retorno == "ok"){

									echo'<script>

									swal({
										  type: "success",
										  title: "Usuário atualizado com sucesso",
										  showConfirmButton: true,
										  confirmButtonText: "Fechar"
										  }).then(function(result){
													if (result.value) {

													window.location = "usuarios";

													}
												})

									</script>';

								}
					}else{

							
							echo '<script>

									
								swal({
									  type: "error",
									  title: "Nome não pode conter caracteres especiais!",
									  showConfirmButton: true,
									  confirmButtonText: "Fechar"
									  }).then(function(result){
										if (result.value) {

										window.location = "usuarios";

										}
									})

						  	</script>';
					  	}
				
				}
			}



	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrExcluirUsuario(){

		if(isset($_GET["idUsuario"])){

			$tabela ="usuarios";
			$dados = $_GET["idUsuario"];

			if($_GET["fotoUsuario"] != ""){

				unlink($_GET["fotoUsuario"]);
				rmdir('view/img/usuarios/'.$_GET["login"]);

			}

			$resposta = UsuariosModel::mdlExcluirUsuario($tabela, $dados);

			if($resposta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "O usuário foi excluído com sucesso!",
					  showConfirmButton: true,
					  confirmButtonText: "Fechar"
					  }).then(function(result){
								if (result.value) {

								window.location = "usuarios";

								}
							})

				</script>';

			}		

		}

	}



}	

	

