<?php $this->Headers(); $this->Exit(); ?>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
  <?php $this->Nav();?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php $this->Wraper('Catalogo','Transaccion/Incorporacion/Vis_Index','Incorporacion de Bienes');?>
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
                    <div class="form-group col-2">
                      <label for="">N° de comprobante</label>
                      <input type="text" id="comprobante" class="form-control" readonly title="Codigo del comprobante">
                    </div>
                    <div class="form-group col-2">
                      <label for="">Fecha</label>
                      <input type="date" id="Fecha" class="form-control" readonly title="Fecha de la incorporacion">
                    </div>
                    <div class="form-group col-2">
                      <label for="">Tipos de bienes</label><label for="" id="ob">*</label>
                      <select name="bien_tipos" class="custom-select" id="tipos">
                        <option value="">Seleccione un valor</option>
                        <option value="muebles">Muebles</option>
                        <option value="materiales">Materiales</option>
                        <option value="semoviente">Semovientes</option>
                      </select>
                    </div>
                    <div class="form-group col-3">
                      <label for="">Origen</label><label for="" id="ob">*</label>
                      <select name="origen" id="origen" class="custom-select" required disabled>
                        <option value="">Seleccione un valor</option>
                        <option value="Compra">Compra</option>
                        <option value="Donacion">Donación</option>
                      </select>
                    </div>
                    <div class="form-group col-3">
                      <label for="">N° de factura</label><label for="" id="ob">*</label>
                      <input type="text" name="Factura" id="Factura" pattern="[0-9]{4,10}" class="form-control" placeholder="Factura" minlength="4" title="Solo se permiten numeros " maxlength="10" required disabled>
                    </div>
                    
                  </div>
                  <div class="row">
                    <div class="form-group col-3">
                      <label for="">Justificacion</label><label for="" id="ob">*</label>
                      <input type="text" name="orden" id="orden" class="form-control" pattern="[0-9]{8,10}" minlength="8" maxlength="10" placeholder="Justificacion" title="Solo se permiten numeros" required disabled>
                    </div>
                    <div class="form-group col-6">
                      <label for="">Dependencia</label><label for="" id="ob">*</label>
                      <select name="Dep" id="Dep" class="form-control select-option-special" width="40%" required disabled>
                      <?php echo $this->Control('PersonasController')->SelectDeps(1); ?>
                      </select>
                    </div>
                    <div class="form-group col-3">
                      <label for="">Responsable</label>
                      <input type="text" id="Encargado" name="encargado" class="form-control" placeholder="Encargado" readonly>
                    </div>
                    
                    <div class="form-group col">
                      <label for="">Observacion </label><label for="" id="ob">*</label>
                      <textarea name="Obser" id="Obser" cols="30" rows="1" maxlength="150" minlength="10" class="form-control" placeholder="Observacion" style="text-transform: uppercase;" required disabled></textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="card w-100 bg-light">
                      <div class="card-body">
                        <div class="table-responsive mx-auto">
                          <table id="Transaccion_bienes" class="table table-bordered display rowrap table-sm table-hover table-striped rounded-sm catalogo-table" cellspacing="0" style="width: 100%;">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Fecha de ingreso</th>
                                <th scope="col">Catalogo</th>
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
                        <button type="button" id="Registro" data-formulario="formulario" value="Insert" class="btn btn-success" title="Guardar" disabled>
                          <i class="fas fa-save"></i> Incorporar
                        </button>
                        <button type="reset" class="btn btn-danger">Limpiar</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalBienes" title="Listar bienes" id="listar" disabled>
                            <i class="fas fa-search" ></i> Listar Bienes
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
                <th scope="col">Código</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Fecha de ingreso</th>
                <th scope="col">Catalogo</th>
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
<?php $this->Footer('Incorporacion'); ?>
<script src="<?php echo constant('URL');?>Views/Js/GLOBAL.js"></script>
<script src="<?php echo constant('URL');?>Views/Js/Transaccion.js"></script>
<script src="<?php echo constant('URL');?>Views/Js/Validator.js"></script>
</body>
</html>
