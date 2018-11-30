/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tabelas").on("click", ".btnEditarCliente", function(){

	var idCliente = $(this).attr("idCliente");

	var dados = new FormData();
    dados.append("idCliente", idCliente);

    $.ajax({

      url:"ajax/clientes.ajax.php",
      method: "POST",
      data: dados,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(resposta){
        ///console.log("resposta",resposta);
      	 $("#idCliente").val(resposta["id"]);
	       $("#editarCliente").val(resposta["nome"]);
	       $("#editarDocumento").val(resposta["cpf"]);
	       $("#editarEmail").val(resposta["email"]);
	       $("#editarCelular").val(resposta["celular"]);
         $("#editarTelefone").val(resposta["telefone"]);
	       $("#editarLogradouro").val(resposta["logradouro"]);
          $("#editarDataNascimento").val(resposta["data_nascimento"]);
	  }

  	})

})


/*=============================================
EXCLUIR CLIENTE
=============================================*/
$(".tabelas").on("click", ".btnExcluirCliente", function(){

  var idCliente = $(this).attr("idCliente");
  
  swal({
         title: 'Tem certeza que quer excluir esta categoria?',
        text: "Não é possível desfazer a ação.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
         cancelButtonText: 'Cancelar',
        confirmButtonText: 'Excluir'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?rota=clientes&idCliente="+idCliente;
        }

  })

})