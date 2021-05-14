<?php $this->Headers(); $this->Exit(); ?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php $this->Nav();?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php $this->Wraper('','','Catalogo de reportes');?>
    <!-- Main content -->
    <div class="content mt-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Reportes</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive mx-auto">
                  <table id="Catalogo_comprobantes" class="table table-bordered display rowrap table-sm table-hover table-striped rounded-sm catalogo-table" cellspacing="0" style="width: 100%;">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Origen</th>
                        <th scope="col">Dependencia</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Cantidad de bienes</th>
                        <th scope="col">Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
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
<script src="<?php echo constant('URL');?>Views/Js/GLOBAL.js"></script>
<script src="<?php echo constant("URL");?>Views/Js/Reportes.js"></script>
</body>
</html>


