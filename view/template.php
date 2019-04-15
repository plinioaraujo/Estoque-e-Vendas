<?php
    session_start();

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inventário</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="icon" href="view/img/template/icono-negro.png">

    <!--================================================ 
    
                PLUGLINS DE CSS
    
    ==================================================-->

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="view/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="view/bower_components/font-awesome/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="view/bower_components/Ionicons/css/ionicons.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="view/dist/css/AdminLTE.css">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="view/dist/css/skins/_all-skins.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="view/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="view/plugins/iCheck/all.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!--================================================ 
    
                PLUGLINS JAVASCRIPT
    
    ==================================================-->


    <!-- jQuery 3 -->
    <script src="view/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="view/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- FastClick -->
    <script src="view/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="view/dist/js/adminlte.min.js"></script>

    <!-- DataTables -->
    <script src="view/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="view/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="view/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
    <script src="view/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

    <!-- SweetAlert 2 -->
    <script src="view/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

    <!-- iCheck 1.0.1 -->
    <script src="view/plugins/iCheck/icheck.min.js"></script>

    <!-- InputMask -->
  <script src="view/plugins/input-mask/jquery.inputmask.js"></script>
  <script src="view/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="view/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  

 <!--  <script src="view/plugins/jquery-maskMoney/jquery.maskMoney.min.js"></script> -->
  <script src="view/plugins/jquerynumber/jquerynumber.js"></script>
  



</head>

<!--================================================     
               CORPO DO DOCUMENTO    
  ==================================================-->

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <?php
        
        if(isset($_SESSION["iniciarSessao"]) && $_SESSION["iniciarSessao"] == "ok"){
        
        echo '<div class="wrapper">';
  /*=============================================
    CABEÇALHO
    =============================================*/
         
        include("modules/header.php");  
 /*-================================================= 
               MENU
  ==================================================*/
       include("modules/menu.php");  
    /*-=================================================     
             CONTEUDO
  ==================================================*/
        
if(isset($_GET["rota"])){            
if(
    $_GET["rota"] == "home" ||
    $_GET["rota"] == "usuarios" ||
    $_GET["rota"] == "categorias" ||
    $_GET["rota"] == "produtos" ||
    $_GET["rota"] == "clientes" ||
    $_GET["rota"] == "vendas" ||
    $_GET["rota"] == "cadastrar-venda" ||
    $_GET["rota"] == "editar-venda" ||
    $_GET["rota"] == "relatorios" ||
    $_GET["rota"] == "sair" ){
    
    include "modules/".$_GET["rota"].".php";
    }else{ 
        include("modules/404.php");
    }

}else{
     include("modules/home.php");
}
        /*-=================================================     
             RODAPE
  ==================================================*/
            include("modules/footer.php");
    echo '</div>';
            
        }else{
              include("modules/login.php");
        }
  ?>


    <script src="view/js/template.js"></script>
    <script src="view/js/usuarios.js"></script>
    <script src="view/js/categorias.js"></script>
    <script src="view/js/produtos.js"></script>
    <script src="view/js/clientes.js"></script>
    <script src="view/js/vendas.js"></script>

</body>

</html>
