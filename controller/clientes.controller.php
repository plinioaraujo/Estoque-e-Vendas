<?php
class ControllerClientes{
   
       /*=============================================
       ADICIONAR CLIENTES
       =============================================*/
   
       static public function ctrAdicionarCliente(){
   
           if(isset($_POST["novoCliente"])){
   
               if(preg_match('/^[a-zA-Z0-9çáéíóúÇÁÉÍÓÚ ]+$/', $_POST["novoCliente"])  &&
                    preg_match('/^[0-9]+$/', $_POST["novoDocumento"]) &&
                    preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["novoEmail"]) && 
                    preg_match('/^[()\-0-9 ]+$/', $_POST["novoTelefone"]) && 
                    preg_match('/^[()\-0-9 ]+$/', $_POST["novoCelular"]) && 
                    preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["novoLogradouro"]) ){
                  //  $telefone = preg_replace('/[^0-9]/', '', $_POST["novoTelefone"]);
                  //  $celular = preg_replace('/[^0-9]/', '', $_POST["novoCelular"]);
                  // var_dump($telefone);
                  // var_dump($celular);
                    
                    
                      $tabela = "clientes";
   
                      $dados = array("nome"=>$_POST["novoCliente"],
                                  "cpf"=>$_POST["novoDocumento"],
                                  "email"=>$_POST["novoEmail"],
                                  "telefone"=>$_POST["novoTelefone"],
                                  "celular"=>$_POST["novoCelular"],
                                  "logradouro"=>$_POST["novoLogradouro"],
                                  "data_nascimento"=>$_POST["novaDataNascimento"]);
                                 //var_dump($dados);
                     
                      $resposta = ClientesModel::mdlAdicionarCliente($tabela, $dados);
                       
                      if($resposta == "ok"){
   
                       echo'<script>
   
                       swal({
                             type: "success",
                             title: "Gravado com sucesso!",
                             showConfirmButton: true,
                             confirmButtonText: "Fechar"
                             }).then(function(result){
                                       if (result.value) {
   
                                       window.location = "clientes";
   
                                       }
                                   })
   
                       </script>';
   
                   }
   
               }else{
   
                   echo'<script>
   
                       swal({
                             type: "error",
                             title: "Os campos não podem ficar vazios ou conter caracteres especiais!",
                             showConfirmButton: true,
                             confirmButtonText: "Cerrar"
                             }).then(function(result){
                               if (result.value) {
   
                               window.location = "clientes";
   
                               }
                           })
   
                     </script>';
   
   
   
               }
   
           }
             
       }
  /*=============================================
  LISTAR CLIENTES
  =============================================*/
  static public function ctrListarClientes($item, $valor){

    $tabela = "clientes";

    $resposta = ClientesModel::mdlListarClientes($tabela, $item, $valor);
    
    return $resposta;
  }
     

    /*=============================================
      EDITAR CLIENTES
      =============================================*/

     static public function ctrEditarCliente(){
   
           if(isset($_POST["editarCliente"])){
   
               if(preg_match('/^[a-zA-Z0-9çáéíóúÇÁÉÍÓÚ ]+$/', $_POST["editarCliente"])  &&
                    preg_match('/^[0-9]+$/', $_POST["editarDocumento"]) &&
                    preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) && 
                    preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefone"]) && 
                    preg_match('/^[()\-0-9 ]+$/', $_POST["editarCelular"]) && 
                    preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editarLogradouro"]) ){

                  //  $telefone = preg_replace('/[^0-9]/', '', $_POST["editarTelefone"]);
                  //  $celular = preg_replace('/[^0-9]/', '', $_POST["editarCelular"]);
                  // var_dump($telefone);
                  // var_dump($celular);
                    
                    
                      $tabela = "clientes";
   
                      $dados = array("nome"=>$_POST["editarCliente"],
                                  "cpf"=>$_POST["editarDocumento"],
                                  "email"=>$_POST["editarEmail"],
                                  "telefone"=>$_POST["editarTelefone"],
                                  "celular"=>$_POST["editarCelular"],
                                  "logradouro"=>$_POST["editarLogradouro"],
                                  "data_nascimento"=>$_POST["editarDataNascimento"]);

                                  //var_dump($dados);
                     
                      $resposta = ClientesModel::mdlEditarCliente($tabela, $dados);
                       
                      if($resposta == "ok"){
   
                       echo'<script>
   
                       swal({
                             type: "success",
                             title: "Cliente atualizado com sucesso!",
                             showConfirmButton: true,
                             confirmButtonText: "Fechar"
                             }).then(function(result){
                                       if (result.value) {
   
                                       window.location = "clientes";
   
                                       }
                                   })
   
                       </script>';
   
                   }
   
               }else{
   
                   echo'<script>
   
                       swal({
                             type: "error",
                             title: "Os campos não podem ficar vazios ou conter caracteres especiais!",
                             showConfirmButton: true,
                             confirmButtonText: "Fechar"
                             }).then(function(result){
                               if (result.value) {
   
                               window.location = "clientes";
   
                               }
                           })
   
                     </script>';
   
   
   
               }
   
           }

             
       }




  /*=============================================
  EXCLUIR CLIENTE
  =============================================*/

  static public function ctrExcluirCliente(){

    if(isset($_GET["idCliente"])){

      $tabela ="clientes";
      $dados = $_GET["idCliente"];

      $resposta = ClientesModel::mdlExcluirCliente($tabela, $dados);

      if($resposta == "ok"){

        echo'<script>

        swal({
            type: "success",
            title: "O cliente foi excluído com sucesso!",
            showConfirmButton: true,
            confirmButtonText: "Fechar"
            }).then(function(result){
                if (result.value) {

                window.location = "clientes";

                }
              })

        </script>';

      }   

    }

  }

      
}


