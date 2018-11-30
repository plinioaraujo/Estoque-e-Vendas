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
                            <th>Total de Compras</th>
                            <th>Última compra</th>
                            <th>adicionado</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 

                       $item = null;
                       $value = null;

                        $clientes = ControllerClientes::ctrListarClientes($item,$value);

                        foreach ($clientes as $key => $value) {
                            
                            echo '<tr>

                            <td>'.($key+1).'</td>
        
                            <td>'.$value["nome"].'</td>
        
                            <td>'.$value["cpf"].'</td>
        
                            <td>'.$value["email"].'</td>
        
                            <td>'.$value["celular"].'</td>

                            <td>'.$value["telefone"].'</td>
        
                            <td>'.$value["logradouro"].'</td>
        
                            <td>'.$value["data_nascimento"].'</td>             
        
                            <td>'.$value["compras"].'</td>
        
                            <td>0000-00-00 00:00:00</td>
        
                            <td>'.$value["data_criacao"].'</td>
        
                            <td>
        
                              <div class="btn-group">
                                  
                                <button class="btn btn-warning btn-xs btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
        
                                <button class="btn btn-danger btn-xs btnExcluirCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>
        
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
TELA DE MODAL DE CADASTRO DE Clientes
======================================-->
<div id="modalCadastroCliente" class="modal fade" data-backdrop="static" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data" action="">
                <div class="modal-header" style="background-color:#3c8dbc; color:white; ">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cadastro de Clientes</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" name="novoCliente" placeholder="Digite o nome do Cliente" required>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="number" min="0" class="form-control input-lg" name="novoDocumento" placeholder="Digite o número do CPF" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control input-lg" name="novoEmail" placeholder="Digite o E-mail" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                <input type="text" class="form-control input-lg" name="novoCelular" placeholder="Digite o número do celular" data-inputmask="'mask':'(99)99999-9999'" data-mask required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-lg" name="novoTelefone" placeholder="Digite o número do telefone" data-inputmask="'mask':'(99)9999-9999'" data-mask required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control input-lg" name="novoLogradouro" placeholder="Digite o endereço" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control input-lg" name="novaDataNascimento" placeholder="Digite a data de nascimento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask  required>
                            </div>
                        </div>    

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>

                    <button type="submit" class="btn btn-primary">Gravar</button>

                </div>

                    <?php 

                        $adicionarCliente = new ControllerClientes();
                        $adicionarCliente -> ctrAdicionarCliente();

                    ?>

            </form>
        </div>

    </div>
</div>


<div id="modalEditarCliente" class="modal fade" data-backdrop="static" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data" action="">
                <div class="modal-header" style="background-color:#3c8dbc; color:white; ">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edição de Clientes</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control input-lg" id="editarCliente" name="editarCliente" placeholder="Digite o nome do Cliente" required>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="number" min="0" class="form-control input-lg" id="editarDocumento"  name="editarDocumento" placeholder="Digite o número do CPF" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" class="form-control input-lg" id="editarEmail" name="editarEmail" placeholder="Digite o E-mail" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
                                <input type="text" class="form-control input-lg" id="editarCelular" name="editarCelular" placeholder="Digite o número do celular" data-inputmask="'mask':'(99)99999-9999'" data-mask required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control input-lg" id="editarTelefone" name="editarTelefone" placeholder="Digite o número do telefone" data-inputmask="'mask':'(99)9999-9999'" data-mask required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control input-lg" id="editarLogradouro" name="editarLogradouro" placeholder="Digite o endereço" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control input-lg" id="editarDataNascimento" name="editarDataNascimento" placeholder="Digite a data de nascimento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask  required>
                            </div>
                        </div>    

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>

                    <button type="submit" class="btn btn-primary">Gravar</button>

                </div>

                    <?php 

                        $editarCliente = new ControllerClientes();
                        $editarCliente -> ctrEditarCliente();

                    ?>

            </form>
        </div>

    </div>
</div>

<?php

  $excluirCliente = new ControllerClientes();
  $excluirCliente -> ctrExcluirCliente();

?>