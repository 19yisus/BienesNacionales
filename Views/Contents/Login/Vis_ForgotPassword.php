<?php 
  $this->Headers('Olvidé mi contraseña'); 
  $status = 0;
  $res = null;

  require_once './Models/ClsLogin.php';
  $mod = new ClsLogin();

  if(isset($_POST['id'])){
    $res = $mod->ConsultarUser($_POST['id']);
    $status = $res['valido'];
  }

  if(isset($_POST['res_1']) && isset($_POST['res_2'])){
    $res = $mod->ValidaRespuestas($_POST['user'],$_POST['res_1'], $_POST['res_2']);
    $status = $res['valido'];
  }

  if(isset($_POST['password1']) && isset($_POST['password2'])){
    $res = $mod->ResetPassword($_POST['user'],$_POST['password1'], $_POST['password2']);
    $status = $res['valido'];
  }
?>
<!-- SweetAlert2 -->
<script src="<?php echo constant('URL');?>Views/Assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<body class="hold-transition login-page">
<div class="login-box">
  <?php 
    if(isset($res['Error'])){
      ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $res['Error']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php
    }

    if(isset($res['Success'])){
      ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $res['Success']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php
    }
    if($status == 0){        
  ?>
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="./" class="h1"><b><?php echo constant('App_name')[0];?></b><?php echo constant('App_name')[1];?></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Para recuperar tu usuario: Solo debes ingresar tu cedula de usuario
      </p>
      <form method="post" name="formulario">
        <div class="form-group mb-3">
          <label for="username">Cedula del usuario</label>
        
          <div class="input-group">
            <input type="text" class="form-control" name="id" placeholder="0000000" title="Ingrese su cedula" required>
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
    }elseif($status == 1){
  ?>
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="./" class="h1"><b><?php echo constant('App_name')[0];?></b><?php echo constant('App_name')[1];?></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Por favor, responde las preguntas de seguridad</p>
      <form method="post" name="formulario">
        <input type="hidden" name="user" value="<?php echo $res['userid']; ?>">
        <div class="form-group mb-3">
          <label for="username">¿<?php echo $res['PG1'];?>?</label>
          <input type="text" class="form-control" name="res_1" placeholder="Responda la pregunta 1" required>
        </div>
        <div class="form-group mb-3">
          <label for="username">¿<?php echo $res['PG2'];?>?</label>
          <input type="text" class="form-control" name="res_2" placeholder="Responda la pregunta 2" required>
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
  <?php }elseif($status == 2){?>
    <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="./" class="h1"><b><?php echo constant('App_name')[0];?></b><?php echo constant('App_name')[1];?></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Ingresa su nueva clave</p>
      <form method="post" name="formulario">
        <input type="hidden" name="user" value="<?php echo $res['userid']; ?>">
        <div class="form-group mb-3">
          <label for="password1">Nueva contraseña</label>
          <input type="password" class="form-control" name="password1" placeholder="Ingrese su clave" title="Ingrese una contraseña valida al menos de 8 caracteres, con mayusculas, minusculas y numeros" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
        </div>
        <div class="form-group mb-3">
          <label for="password2">Confirmar contraseña</label>
          <input type="password" class="form-control" name="password2" placeholder="Confirmar clave" title="Ingrese una contraseña valida al menos de 8 caracteres, con mayusculas, minusculas y numeros" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
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
  <?php }elseif($status == 3){?>
    <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="./" class="h1"><b><?php echo constant('App_name')[0];?></b><?php echo constant('App_name')[1];?></a>
    </div>
    <div class="card-body">
      <script>
        Swal.fire({
          title: "Exito!",
          text: "Tu clave ha sido modificada con exito",
          icon: 'success',
          showCancelButton: false,
          showConfirmButton: true,
          confirmButtonText:'Aceptar',
        }).then( valor =>{
          window.location.href = "<?php echo constant("URL");?>";
        });
      </script>
      <p class="mt-3 mb-1">
        <a href="./">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
  <?php }?>
</div>
<!-- jQuery -->
<script src="<?php echo constant('URL');?>Views/Assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo constant('URL');?>Views/Assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- /.login-box -->
</body>
</html>