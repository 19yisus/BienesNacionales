<?php $this->Headers(); $this->Exit(); ?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php $this->Nav();?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php $this->Wraper('','','');?>
    <!-- Main content -->
    <div class="content mt-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="ms-0">Nuestras redes sociales</h5>
              </div>
              <div class="card-body">
                <p class="card-text">
                  <!-- <?php //var_dump($this->GetDatos('permisos'));?> -->
                  <!-- <div class="mensaje_inicio_sesion">Nuestras redes sociales son: <br>  -->
                  <a clas="card-link" href="https://www.facebook.com/UPTP-Juan-de-Jesús-Montilla-321794751770801">UPTP Juan de Jesús Montilla (Facebook)</a><br>
                  <a clas="card-link" href="https://www.instagram.com/uptpjuandejesus">uptpjuandejesus (Instagram)</a><br>
                  <a clas="card-link" href="https://www.twitter.com/UptpJuandeJesus">UptpJuandeJesus (Twitter)</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
<!-- ./wrapper -->
<?php $this->Footer();?>
</body>
</html>


