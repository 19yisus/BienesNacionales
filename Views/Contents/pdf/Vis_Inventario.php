<?php 
  $this->Headers(); 
  $this->Exit(); 
?>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <?php $this->Nav();?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php $this->Wraper('','','Inventario de bienes');?>
    <!-- Main content -->
    <div class="content mt-4">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Consulta el inventario de bienes</h3>
              </div>
              <div class="card-body">
                <form method="post" name="formulario" id="inventario" target="_blank" action="<?php echo constant('URL');?>PDFController/Inventario" class="needs-validation" novalidate>
                  <div class="row">
                    <div class="col form-group">
                      <label for="">Movimiento</label><label for="" id="ob">*</label>
                      <select name="mov" id="" class="custom-select" required>
                        <option value="">Seleccione una opcion</option>
                        <option value="I">Incorporados</option>
                        <option value="D">Desincorporados</option>
                        <option value="R">Reasignados</option>
                      </select>
                    </div>
                    <div class="col form-group">
                      <label for="">Rango de fechas</label><label for="" id="ob">*</label>
                      <div class="input-group">
                        <input type="date" aria-label="First name" name="first_date" class="form-control" max="<?php echo $this->Control('PersonasController')->FechaActual(); ?>" min="2000-12-31" title="Ingrese una fecha valida" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" required>
                        <input type="date" aria-label="Last name" name="second_date" class="form-control" max="<?php echo $this->Control('PersonasController')->FechaActual(); ?>" min="2000-12-31" title="Ingrese una fecha valida" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" required>
                      </div>
                    </div>
                    <div class="col-3 form-group">
                      <label for="">Acción</label>
                      <input type="submit" id="enviar" class="btn btn-block btn-success" value="Consultar">
                    </div>
                  </div>
                </form>
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


