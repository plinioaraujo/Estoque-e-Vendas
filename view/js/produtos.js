/*/==================================================
SCRIPT PARA CARREGAMENTO DE DADOS DINAMICO
=====================================================*/

/*$.ajax({
	url:"ajax/datatable-produtos.ajax.php",
	success: function(resposta){
		console.log("resposta", resposta);
	}
})
*/

   $('.tabelaProdutos').DataTable( {
        "ajax": "ajax/datatable-produtos.ajax.php",
         "deferRender": true,
		"retrieve": true,
		"processing": true,
		 "language": {

			"sProcessing":     "Processando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "Não retornou resultados",
			"sEmptyTable":     "Não  há registros disponíveis!",
			"sInfo":           "Mostrando registros de _START_ ao _END_ de um total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros de 0 a 0 de um total de 0",
			"sInfoFiltered":   "(filtrado de um total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Carregando dados...",
			"oPaginate": {
			"sFirst":    "Primeiro",
			"sLast":     "Último",
			"sNext":     "Próximo",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Ativar para ordenar a coluna de maneira ascendente",
				"sSortDescending": ": Ativar para ordenar a coluna de maneira descendente"
			}

	}
} );


$("#novaCategoria").change(function(){

  	var idCategoria = $(this).val();

  	var dados = new FormData();
  	dados.append("idCategoria",idCategoria);

  	$.ajax({
  		url:"ajax/produtos.ajax.php",
        method: "POST",
        data: dados,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (resposta) {

			if(!resposta){
				var novoCodigo = idCategoria + "01";
				$("#novoCodigo").val(novoCodigo);
			}else{
				var novoCodigo = Number(resposta["codigo"]) + 1;
				$("#novoCodigo").val(novoCodigo);	
			}
			
			//console.log("novoCodigo",novoCodigo);
        }
  	})

})

/*=============================================
ADICIONANDO PRECO DE VENDA
=============================================*/

$("#novoPrecoCompra, #editarPrecoCompra").change(function(){

	

		if($(".porcentagem").prop("checked")){

			var valorPorcentagem = $(".novaPorcentagem").val();
			
			var porcentagem = Number(($("#novoPrecoCompra").val()*valorPorcentagem/100))+Number($("#novoPrecoCompra").val());
			

			var editarPorcentagem = Number(($("#editarPrecoCompra").val()*valorPorcentagem/100))+Number($("#editarPrecoCompra").val());
	
			$("#novoPrecoVenda").val(porcentagem);
			$("#novoPrecoVenda").prop("readonly",true);
	
			$("#editarPrecoVenda").val(editarPorcentagem);
			$("#editarPrecoVenda").prop("readonly",true);
	
		}
	
})

/*=============================
MUDANÇA DE PORCENTAGEM
==================================*/

$(".novaPorcentagem").change(function(){

	if($(".porcentagem").prop("checked")){

		var valorPorcentagem = $(this).val();
		
		var porcentagem = Number(($("#novoPrecoCompra").val()*valorPorcentagem/100))+Number($("#novoPrecoCompra").val());

		var editarPorcentagem = Number(($("#editarPrecoCompra").val()*valorPorcentagem/100))+Number($("#editarPrecoCompra").val());

		$("#novoPrecoVenda").val(porcentagem);
		$("#novoPrecoVenda").prop("readonly",true);

		$("#editarPrecoVenda").val(editarPorcentagem);
		$("#editarPrecoVenda").prop("readonly",true);
	

	}
	
})

$(".porcentagem").on("ifUnchecked",function(){

	$("#novoPrecoVenda").prop("readonly",false);
	$("#editarPrecoVenda").prop("readonly",false);

})

$(".porcentagem").on("ifChecked",function(){

	$("#novoPrecoVenda").prop("readonly",true);
	$("#editarPrecoVenda").prop("readonly",true);

})

 
/*=============================================
CARREGANDO IMAGEM DO PRODUTO
=============================================*/
$(".novaImagem").change(function () {
  
    var imagem = this.files[0];

    /*=============================================
  	VALIDAÇÃO IMAGEM SEJA JPG OU PNG
  	=============================================*/

    if (imagem["type"] != "image/jpeg" && imagem["type"] != "image/png") {

        $(".novaImagem").val("");

        swal({
            title: "Erro ao carregar a imagem",
            text: "A imagem deve estar no formato JPG ou PNG",
            type: "error",
            confirmButtonText: "Fechar"
        });
    } else if (imagem["size"] > 2000000) {

        $(".novaImagem").val("");

        swal({
            title: "Erro ao carregar a imagem",
            text: "A imagem não deve ter o tamanho maior que 2Mb",
            type: "error",
            confirmButtonText: "Fechar"

        });

    } else {
        var dadosImagem = new FileReader;
        dadosImagem.readAsDataURL(imagem);

        $(dadosImagem).on("load", function (event) {

            var rotaImagem = event.target.result;

            $(".visualizar").attr("src", rotaImagem);
        })
    }

})

/*=============================================
EDITAR PRODUTO
=============================================*/

$(".tabelaProdutos tbody").on("click","button.btnEditarProduto",function(){

		var idProduto = $(this).attr("idProduto");
		//console.log("idProduto",idProduto);

		var dados = new FormData();
		dados.append("idProduto", idProduto);
		//console.log(dados.get('idProduto'));
		 $.ajax({
	
		  url:"ajax/produtos.ajax.php",
		  method: "POST",
		  data: dados,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(resposta){
			  //console.log("resposta",resposta);
			   var dadosCategoria = new FormData();
			  dadosCategoria.append("idCategoria",resposta["id_categoria"]);
	
			   $.ajax({
	
				  url:"ajax/categorias.ajax.php",
				  method: "POST",
				  data: dadosCategoria,
				  cache: false,
				  contentType: false,
				  processData: false,
				  dataType:"json",
				  success:function(resposta){
					  //console.log("resposta",resposta);
					  $("#editarCategoria").val(resposta["id"]);
					  $("#editarCategoria").html(resposta["descricao"]);
	
				  }
	
			  })
	
			   $("#editarCodigo").val(resposta["codigo"]);
	
			   $("#editarDescricao").val(resposta["descricao"]);
	
			   $("#editarEstoque").val(resposta["estoque"]);
	
			   $("#editarPrecoCompra").val(resposta["preco_compra"]);
	
			   $("#editarPrecoVenda").val(resposta["preco_venda"]);
	
			   if(resposta["imagem"] != ""){
	
				   $("#imagemAtual").val(resposta["imagem"]);
	
				   $(".visualizar").attr("src",  resposta["imagem"]);
	
			   }
		
		  }

	  }) 
	
	})


/*=============================================
EXCLUIR PRODUTO
=============================================*/

$(".tabelaProdutos tbody").on("click","button.btnExcluirProduto",function(){
	

	var idProduto = $(this).attr("idProduto");
	var codigo = $(this).attr("codigo");
	var imagem = $(this).attr("imagem");
	
	//console.log("imagem",imagem);

	swal({
		title: 'O produto será excluído! Tem certeza?',
		text: "É possível cancelar a ação!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Sim, excluir produto!'		
	  }).then(function(result){
	
		if(result.value){
		
			window.location = "index.php?rota=produtos&idProduto="+idProduto+"&imagem="+imagem+"&codigo="+codigo;
	
		}
	
	  })



})
