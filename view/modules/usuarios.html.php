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

                <table class="table table-bordered table-striped table-hover dt-responsive tabelas">

                    <thead>
                        <tr>
                            <th style="width=7px;">#</th>
                            <th>Nome</th>
                            <th>Login</th>
                            <th>Foto</th>
                            <th>Perfil</th>
                            <th>Estado</th>
                            <th>Último login</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Plinio</td>
                            <td>admin</td>
                            <td>
                                <img class="img-thumbnail" src="view/img/usuarios/default/anonYmous.png" alt="" width="40px">
                            </td>
                            <td>Administrador</td>
                            <td><button class="btn btn-success btn-xs">Ativo</button></td>
                            <td>10/10/2018 10:32:12</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning btn-xs">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-danger btn-xs">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

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
                                <input id="nome" type="text" class="form-control input-lg" name="inNome" placeholder="Informe o nome" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input id="login" type="text" class="form-control input-lg" name="inLogin" placeholder="Informe o login" required>
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

                            <input id="Foto" name="inFoto" type="file">

                            <p class="hel-block text-warning">Tamanho máximo da foto: 2Mb</p>

                            <img src="view/img/usuarios/default/anonYmous.png" width="100px;" class="img-thumbnail">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>

                    <button type="submit" class="btn btn-primary">Gravar</button>

                </div>



            </form>
        </div>



    </div>
</div>
