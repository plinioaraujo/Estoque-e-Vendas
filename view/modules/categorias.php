<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Categorias

        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Categorias</li>
        </ol>
    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalCadastroCategoria">
                    Adicionar Categoria

                </button>
            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped table-hover dt-responsive tabelas" width="100%">

                    <thead>
                        <tr>
                            <th style="width=7px;">#</th>
                            <th>Categoria</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                            $item = null;
                            $valor = null;

                            $categorias =  ControllerCategorias::ctrListarCategorias($item, $valor);

                            //var_dump($categorias);


                            foreach ($categorias as $key => $valor) {
           
                                    echo ' <tr>

                                            <td>'.($key+1).'</td>

                                            <td class="text-uppercase">'.$valor["descricao"].'</td>

                                            <td>

                                              <div class="btn-group" width="30px">
                                                  
                                                <button class="btn btn-warning btn-md btnEditarCategoria" idCategoria="'.$valor["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>

                                                <button class="btn btn-danger btn-md btnExcluirCategoria" idCategoria="'.$valor["id"].'"><i class="fa fa-times"></i></button>

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


<!--=====================================
MODAL EDITAR CATEGORIA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar categoria</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>

                 <input type="hidden"  name="idCategoria" id="idCategoria" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>

          <button type="submit" class="btn btn-primary">Gravar</button>

        </div>

      <?php

          $editarCategoria = new ControllerCategorias();
          $editarCategoria -> ctrEditarCategoria();

        ?> 

      </form>

    </div>

  </div>

</div>


<?php

    $excluirCategoria = new ControllerCategorias();
    $excluirCategoria -> ctrExcluirCategoria();

?>