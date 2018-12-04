/*==================================================
SCRIPT PARA CARREGAMENTO DE DADOS DINAMICO
=====================================================*/

/* $.ajax({
	url:"ajax/datatable-vendas.ajax.php",
	success: function(resposta){
		console.log("resposta", resposta);
	}
}) */


$('.tabelaVendas').DataTable( {
    "ajax": "ajax/datatable-vendas.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Processando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "Não foram encontrados registros",
			"sEmptyTable":     "Nenhum dado disponível nesta tabela",
			"sInfo":           "Mostrando registros de _START_ ao _END_ de um total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros de 0 ao 0 de um total de 0",
			"sInfoFiltered":   "(filtrado de um total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Carregando...",
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


/*=============================================
ADICIONANDO PRODUTOS A TABELA DE VENDAS
=============================================*/

$(".tabelaVendas tbody").on("click", "button.adicionarProduto", function(){

	var idProduto = $(this).attr("idProduto");
	//console.log("idProduto",idProduto);

	$(this).removeClass("btn-primary adicionarProduto");
	$(this).addClass("btn-default");

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
			dataType: "json",
			success:function(resposta){
				
				var descricao = resposta["descricao"];
				var estoque = resposta["estoque"];
				var preco = resposta["preco_venda"];	

				if (estoque == 0) {
					swal({
						title: "Não há estoque disponível!!",
						type: "error",
						confirmButtonText:"Fechar"
					});

					$("button[idProduto='"+idProduto+"']").addClass('btn-primary adicionarProduto');
					return;
				}

				$(".novoProduto").append(

					'<div class="row" style="padding:5px 15px">'+ 
										
					'<!-- Descrição do produto -->'+
					'<div class="col-xs-6" style="padding-right:0px">'+
						'<div class="input-group">'+
							'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs excluirProduto" idProduto="'+ idProduto + '"><i class="fa fa-times"></i></button></span>'+
							'<input type="text" class="form-control adicionarProduto" name="adicionarProduto" value="'+ descricao +'" readonly>'+
						'</div>'+
					'</div> '+

					'<!-- Quantidade do Produto -->'+
					'<div class="col-xs-3">'+
						'<input type="number" class="form-control novaQuantidadeProduto" name="novaQuantidadeProduto" value="1" estoque="'+ estoque + '" min="1" placeholder="0" required>'+
					'</div>'+

					'<!-- Preço do produto -->'+
					'<div class="col-xs-3" style="padding-left:0px">'+
						'<div class="input-group">'+
							'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
							'<input type="number" min="1" class="form-control novoPrecoProduto"  name="novoPrecoProduto" value="' + preco + '" readonly>'+
						'</div>'+
					'</div>'+ 
					'</div>'+ 
				'</div>'
					
				)

			}

		})

});

/*=============================================
QUANDO CARREGUE A TABELA DE PRODUTOS EM VENDAS A CADA NAVEGAÇÃO 
=============================================*/


$(".tabelaVendas").on("draw.dt", function(){

	//console.log("Tabela carregada");
	if(localStorage.getItem("excluirProduto") != null){

		var listaIdProdutos = JSON.parse(localStorage.getItem("excluirProduto"));

		for(var i = 0; i < listaIdProdutos.length; i++){

			$("button.recuperarBotao[idProduto='"+listaIdProdutos[i]["idProduto"]+"']").removeClass('btn-default');
			$("button.recuperarBotao[idProduto='"+listaIdProdutos[i]["idProduto"]+"']").addClass('btn-primary adicionarProduto');

		}


	}


})


/*=============================================
EXCLUIR PRODUTOS DE DA VENDA E RECUPERAR O BOTÃO DE ADICIONAR
=============================================*/
	var idExcluirProduto = [];
