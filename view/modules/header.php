<header class="main-header">

    <!--================================================     
              LOGO
  ==================================================-->

    <!-- Logo -->
    <a href="home" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <img src="view/img/template/icono-blanco.png" alt="" class="img-responsive" style="padding:10px;">
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <img src="view/img/template/logo-blanco-lineal.png" alt="" class="img-responsive" style="padding:7px 0;">

        </span>
    </a>


    <!--================================================     
              BARRA DE NAVEGAÇÃO
  ==================================================-->

    <!--botão de navegação-->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>

        </a>

        <!--Perfil de usuario-->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <?php

					if($_SESSION["foto"] != ""){

						echo '<img src="' .$_SESSION["foto"]. '" class="user-image">';

					}else{


						echo '<img src="view/img/usuarios/default/anonymous.png" class="user-image">';

					}


					?>

                        <span class="hidden-xs">
                            <?php echo $_SESSION["nome"] . " - " . $_SESSION["perfil"]?></span>

                    </a>

                    <!-- DROPDOWN-TOGGLE -->

                    <ul class="dropdown-menu">

                        <li class="user-body">
                            <div class="pull-right">
                                <a href="sair" class="btn btn-default btn-flat">Sair</a>

                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>

</header>
