<div class="content-wrapper">
    <section class="content-header">
      <h1>
         Vendas
      </h1>
      <ol class="breadcrumb">
         <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Vendas</li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
         <!--=====================================
            FORMULARIO 
            ======================================-->
            <div class="col-lg-5 col-xs-12">
                <div class="box box-success">
                <div class="box-header with-border"></div>
                <form role="form" method="post">
                <div class="box-body">
                 
                     <div class="box">
                        <!--=====================================
                           ENTRADA DO VENDEDOR 
                           ======================================-->
                        <div class="form-group">
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-user"></i></span>
                              <input type="text" class="form-control" id="novoVendedor" name="novaVenda" value="Usuário Administrador" readonly>
                           </div>
                        </div>
                        <!--=====================================
                           Código da Venda
                           ======================================-->
                        <div class="form-group">
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-key"></i></span>
                              <input type="text" class="form-control" id="novaVenda" name="novaVenda" value="123345">
                           </div>
                        </div>
                        <!--=====================================
                           Entrada do Cliente
                           ======================================-->
                        <div class="form-group">
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-users"></i></span>
                              <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                                 <option value="">Selecionar cliente</option>
                              </select>
                              <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalCadastroCliente" data-dismiss="modal">Adicionar cliente</button></span>
                           </div>
                        </div>
                        <!--=====================================
                           ENTRADA PARA ADICIONAR PRODUTO
                           ======================================--> 
                        <div class="form-group row novoProduto">
                           <!-- Descrição do produto -->
                           <div class="col-xs-6" style="padding-right:0px">
                              <div class="input-group">
                                 <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>
                                 <input type="text" class="form-control" id="adicionarProduto" name="adicionarProduto" placeholder="Descrição do produto" required>
                              </div>
                           </div>
                           <!-- Quantidade do Produto -->
                           <div class="col-xs-3">
                              <input type="number" class="form-control" id="novaQuantidadeProduto" name="novaQuantidadeProduto" min="1" placeholder="0" required>
                           </div>
                           <!-- Preço do produto -->
                           <div class="col-xs-3" style="padding-left:0px">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                 <input type="number" min="1" class="form-control" id="novoPrecoProduto" name="novoPrecoProduto" placeholder="000000" readonly required>
                              </div>
                           </div>
                        </div>
                        <!--=====================================
                           BOTÃO PARA ADICIONAR PRODUTO
                           ======================================-->
                        <button type="button" class="btn btn-default hidden-lg">Adicionar produto</button>
                        <hr>
                    <div class="row">
                           <!--=====================================
                              ENTRADA IMPOSTOS E TOTAL
                              ======================================-->
                           <div class="col-xs-8 pull-right">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>Imposto</th>
                                       <th>Total</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td style="width: 50%">
                                          <div class="input-group">
                                             <input type="number" class="form-control" min="0" id="novoImpostoVenda" name="novoImpostoVenda" placeholder="0" required>
                                             <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                          </div>
                                       </td>
                                       <td style="width: 50%">
                                          <div class="input-group">
                                             <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                             <input type="number" min="1" class="form-control" id="novoTotalVenda" name="novoTotalVenda" placeholder="00000" readonly required>
                                          </div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <hr>
                        <!--=====================================
                           ENTRADA MÉTODO DE PAGAMENTO
                           ======================================-->
                        <div class="form-group row">
                           <div class="col-xs-6" style="padding-right:0px">
                              <div class="input-group">
                                 <select class="form-control" id="novoMetodoPagamento" name="novoMetodoPagamento" required>
                                    <option value="">Selecione o método de pagamento</option>
                                    <option value="aVista">À vista</option>
                                    <option value="cartaoCredito">Cartão de Crédito</option>
                                    <option value="cartaoDebito">Cartão de Débito</option>
                                 </select>
                              </div>
                           </div>
                           <div class="caixasMetodoPagamento"></div>

                                <input type="hidden" id="listaMetodoPagamento" name="listaMetodoPagamento">

                            </div>

                                <br>

                                </div>

                            </div>
                            <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Gravar venda</button>
                        </div>
                  </form>
                
               </div>
            </div>
           
                        <!--=====================================
                    TABELA DE PRODUTOS
                    ======================================-->
                <div class="col-lg-7 hidden-md hidden-sm hidden-xs ">
                    <div class="box box-warning">
                        <div class="box-header with-border"></div>
                        <div class="box-body">
                            <table class="table table-bordered table-striped dt-responsive tabelas">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Imagem</th>
                                        <th>Código</th>
                                        <th>Descrição</th>
                                        <th>Estoque</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td><img src="view/img/produtos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
                                        <td>00123</td>
                                        <td>Lorem ipsum dolor sit amet</td>
                                        <td>20</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary">Adicionar</button> 
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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