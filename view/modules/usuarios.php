<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Usuarios

        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Usuarios</li>
        </ol>


    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalCadastroUsuario">
                    Adicionar Usuario

                </button>
            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped table-hover dt-responsive tabelas" width="100%">

                    <thead>
                        <tr>
                            <th style="width=7px;">#</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Foto</th>
                            <th>Perfil</th>
                            <th>Status</th>
                            <th>Último login</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        
                        $item = null;
                            $valor = null;

                            $usuarios = ControllerUsuarios::ctrListarUsuarios($item, $valor);
                            
                        foreach($usuarios as $key => $valor){
                         echo '<tr>
                                <td>'.$valor["id"].'</td>
                                <td>'.$valor["nome"].'</td>
                                <td>'.$valor["login"].'</td>';
                            
                            if($valor["foto"] != ""){

                            echo '<td><img src="'.$valor["foto"].'" class="img-thumbnail" width="40px"></td>';

                            }else{

                                echo '<td><img src="view/img/usuarios/default/anonymous.png" class="img-thumbnail" width="40px"></td>';

                            }
                              
                            echo '<td>'.$valor["perfil"].'</td>';
                            
                            if($valor["status"] != 0){

                                echo '<td><button class="btn btn-success btn-xs btnAtivar" idUsuario="'.$valor["id"].'" statusUsuario="1">Ativado</button></td>';

                            }else{

                                echo '<td><button class="btn btn-danger btn-xs btnAtivar" idUsuario="'.$valor["id"].'" statusUsuario="0">Desativado</button></td>';

                            }             
                             echo '<td>'.$valor["ultimo_login"].'</td>
                            <td>

                                <div class="btn-group">
                        
                                    <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$valor["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button> 

                                      <button class="btn btn-danger btnExcluirUsuario" idUsuario="'.$valor["id"].'" fotoUsuario="'.$valor["foto"].'" login="'.$valor["login"].'"><i class="fa fa-times"></i></button>

                    </div>  

                  </td>
                        </tr>';
                        }
                       
                        ?>


                    </tbody>
                </table>

            </div>

        </div>

    </section>
</div>

<!--======================================
TELA DE MODAL DE CADASTRO DE USUARIO
======================================-->
<div id="modalCadastroUsuario" class="modal fade" data-backdrop="static" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data" action="">
                <div class="modal-header" style="background-color:#3c8dbc; color:white; ">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cadastro de Usuario</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">
                        <div class="form-group">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input id="nome" type="text" class="form-control input-lg" name="inNome"  placeholder="Informe o nome" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input id="inLogin" type="text" class="form-control input-lg" name="inLogin" placeholder="Informe o login" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input id="senha" type="password" class="form-control input-lg" name="inSenha" placeholder="Informe a senha" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                <select class="form-control input-lg" name="inPerfil" id="perfil" required>
                                    <option value="">Selecionar perfil</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Vendedor">Vendedor</option>
                                    <option value="Especial">Especial</option>

                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="panel text-uppercase text-center" style="background-color:#3c8dbc; color:white; ">Adicionar Foto</div>

                            <input id="Foto" class="inFoto" name="inFoto" type="file" accept="image/png,image/jpeg">

                            <p class="hel-block text-warning">Tamanho máximo da foto: 2Mb e o formato deve estar em JPG ou PNG</p>

                            <img src="view/img/usuarios/default/anonYmous.png" width="100px;" class="img-thumbnail visualizar">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>

                    <button type="submit" class="btn btn-primary">Gravar</button>

                </div>

                <?php 
                
                    $cadastrarUsuario = new ControllerUsuarios();
                    $cadastrarUsuario -> ctrCadastrarUsuario();
                
                ?>


            </form>
        </div>



    </div>
</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

                <!--=====================================
        Cabeçalho
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Usuário</h4>

                </div>

                <!--=====================================
        CONTEUDO
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA O NOME -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-lg" id="editarNome" name="editarNome" value="" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA O LOGIN -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <input type="text" class="form-control input-lg" id="editarLogin" name="editarLogin" value="" readonly>

                            </div>

                        </div>
                     

                        <!-- ENTRADA PARA A SENHA -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                                <input type="password" class="form-control input-lg" name="editarSenha" placeholder="Digite a nova senha">

                                <input type="hidden" id="senhaAtual" name="senhaAtual">

                            </div>

                        </div>

                        <!-- ENTRADA PARA SELECIONAR O PERFIL -->

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                <select class="form-control input-lg" name="editarPerfil">

                                    <option value="" id="editarPerfil"></option>

                                    <option value="Administrador">Administrador</option>

                                    <option value="Especial">Especial</option>

                                    <option value="Vendedor">Vendedor</option>

                                </select>

                            </div>

                        </div>

                        <!-- ENTRADA PARA SUBIR FOTO -->

                        <div class="form-group">

                            <div class="panel">CARREGAR FOTO</div>

                            <input type="file" class="inFoto" name="editarFoto">

                            <p class="help-block">Tamanho máximo da foto: 2Mb e o formato deve estar em JPG ou PNG</p>

                            <img src="view/img/usuarios/default/anonymous.png" class="img-thumbnail visualizar" width="100px">

                            <input type="hidden" name="fotoAtual" id="fotoAtual">

                        </div>

                    </div>

                </div>

                <!--=====================================
        RODAPE MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>

                    <button type="submit" class="btn btn-primary">Gravar alteração</button>

                </div>

                  <?php

                       $editarUsuario = new ControllerUsuarios();
                      $editarUsuario -> ctrEditarUsuario();

                
                          
                    ?>

            </form>

        </div>

    </div>

</div>

<?php

  $excluirUsuario =  new ControllerUsuarios();
  $excluirUsuario -> ctrExcluirUsuario();

?> 