<div class="login-box">
    <div class="login-logo">
      <img src="view/img/template/logo-blanco-bloque.png" alt="" class="img-responsive" style="padding: 30px 100px 0px 100px">
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Acessar sistema</p>
        <form method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Login" name="inLogin" required autofocus="true">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Senha" name="senhaLogin" required >
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
     
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Acessar</button>
                </div>
                <!-- /.col -->
            </div>
            
            <?php
                $login = new ControllerUsuarios();
                $login -> ctrAcessoUsuario();
            ?>
            
        </form>
    </div>
</div>