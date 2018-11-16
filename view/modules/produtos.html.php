<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Produtos

        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Produtos</li>
        </ol>
    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalCadastroProduto">
                    Adicionar Produto

                </button>
            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped table-hover dt-responsive tabelas">

                    <thead>
                        <tr>
                            <th style="width=7px;">#</th>
                            <th>Imagem</th>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Estoque</th>
                            <th>Preço de Compra</th>
                            <th>Preço de Venda</th>
                            <th>Adicionado</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>
                                <img class="img-thumbnail" src="view/img/produtos/default/anonYmous.png" alt="" width="40px">
                            </td>
                            <td>00026</td>
                            <td>Geladeira</td>
                            <td>Eletrodomesticos</td>
                            <td>20</td>
                            <td>R$ 2.300,00</td>
                            <td>R$ 3.000,00</td>
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
                         <tr>
                            <td>1</td>
                            <td>
                                <img class="img-thumbnail" src="view/img/produtos/default/anonYmous.png" alt="" width="40px">
                            </td>
                            <td>00026</td>
                            <td>Geladeira</td>
                            <td>Eletrodomesticos</td>
                            <td>20</td>
                            <td>R$ 2.300,00</td>
                            <td>R$ 3.000,00</td>
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
                         <tr>
                            <td>1</td>
                            <td>
                                <img class="img-thumbnail" src="view/img/produtos/default/anonYmous.png" alt="" width="40px">
                            </td>
                            <td>00026</td>
                            <td>Geladeira</td>
                            <td>Eletrodomesticos</td>
                            <td>20</td>
                            <td>R$ 2.300,00</td>
                            <td>R$ 3.000,00</td>
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
TELA DE MODAL DE CADASTRO DE PRODUTO
======================================-->
<div id="modalCadastroProduto" class="modal fade" data-backdrop="static" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data" action="">
                <div class="modal-header" style="background-color:#3c8dbc; color:white; ">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Cadastro de Produto</h4>

                </div>

                <div class="modal-body">

                    <div class="box-body">
                                     <!-- ENTRADA PARA CODIGO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                <input id="NovoCodigo" type="text" class="form-control input-lg" name="novoCodigo" placeholder="Código" required>
                            </div>
                        </div>
                                     <!-- ENTRADA PARA DESCRICAO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                <input id="descricao" type="text" class="form-control input-lg" name="descricao" placeholder="Descrição" required>
                            </div>
                        </div>
                            <!-- ENTRADA PARA CATEGORIA -->
                            <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <select class="form-control input-lg" name="novaCategoria" id="categoria" required>
                                    <option value="">Selecionar categoria</option>
                                    <option value="Ventiladores">Ventiladores</option>
                                    <option value="Madeiras">Madeiras</option>
                                    <option value="Maquinas">Máquinas</option>

                                </select>

                            </div>
                        </div>
                           <!-- ENTRADA PARA ESTOQUE -->
                         <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                <input id="estoque" type="number" class="form-control input-lg" name="novoEstoque" min="0" placeholder="Estoque" required>
                            </div>
                        </div>

                          <!-- ENTRADA PARA PREÇO COMPRA -->

                         <div class="form-group row">

                            <div class="col-xs-12 col-sm-6">
                            
                              <div class="input-group">
                              
                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                                <input type="number" class="form-control input-lg" id="novoPrecoCompra" name="novoPrecoCompra" min="0" step="any" placeholder="Preço de Compra" required>

                              </div>

                            </div>

                            <!-- ENTRADA PARA PREÇO VENDA -->

                            <div class="col-xs-12 col-sm-6">
                            
                              <div class="input-group">
                              
                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                                <input type="number" class="form-control input-lg" id="novoPrecoVenda" name="novoPrecoVenda" min="0" step="any" placeholder="Preço de Venda" required>

                              </div>
                            
                              <br>

                              <!-- CHECKBOX PARA PORCENTAGEM -->

                              <div class="col-xs-6">
                                
                                <div class="form-group">
                                  
                                  <label>
                                    
                                    <input type="checkbox" class="minimal porcentagem" checked>
                                    Usar porcentagem
                                  </label>

                                </div>

                              </div>

                              <!-- ENTRADA PARA PORCENTAGEM -->

                              <div class="col-xs-6" style="padding:0">
                                
                                <div class="input-group">
                                  
                                  <input type="number" class="form-control input-lg novaPorcentagem" min="0" value="40" required>

                                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                </div>

                              </div>

                            </div>

                        </div>
                        <div class="form-group">
                            <div class="panel text-uppercase text-center" style="background-color:#3c8dbc; color:white; ">Adicionar Imagem</div>

                            <input id="imagem" name="novaImagem" type="file">

                            <p class="hel-block text-warning">Tamanho máximo da foto: 2Mb</p>

                            <img src="view/img/produtos/default/anonYmous.png" width="100px;" class="img-thumbnail">
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
