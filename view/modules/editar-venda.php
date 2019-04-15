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
                
                <form role="form" method="post" class="formVenda">
             
                <div class="box-body">
                 
                        <div class="box">

                              <?php 
                                        $item = "id";
                                        $valor = $_GET["idVenda"];

                                        $venda = ControllerVendas::ctrListarVendas($item,$valor);

                                        $itemUsuario = "id";
                                        $valorUsuario = $venda["id_vendedor"];

                                        $editarUsuario = ControllerUsuarios::ctrListarUsuarios($itemUsuario,$valorUsuario);
                                        
                                        $itemCliente = "id";
                                        $valorCliente = $venda["id_cliente"];

                                        $editarCliente = ControllerClientes::ctrListarClientes($itemCliente,$valorCliente);

                                        $percentualImposto = $venda["juros"] * 100 / $venda["valor"];
                                          
                                ?>  

                                <!--=====================================
                                ENTRADA DO VENDEDOR 
                                ======================================-->
                                <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                    <input type="text" class="form-control" id="novoVendedor" value="<?php echo $editarUsuario["nome"];  ?>" readonly>

                                    <input type="hidden" name="idVendedor" value="<?php echo $editarUsuario["id"];  ?>">
                                </div>
                                </div>
                                <!--=====================================
                                CÓDIGO DA VENDA
                                ======================================-->
                                <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                            
                                   <input type="text" class="form-control" id="editarVenda" name="editarVenda" value="<?php echo $venda["codigo"]; ?>" readonly>
                                     
                                </div>
                                </div>


                                <!--=====================================
                                Entrada do Cliente
                                ======================================-->
                                <div class="form-group">

                                    <div class="input-group">
                                  
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                   
                                        <select class="form-control" id="selecionarCliente" name="selecionarCliente" required>

                                            <option value="<?php echo $editarCliente["id"];?>"><?php echo $editarCliente["nome"];  ?></option>

                                            <?php 
                                            
                                            $item = null;
                                            $valor = null;

                                            $clientes = ControllerClientes::ctrListarClientes($item,$valor);
                                   
                                              foreach ($clientes as $key => $value) {
                                                  
                                                echo '<option value="'.$value["id"].'">'.$value["nome"].'</option>';
                                              }      
                                            
                                            ?>
                                        
                                        </select>

                                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalCadastroCliente" data-dismiss="modal">Adicionar cliente</button></span>
                                   
                                    </div>
                                
                                </div>

                                <!--=====================================
                                ENTRADA PARA ADICIONAR PRODUTO
                                ======================================--> 
                                <div class="form-group row novoProduto">
                                    <?php

                                      $listaProdutos = json_decode($venda["produtos"],true);

                                       //var_dump($listaProdutos);

                                        foreach ($listaProdutos as $key => $value) {

                                          $item = "id";
                                          $valor = $value["id"];

                                          $resposta = ControllerProdutos::ctrListarProdutos($item, $valor);

                                          //var_dump($resposta);

                                          $estoqueAntigo = $resposta["estoque"] + $value["quantidade"];
                                         
                                           echo '<div class="row" style="padding:5px 15px">
                                                
                                                <div class="col-xs-6" style="padding-right:0px">
                                                
                                                    <div class="input-group">
                                                      
                                                      <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs excluirProduto" idProduto="'. $value["id"] . '"><i class="fa fa-times"></i></button></span>
                                                      
                                                        <input type="text" class="form-control novaDescricaoProduto" idProduto="'. $value["id"] .'" name="adicionarProduto" value="'. $value["descricao"] .'" readonly required>
                                                  
                                                    </div>
                                                
                                                </div> 

                                                <div class="col-xs-3">

                                                  <input type="number" class="form-control novaQuantidadeProduto" name="novaQuantidadeProduto" value="'.$value["quantidade"].'" min="1" estoque="'.$estoqueAntigo.'" novoEstoque="'.$value["estoque"].'" required>
                                                
                                                </div>

                                             
                                                <div class="col-xs-3 entradaPreco" style="padding-left:0px">

                                                  <div class="input-group">

                                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                                                    <input type="text" class="form-control novoPrecoProduto" precoReal="' . $resposta["preco_venda"] . '" name="novoPrecoProduto" value="' . $value["total"] . '" readonly required>
                                                  
                                                  </div>
                                                 
                                                </div> 
                                              </div>'; 

                                        }
                                    ?>
                                            
                                </div>

                                <input type="hidden" id="listaProdutos" name="listaProdutos">
                                <!--=====================================
                                BOTÃO PARA ADICIONAR PRODUTO
                                ======================================-->
                                <button type="button" class="btn btn-default hidden-lg btnAdicionarProduto">Adicionar produto</button>
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
                                                    
                                                    <input type="number" class="form-control input-lg" min="0" id="novoImpostoVenda" name="novoImpostoVenda" value="<?php echo $percentualImposto; ?>" placeholder="0" required>
                                                  
                                                  <input type="hidden" id="novoValorImposto" name="novoValorImposto" value="<?php echo $venda["valor"] ?>" required>

                                                  <input type="hidden" id="totalAPagarSemImposto" name="totalAPagarSemImposto" required>

                                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                </div>
                                            </td>
                                            <td style="width: 50%">
                                                <div class="input-group">
                                                  
                                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                  
                                                    <input type="text" class="form-control input-lg" id="novoTotalVenda" name="novoTotalVenda" value="<?php echo $venda["valor"] ?>" placeholder="00000" readonly required>
                                                  
                                                   <input type="hidden" name="totalVenda" id="totalVenda">



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
                                            <option value="">Selecione o pagamento</option>
                                            <option value="Dinheiro">Dinheiro</option>
                                            <option value="CC">Cartão de Crédito</option>
                                            <option value="CD">Cartão de Débito</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="caixasMetodoPagamento">
                                  

                                </div>

                                      <input type="hidden" id="listaMetodoPagamento" name="listaMetodoPagamento">

                                </div>

                                 <br>
      
                              </div>

                          </div>
                                    <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right">Gravar alteração</button>
                                </div>

    


                  </form>  

                     <?php

                        $editarVenda = new ControllerVendas();
                        $editarVenda -> ctrEditarVenda();
                        
                    ?>               
                
               </div>
            </div>
           
                        <!--=====================================
                    TABELA DE PRODUTOS
                    ======================================-->
                <div class="col-lg-7 hidden-md hidden-sm hidden-xs ">
                    <div class="box box-warning">
                        <div class="box-header with-border"></div>
                        <div class="box-body">
                            <table class="table table-bordered table-striped dt-responsive tabelaVendas">
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