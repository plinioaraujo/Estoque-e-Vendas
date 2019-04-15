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
								
								'<input type="text" class="form-control novaDescricaoProduto" idProduto="'+idProduto+'" name="adicionarProduto" value="'+ descricao +'" readonly required>'+
						
							'</div>'+
						
						'</div> '+

						'<!-- Quantidade do Produto -->'+
						'<div class="col-xs-3">'+
							'<input type="number" class="form-control novaQuantidadeProduto" name="novaQuantidadeProduto" value="1" min="1" estoque="'+estoque+'" novoEstoque="'+Number(estoque-1)+'" required>'+
						'</div>'+

						'<!-- Preço do produto -->'+
						'<div class="col-xs-3 entradaPreco" style="padding-left:0px">'+
							'<div class="input-group">'+
								'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
								'<input type="text" class="form-control novoPrecoProduto" precoReal="' + preco + '" name="novoPrecoProduto" value="' + preco + '" readonly required>'+
							'</div>'+
						'</div>'+ 
					'</div>'
					
				)
				
				//SOMA O TOTAL DE PRECOS NA VENDA
				somarTotalPrecos();

				//adicionar imposto
				adicionarImposto();

				 // AGRUPAR PRODUTOS EM FORMATO JSON

				listarProdutos();

				//FORMATAR O PREÇO DOS PRODUTOS
				//$(".novoPrecoProduto").maskMoney();

				 // FORMATAR OS PRECOS DOS PRODUTOS

	        	$(".novoPrecoProduto").number(true, 2);


			}

		})

});

/*=============================================
QUANDO CARREGA A TABELA A CADA NAVEGAÇÃO
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
EXCLUIR PRODUTOS DA VENDA E RECUPERAR O BOTÃO DE ADICIONAR
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

	if($(".novoProduto").children().length == 0){

		
		$("#novoImpostoVenda").val(0);	
		$("#novoTotalVenda").val(0);	
		$("#totalVenda").val(0);	
		$("#novoTotalVenda").attr("total",0);
	}else{

		//SOMA O TOTAL DE PRECOS NA VENDA
		somarTotalPrecos();

		//adicionar imposto
		adicionarImposto();

		listarProdutos();

	}
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

				'<div class="row descr" style="padding:5px 15px">'+ 
									
				'<!-- Descrição do produto -->'+
				'<div class="col-xs-6" style="padding-right:0px">'+
					'<div class="input-group">'+
						'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs excluirProduto" idProduto="'+  '"><i class="fa fa-times"></i></button></span>'+
						
						'<select class="form-control novaDescricaoProduto"  id="produto'+numProduto+'" name="novaDescricaoProduto" required>' +

						'<option>Selecione o produto</option>' +
						
						'</select>'+

					'</div>'+
				'</div> '+

				'<!-- Quantidade do Produto -->'+
				'<div class="col-xs-3 entradaQuantidade">'+
				   '<input type="number" class="form-control novaQuantidadeProduto" name="novaQuantidadeProduto" min="1" value="1" estoque novoEstoque required>'+
	

				'</div>'+

				'<!-- Preço do produto -->'+
				'<div class="col-xs-3 entradaPreco" style="padding-left:0px">'+
					'<div class="input-group">'+
						'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
						'<input type="text" class="form-control novoPrecoProduto"  precoReal="" name="novoPrecoProduto" readonly>'+
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


				//SOMA O TOTAL DE PRECOS NA VENDA
				somarTotalPrecos();

				//adicionar imposto
				adicionarImposto();

				//listarProdutos();

	        // FORMATAR OS PRECOS DOS PRODUTOS

	        $(".novoPrecoProduto").number(true, 2);

	       //FORMATAR O PREÇO DOS PRODUTOS
			//	$(".novoPrecoProduto").maskMoney();

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
      	    $(novaQuantidadeProduto).attr("estoque", resposta["estoque"]);
      	    $(novaQuantidadeProduto).attr("novoEstoque", Number(resposta["estoque"])-1);
      	    $(novoPrecoProduto).val(resposta["preco_venda"]);
      	    $(novoPrecoProduto).attr("precoReal", resposta["preco_venda"]);
			

				listarProdutos();

		}
	})


})

/*=============================================
=   ALTERAR A QUANTIDADE DE PRODUTO        =
=============================================*/


