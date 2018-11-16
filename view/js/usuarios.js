/*=============================================
CARREGANDO A FOTO DO USUARIO
=============================================*/
$(".inFoto").change(function () {
  
    var imagem = this.files[0];

    /*=============================================
  	VALIDAÇÃO IMAGEM SEJA JPG OU PNG
  	=============================================*/

    if (imagem["type"] != "image/jpeg" && imagem["type"] != "image/png") {

        $(".inFoto").val("");

        swal({
            title: "Erro ao carregar a imagem",
            text: "A imagem deve estar no formato JPG ou PNG",
            type: "error",
            confirmButtonText: "Fechar"
        });
    } else if (imagem["size"] > 2000000) {

        $(".inFoto").val("");

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
EDITAR USUARIO
=============================================*/
$(document).on("click", ".btnEditarUsuario", function(){


    var idUsuario = $(this).attr("idUsuario");

    var dados = new FormData();
    dados.append("idUsuario", idUsuario);


    $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: dados,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (resposta) {

            //console.log("resposta", resposta);

            $("#editarNome").val(resposta["nome"]);
            $("#editarLogin").val(resposta["login"]);
            $("#editarPerfil").html(resposta["perfil"]);
            $("#editarPerfil").val(resposta["perfil"]);
            $("#fotoAtual").val(resposta["foto"]);

            $("#senhaAtual").val(resposta["senha"]);

            if (resposta["foto"] != "") {

                $(".visualizar").attr("src", resposta["foto"]);

            }else{
                $(".visualizar").attr("src", "view/img/usuarios/default/anonymous.png");
            }

        }

    });


})


/*=============================================
ATIVAR USUARIO
=============================================*/
$(document).on("click", ".btnAtivar", function(){


    var idUsuario = $(this).attr("idUsuario");
    var statusUsuario = $(this).attr("statusUsuario");
    
    var dados = new FormData();
    dados.append("ativarId",idUsuario);
    dados.append("ativarUsuario",statusUsuario);
   // console.log(dados.get("ativarId"));

    $.ajax({
            url: "ajax/usuarios.ajax.php",
            method: "POST",
            data: dados,
            cache: false,
            contentType: false,
            processData: false,
            success: function (resposta) {

                if(window.matchMedia("(max-width:767px)").matches){
        
             swal({
                title: "Usuário atualizado com sucesso!",
                type: "success",
                confirmButtonText: "Fechar"
                }).then(function(result) {
                
                    if (result.value) {

                    window.location = "usuarios";

                }

              });


        }
      }
               
    })

    if(statusUsuario == 0){
      //  console.log(statusUsuario);
        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html("Desativado");
        $(this).attr("statusUsuario",1);
    }else{
        //  console.log(statusUsuario);
        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html("Ativado");
        $(this).attr("statusUsuario",0);
    }
})


  /*=============================================
    VERIFICAR SE O USUÁRIO JÁ EXISTE
    =============================================*/

$("#inLogin").change(function(){

    $(".alert").remove();

    var login = $(this).val();

    var dados = new FormData();

    dados.append("validarLogin", login);

    $.ajax({
            url: "ajax/usuarios.ajax.php",
            method: "POST",
            data: dados,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (resposta) {

               // console.log("resposta",resposta); 
            if(resposta){

                $("#inLogin").parent().after('<div class="alert alert-warning">Este login já existe!</div>');

                $("#inLogin").val("");
                $("#inLogin").focus();

            }


            }
               
    })


})


 /*=============================================
    BLOQUEAR O ENTER
    =============================================*/

$('#inLogin').keypress(function(e) {
    if(e.which == 13) {
      e.preventDefault();
      console.log('Não vou enviar');
    }
});


 /*=============================================
   EXCLUIR USUARIO
    =============================================*/

 $(document).on("click", ".btnExcluirUsuario", function(){

  var idUsuario = $(this).attr("idUsuario");
  var fotoUsuario = $(this).attr("fotoUsuario");
  var login = $(this).attr("login");

  swal({
    title: 'O usuário será excluído! Tem certeza?',
    text: "É possível cancelar a ação!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Sim, excluir usuário!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?rota=usuarios&idUsuario="+idUsuario+"&login="+login+"&fotoUsuario="+fotoUsuario;

    }

  })

})