<?php $this->Headers(); $this->Exit(); ?>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
    <?php $this->Nav();?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php $this->Wraper('Registro','Bienes/Vis_Registro','Catalogo de Bienes');?>
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
                          <th scope="col">Código</th>
                          <th scope="col">Descripcion</th>
                          <th scope="col">Categoria</th>
                          <th scope="col">Fecha de ingreso</th>
                          <th scope="col">Precio</th>
                          <th scope="col">Estado</th>
                          <th scope="col">Optiones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <div class="card-text">
                    <?php 
                      $res = $this->Control('BienesController')->Con("SELECT COUNT(*) AS total FROM bien WHERE bien.bien_estado = 1;");
                      $res2 = $this->Control('BienesController')->Con("SELECT COUNT(*) AS total FROM bien WHERE bien.bien_estado = 0;");
                    ?>
                    <strong><p>Cantidad de bienes activos: <span class="text-success"><?php echo $res[0]['total'];?></span> </p></strong>
                    <p>Cantidad de bienes innactivos: <span class="text-danger"><?php echo $res2[0]['total'];?></span> </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <!-- /.content-wrapper -->
    </div>
  
<?php $this->Footer('Bienes'); ?>
<script src="<?php echo constant('URL');?>Views/Js/GLOBAL.js"></script>
<script src="<?php echo constant('URL');?>Views/Js/Bienes/catalogos.js"></script>
<script src="<?php echo constant('URL');?>Views/Js/Bienes/FormDinamic.js"></script>
</body>
</html>