$(".formVenda").on("click", "button.excluirProduto", function(){
	//console.log("Passou no botão");

	$(this).parent().parent().parent().parent().remove();

	var idProduto = $(this).attr("idProduto");
	//console.log("ID",idProduto);

	//Armazenar no LOCALSTORAGE o ID do Produto à ser excluído
	if(localStorage.getItem("excluirProduto") == null){

		idExcluirProduto = [];

	}else{
		idExcluirProduto.concat(localStorage.getItem("excluirProduto"));
	}

	idExcluirProduto.push({"idProduto":idProduto});

	localStorage.setItem("excluirProduto",JSON.stringify(idExcluirProduto));

	$("button.recuperarBotao[idProduto='" + idProduto +"']").removeClass("btn-default");
	$("button.recuperarBotao[idProduto='" + idProduto +"']").addClass("btn-primary adicionarProduto");



});



/*=============================================
ADICIONANDO PRODUTOS A PARTIR DO BOTÃO EM DISPOSITIVOS MÓVEIS
=============================================*/

var numProduto = 0;
$(".btnAdicionarProduto").click(function(){

	numProduto++;

	var dados = new FormData();
	dados.append("todosProdutos", "ok");

	$.ajax({

		url:"ajax/produtos.ajax.php",
		method: "POST",
		data: dados,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(resposta){

			//console.log("resposta", resposta);
			
			$(".novoProduto").append(

				'<div class="row" style="padding:5px 15px">'+ 
									
				'<!-- Descrição do produto -->'+
				'<div class="col-xs-6" style="padding-right:0px">'+
					'<div class="input-group">'+
						'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs excluirProduto" idProduto="'+  '"><i class="fa fa-times"></i></button></span>'+
						
						'<select class="form-control novaDescricaoProduto" id="produto'+numProduto+'" idProduto name="novaDescricaoProduto" required>' +

						'<option>Selecione o produto</option>' +
						
						'</select>'+

					'</div>'+
				'</div> '+

				'<!-- Quantidade do Produto -->'+
				'<div class="col-xs-3 entradaQuantidade">'+
					'<input type="number" id="nqp" class="form-control novaQuantidadeProduto" name="novaQuantidadeProduto" value="1" estoque min="1" placeholder="0" required>'+
				'</div>'+

				'<!-- Preço do produto -->'+
				'<div class="col-xs-3 entradaPreco" style="padding-left:0px">'+
					'<div class="input-group">'+
						'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
						'<input type="number" min="1" class="form-control novoPrecoProduto"  name="novoPrecoProduto" value readonly>'+
					'</div>'+
				'</div>'+ 
				'</div>'+ 
			'</div>'
				
			);

			//ADICIONAR OS PRODUTOS AO SELECT
			resposta.forEach(funcaoForEach);
			function funcaoForEach(item, index) {

				if (item.estoque != 0) {
							
						$("#produto"+numProduto).append(
						'<option idProduto="' + item.id + '" value="'+item.descricao+'">'+ item.descricao+'</option>'
					)
				}	
			}	

		}

	})

})


/*=============================================
SELECIONAR PRODUTO
=============================================*/


$(".formVenda").on("change", "select.novaDescricaoProduto", function(){

	var nomeProduto = $(this).val();

	var novaDescricaoProduto = $(this).parent().parent().parent().children().children().children(".novaDescricaoProduto");

	var novoPrecoProduto = $(this).parent().parent().parent().children(".entradaPreco").children().children(".novoPrecoProduto");

	var novaQuantidadeProduto = $(this).parent().parent().parent().children(".entradaQuantidade").children(".novaQuantidadeProduto");

	

	 var dados = new FormData();
	 dados.append("nomeProduto", nomeProduto);
	
	$.ajax({

		url:"ajax/produtos.ajax.php",
		method: "POST",
		data: dados,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(resposta){

		
			$(novaDescricaoProduto).attr("idProduto", resposta["id"]);
      	    $(novaQuantidadeProduto).attr("stock", resposta["stock"]);
      	    $(novaQuantidadeProduto).attr("estoque", Number(resposta["estoque"])-1);
      	    $(novoPrecoProduto).val(resposta["preco_venda"]);
      	    $(novoPrecoProduto).attr("precoReal", resposta["preco_venda"]);
			

		}
	})


})



