$(".formVenda").on("change", "input.novaQuantidadeProduto", function(){

	var preco = $(this).parent().parent().children('.entradaPreco').children().children('.novoPrecoProduto');

	var precoFinal = $(this).val() * preco.attr("precoReal");

	preco.val(precoFinal);

	var novoEstoque = Number($(this).attr("estoque") - $(this).val());

	$(this).attr("novoEstoque", novoEstoque);
	
	if( Number($(this).val()) > Number($(this).attr("estoque"))){
		//console.log("novoEstoque",novoEstoque);
	

		/*=============================================
		SE A QUALNTIDADE É SUPERIOR AO ESTOQUE VOLTAR AOS VALORES INICIAIS
		=============================================*/

		$(this).val(1);

		var precoFinal = $(this).val() * preco.attr("precoReal");

		preco.val(precoFinal);

		//SOMA O TOTAL DE PRECOS NA VENDA
			somarTotalPrecos();


			//adicionarImposto();


		swal({
	      title: "A quantidade desejada para o produto não está disponíveil",
	      text: "Há somente "+$(this).attr("estoque")+" unidades!",
	      type: "error",
	      confirmButtonText: "Fechar"
	    });

	    return;
	}


			//SOMA O TOTAL DE PRECOS NA VENDA
			somarTotalPrecos();	

			adicionarImposto();

			listarProdutos();

})

/*=============================================
=            SOMAR TODOS OS PREÇOS            =
=============================================*/

function somarTotalPrecos(){

	var precoItem = $(".novoPrecoProduto");
	var arraySomaPreco = [];

	for (var i =0; i < precoItem.length;i++) {
		
		arraySomaPreco.push(Number($(precoItem[i]).val()));
	}

	//console.log("arraySomaPreco",arraySomaPreco);

	function somarArrayPrecos(total,numero){

		return total + numero;

	}

	var somaTotalPreco = arraySomaPreco.reduce(somarArrayPrecos);
	
	$("#novoTotalVenda").val(somaTotalPreco);
	$("#totalVenda").val(somaTotalPreco);
	$("#novoTotalVenda").attr("total",somaTotalPreco);


}

/*=====  End of SOMAR TODOS OS PREÇOS  ======*/



/*================================================
=            FUNÇÃO ADICIONAR IMPOSTO            =
================================================*/

function adicionarImposto(){
	var imposto = $("#novoImpostoVenda").val();
	var precoTotal = $("#novoTotalVenda").attr("total");

	var precoImposto = Number(precoTotal * imposto/100);

	var totalComImposto = Number(precoImposto) + Number(precoTotal);

	$("#novoTotalVenda").val(totalComImposto);
	$("#totalVenda").val(totalComImposto);

	$("#novoValorImposto").val(precoImposto);

	$("#totalAPagarSemImposto").val(precoTotal);


}

/*=====  End of FUNÇÃO ADICIONAR IMPOSTO  ======*/


/*================================================
=            QUANDO ALTERAR O IMPOSTO            =
================================================*/

$("#novoImpostoVenda").change(function(){

	adicionarImposto();
	listarProdutos();

})


/*=====  End of QUANDO ALTERAR O IMPOSTO  ======*/

/*=====================================================
=            FORMATAR VALOR TOTAL DA VENDA            =
=====================================================*/


	        // FORMATAR OS PRECOS DOS PRODUTOS

	        $("#novoTotalVenda").number(true, 2);

	       //FORMATAR O PREÇO DOS PRODUTOS
		//	$(".novoTotalVenda").maskMoney();



/*=====  End of FORMATAR VALOR TOTAL DA VENDA  ======*/



/*=====================================================
=            SELECIONAR METODO DE PAGAMENTO        =
=====================================================*/

