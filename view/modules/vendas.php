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

        <div class="box">
            <div class="box-header with-border">

                    <a href="cadastrar-venda">
                    <button class="btn btn-primary" >
                        Adicionar Venda

                    </button>
                    </a>
            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped table-hover dt-responsive tabelas" width="100%">

                    <thead>
                        <tr>
                            <th style="width=7px;">#</th>
                            <th>Código Venda</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Forma de Pagamento</th>
                            <th>SubTotal</th>
                            <th>Total</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                            $item = null;
                            $valor = null;
                            $resposta = ControllerVendas::ctrListarVendas($item,$valor);

                           //var_dump($resposta);

                            foreach ($resposta as $key => $value) {
                                
                                echo ' <tr>
                            <td>'.($key+1).'</td>
                            <td>'.$value["codigo"].'</td>';

                               $itemCliente = "id";
                               $valorCliente = $value["id_cliente"];

                               $respostaCliente = ControllerClientes::ctrListarClientes($itemCliente,$valorCliente); 

                            echo '<td>'.$respostaCliente["nome"].'</td>';

                               $itemUsuario = "id";
                               $valorUsuario = $value["id_vendedor"];

                               $respostaUsuario = ControllerUsuarios::ctrListarUsuarios($itemUsuario,$valorUsuario); 

                            echo '<td>'.$respostaUsuario["nome"].'</td>';
                            echo '
                            <td>'.$value["metodo_pagamento"].'</td>
                            <td>R$ '.number_format($value["valor"],2).'</td>
                            <td>R$ '.number_format($value["valor_total"],2).'</td>
                            <td>'.$value["data"].'</td>
                            <td>

                                <div class="btn-group">

                                    <button class="btn btn-info btn-md"><i class="fa fa-print"></i></button>
                                     <button class="btn btn-warning btn-md btnEditarVenda" idVenda="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger btn-md"><i class="fa fa-times"></i></button>
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
