<?php $this->Headers(); $this->Exit(); ?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php $this->Nav();?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php $this->Wraper('','','Bienvenido a Bienes Nacionales');?>
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
                <div class="card-text d-flex flex-column h5">
                  <!-- <?php //var_dump($this->GetDatos('permisos'));?> -->
                  <!-- <div class="mensaje_inicio_sesion">Nuestras redes sociales son: <br>  -->
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <a clas="card-link" target="__blank" href="https://www.facebook.com/UPTP-Juan-de-Jesús-Montilla-321794751770801">
                        <i class="fab fa-facebook"></i> UPTP Juan de Jesús Montilla</a>
                    </li>
                    <li class="list-group-item">
                      <a clas="card-link" target="__blank" href="https://www.instagram.com/uptpjuandejesus">
                        <i class="fab fa-instagram"></i> @uptpjuandejesus</a>
                    </li>
                    <li class="list-group-item">
                      <a clas="card-link" target="__blank" href="https://www.twitter.com/UptpJuandeJesus">
                        <i class="fab fa-twitter"></i> @UptpJuandeJesus</a>
                    </li>
                  </ul>
                </div>
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


