/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tabelas").on("click", ".btnEditarCategoria", function(){

	var idCategoria = $(this).attr("idCategoria");

	var dados = new FormData();
	dados.append("idCategoria", idCategoria);

	$.ajax({
		url: "ajax/categorias.ajax.php",
		method: "POST",
      	data: dados,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(resposta){

        console.log("resposta", resposta);

     		$("#editarCategoria").val(resposta["descricao"]);
     		$("#idCategoria").val(resposta["id"]);

     	}

	})


})


/*=============================================
EXCLUIR CATEGORIA
=============================================*/
$(".tabelas").on("click", ".btnExcluirCategoria", function(){

     var idCategoria = $(this).attr("idCategoria");
     //console.log(idCategoria);
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

        ///console.log(result.value);

        if(result.value){

            window.location = "index.php?rota=categorias&idCategoria="+idCategoria;

        }

     })

})
