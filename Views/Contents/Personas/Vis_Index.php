<?php $this->Headers(); $this->Exit(); ?>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
  <?php $this->Nav();?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php $this->Wraper('Registro','Personas/Vis_Registro','Catalogo de Personas');?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Catalogo</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive mx-auto">
                  <table id="catalogo_table" class="table table-bordered display rowrap table-sm table-hover table-striped rounded-sm catalogo-table" cellspacing="0" style="width: 100%;">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cargo</th>
                        <th scope="col">Dependencia</th>
                        <th scope="col">Nucleo</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Optiones</th>
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
  <!-- /.content-wrapper -->
</div>
<?php $this->Footer('Personas'); ?>
<script src="<?php echo constant('URL');?>Views/Js/GLOBAL.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/inputmask/inputmask.js"></script>
<script src="<?php echo constant('URL');?>Views/Assets/plugins/inputmask/jquery.inputmask.js"></script>
</body>
</html>
