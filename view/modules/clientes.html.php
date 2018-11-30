<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Clientes

        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Clientes</li>
        </ol>
    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalCadastroCliente">
                    Adicionar Cliente

                </button>
            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped table-hover dt-responsive tabelas" width="100%">

                    <thead>
                        <tr>
                            <th style="width=7px;">#</th>
                            <th>Nome</th>
                            <th>cpf</th>
                            <th>email</th>
                            <th>celular</th>
                            <th>telefone</th>
                            <th>logradouro</th>
                            <th>data de nascimento</th>
                            <th>compras</th>
                            <th>adicionado</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Joao da Silva</td>
                            <td>021.456.215-41</td>
                            <td>joao@gmail.com</td>
                            <td>(21)98855-4434</td>
                            <td>(21)3425-8254</td>
                            <td>Rua da Batata,345 / 101</td>
                            <td>1980-11-10</td>
                            <td>0</td>
                            <td>2018-11-15 17:52:41</td>
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

                         <tr>
                            <td>1</td>
                            <td>Joao da Silva</td>
                            <td>021.456.215-41</td>
                            <td>joao@gmail.com</td>
                            <td>(21)98855-4434</td>
                            <td>(21)3425-8254</td>
                            <td>Rua da Batata,345 / 101</td>
                            <td>1980-11-10</td>
                            <td>0</td>
                            <td>2018-11-15 17:52:41</td>
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

                         <tr>
                            <td>1</td>
                            <td>Joao da Silva</td>
                            <td>021.456.215-41</td>
                            <td>joao@gmail.com</td>
                            <td>(21)98855-4434</td>
                            <td>(21)3425-8254</td>
                            <td>Rua da Batata,345 / 101</td>
                            <td>1980-11-10</td>
                            <td>0</td>
                            <td>2018-11-15 17:52:41</td>
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
TELA DE MODAL DE CADASTRO DE Categoria
======================================-->
<div id="modalCadastroCategoria" class="modal fade" data-backdrop="static" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data" action="">
                <div class="modal-header" style="background-color:#3c8dbc; color:white; ">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cadastro de Categorias</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">
                        <div class="form-group">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input id="novaCategoria" type="text" class="form-control input-lg" name="novaCategoria" placeholder="Informe a Categoria" required>
                            </div>
                        </div>
                       
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>

                    <button type="submit" class="btn btn-primary">Gravar</button>

                </div>

                    <?php 

                        $adicionarCategoria = new ControllerCategorias();
                        $adicionarCategoria -> ctrAdicionarCategoria();

                    ?>

            </form>
        </div>

    </div>
</div>
