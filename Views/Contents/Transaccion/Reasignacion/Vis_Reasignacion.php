<?php $this->Headers(); $this->Exit(); ?>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
  <?php $this->Nav();?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php $this->Wraper('Catalogo','Transaccion/Reasignacion/Vis_Index','Reasignacion de Bienes');?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Transaccion</h3>
              </div>
              <form role="form" name="formulario" id="formulario" method="POST" action="#" autocomplete="off" class="needs-validation" novalidate>
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-4">
                      <label for="">Dependencia de origen </label><label for="" id="ob">*</label>
                      <select name="Dep_origen" id="Dep_origen" class="form-control select-option-special" width="40%" required>
                      <?php echo $this->Control('PersonasController')->SelectDeps(2); ?>
                      </select>
                    </div>
                    <div class="form-group col-4">
                      <label for="">Dependencia destino</label><label for="" id="ob">*</label>
                      <select name="Dep_destino" id="Dep_destino" class="form-control select-option-special" width="40%" required>
                      <?php echo $this->Control('PersonasController')->SelectDeps(1); ?>
                      </select>
                    </div>
                    <div class="form-group col-3">
                      <label for="">Responsable</label>
                      <input type="text" id="Encargado" class="form-control" placeholder="Encargado" disabled>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-3">
                      <label for="">Origen</label><label for="" id="ob">*</label>
                      <select name="origen" id="origen" class="custom-select" required>
                        <option value="">Seleccione un valor</option>
                        <option value="Compra">Compra</option>
                        <option value="Donacion">Donación</option>
                      </select>
                    </div>
                    <div class="form-group col-3">
                      <label for="">Justificacion</label><label for="" id="ob">*</label>
                      <input type="text" name="orden" id="orden" class="form-control" pattern="[0-9]{8,10}" minlength="8" maxlength="10" placeholder="Justificacion" required>
                    </div>
                    <div class="form-group col">
                      <label for="">Observacion </label>
                      <textarea name="Obser" id="Obser" cols="30" rows="1" maxlength="150" minlength="10" class="form-control" placeholder="Direccion" style="text-transform: uppercase;" required></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="card w-100 bg-green">
                      <div class="card-body">
                        <div class="table-responsive mx-auto">
                          <table id="Transaccion_bienes" class="table table-bordered display rowrap table-sm table-hover table-striped rounded-sm catalogo-table" cellspacing="0" style="width: 100%;">
                            <thead class="thead-light">
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Fecha de ingreso</th>
                                <th scope="col">Dependencia</th>
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
                  <div class="row card-footer">
                    <div class="col-md-12 text-center">
                      <div class="btn-group ">
                        <button type="button" id="Reasignar" data-formulario="formulario" value="Insert" class="btn btn-success" title="Guardar"> 
                          <i class="fas fa-save"></i> Reasignar
                        </button>
                        <button type="reset" class="btn btn-danger">Limpiar</button>
                        <button type="button" class="btn btn-primary" id="listar" data-toggle="modal" data-target="#ModalBienes" title="Primero debe de seleccionar la Dependencia de origen" disabled>
                            <i class="fas fa-search" ></i> Listar
                        </button>
                      </div>
                    </div>
                  </div>
                </div>  
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- /.content-wrapper -->

<!-- Modal2 -->
<div class="modal fade" id="ModalBienes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Catalogo de Bienes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card-body">
        <div class="table-responsive mx-auto">
          <table id="CatalogoBienes" class="table table-bordered display rowrap table-sm table-hover table-striped rounded-sm catalogo-table" cellspacing="0" style="width: 100%;">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Catalogo</th>
                <th scope="col">Dependencia</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" id="aceptar" data-dismiss="modal">Aceptar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- ./Modal2 -->
</div>
<?php $this->Footer('Reasignacion'); ?>
<script src="<?php echo constant('URL');?>Views/Js/GLOBAL.js"></script>
<script src="<?php echo constant('URL');?>Views/Js/Transaccion.js"></script>
</body>
</html>