$("#novoMetodoPagamento").change(function(){

	var metodoPagto = $(this).val();
	//console.log("metodoPagto", metodoPagto);

	if(metodoPagto == "Dinheiro"){

		$(this).parent().parent().removeClass("col-xs-6");

		$(this).parent().parent().addClass("col-xs-4");

		$(this).parent().parent().parent().children(".caixasMetodoPagamento").html(
		
		 '<div class="col-xs-4">'+ 

			 	'<div class="input-group">'+ 

			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

			 		'<input type="text" class="form-control" id="novoValorAVista" placeholder="000000" required>'+

			 	'</div>'+

			 '</div>'+

			 '<div class="col-xs-4" id="getValorAVista" style="padding-left:0px">'+

			 	'<div class="input-group">'+

			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

			 		'<input type="text" class="form-control" id="getNovoValorAVista" placeholder="000000" readonly required>'+

			 	'</div>'+

			 '</div>'
			 )

		// Formartar o Valor moeda
		$('#novoValorAVista').number( true, 2);
      	$('#getNovoValorAVista').number( true, 2);

		listarMetodosPagamento();

	}else  if(metodoPagto == "CC" || metodoPagto == "CD" ){ 
	
		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-6');

		 $(this).parent().parent().parent().children('.caixasMetodoPagamento').html(

		 	'<div class="col-xs-6" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  '<input type="number" min="0" class="form-control" id="novoCodigoTransacao" placeholder="Código de Transação"  required>'+
                       
                  '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
                '</div>'+

              '</div>')




	}else{
		$(this).parent().parent().removeClass('col-xs-4');

		$(this).parent().parent().addClass('col-xs-4');

		 $(this).parent().parent().parent().children('.caixasMetodoPagamento').html(

		 	'<div class="col-xs-6" style="padding-left:0px">'+
                        
                '<div class="input-group">'+
                     
                  
                '</div>'+

              '</div>')
	}

})

/*=====================================================
=            MUDA O VALOR À VISTA
=====================================================*/
$(".formVenda").on("change", "input#novoValorAVista", function(){

	var aVista = $(this).val();

	var mudanca = Number(aVista) - Number($("#novoTotalVenda").val());

	var getNovoValorAVista = $(this).parent().parent().parent().children('#getValorAVista').children().children('#getNovoValorAVista');

	getNovoValorAVista.val(mudanca);

	

})

/*=====================================================
=            MUDA O VALOR TRANSACAO CRÉDITO / DEBITO
=====================================================*/
$(".formVenda").on("change", "input#novoCodigoTransacao", function(){

	listarMetodosPagamento();

})


/*=====================================================
=            LISTAR TODOS OS PRODUTOS EM DADOS JSON
=====================================================*/

function listarProdutos(){

	var listaProdutos = [];

	//var id = "";
	
	var descricao = $(".novaDescricaoProduto");
	
	var quantidade = $(".novaQuantidadeProduto");

	var preco = $(".novoPrecoProduto");

	//var total = "";

	for (var i = 0; i < descricao.length; i++) {
		
	listaProdutos.push({
		    "id" : $(descricao[i]).attr("idProduto"),
			"descricao" : $(descricao[i]).val(),
			"quantidade" : $(quantidade[i]).val(),
			"estoque" : $(quantidade[i]).attr("novoEstoque"),
			"preco" : $(preco[i]).attr("precoReal"),
			"total" : $(preco[i]).val()})		
	}

	
		$("#listaProdutos").val(JSON.stringify(listaProdutos)); 


		//console.log("listaProdutos",listaProdutos);
		//console.log("listaProdutos",JSON.stringify(listaProdutos));
}


/*=====================================================
=            LISTAR TODOS OS METODOS DE PPAGAMENTO
=====================================================*/

function listarMetodosPagamento(){

	var metodos_pagamento = "";

if ($("#novoMetodoPagamento").val() == "Dinheiro") {

	$("#listaMetodoPagamento").val("Dinheiro");

} else {

	$("#listaMetodoPagamento").val( $("#novoMetodoPagamento").val() + "-" + $("#novoCodigoTransacao").val() );

}
	
}

/*=====================================================
=           BOTÃO EDITAR VENDAS
=====================================================*/

$(".btnEditarVenda").click(function(){

	var btnEditarVenda = $(this).attr("idVenda");

	window.location = "index.php?rota=editar-venda&idVenda="+btnEditarVenda;
	
})



