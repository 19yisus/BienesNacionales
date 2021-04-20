<?php 
  $this->Headers('Olvidé mi contraseña'); 
  if(isset($_POST['id-username'])){
    require './Models/ClsLogin.php';
    $mod = new ClsLogin();
    // $mod -> SearchUser($_POST['id-username']);
  }
?>
<body class="hold-transition login-page">
<div class="login-box">
  <?php 
    if(!isset($_GET['valido'])){  
  ?>
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="./" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Para recuperar tu usuario: Solo debes de ingresar tu id de usuario seguido de un (-) y su nombre de usuario
      </p>
      <form method="post" name="formulario">
        <div class="form-group mb-3">
          <label for="username">Id y nombre del usuario</label>
        
          <div class="input-group">
            <input type="text" class="form-control" name="id-username" placeholder="Id-Usuario" title="Ingrese su id y nombre de usuario separados por un (-) " required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="./">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>

  <?php
    }else{
  ?>
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="./" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Por favor, responde las preguntas de seguridad</p>
      <form method="post" name="formulario">
        <div class="form-group mb-3">
          <label for="username">Id y nombre del usuario</label>
        
          <div class="input-group">
            <input type="text" class="form-control" name="id-username" placeholder="Id-Usuario" title="Ingrese su id y nombre de usuario separados por un (-) " required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="./">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
  <?php }?>
</div>
<!-- /.login-box -->
</body>
</html>