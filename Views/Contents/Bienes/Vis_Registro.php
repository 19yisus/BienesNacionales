<?php $this->Headers(); $this->Exit(); ?>
<body class="hold-transition sidebar-mini">
	<div class="wrapper">
  <?php $this->Nav();?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper mb-3">
    <?php $this->Wraper('Catalogo','Bienes/Vis_Index','Registro de Bienes');?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- row start -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Registro</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" name="formulario" id="formulario" method="POST" action="#" autocomplete="off"  class="needs-validation" novalidate>
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="">Clasificacion</label><label for="" id="ob">*</label>
                      <select name="Clbien" id="Clbien" class="form-control select-option-special w-100" required>
                        <?php $this->Control('BienesController')->ConsultaClasificacion(); ?>
                      </select>
                    </div>
                    <div class="form-group col">
                      <label for="">Codigo</label><label for="" id="ob">*</label>
                      <input type="text" name="Codbien" id="Cod" class="form-control" placeholder="Codigo" readonly disabled requied>
                    </div>
                    <div class="form-group col">
                      <label for="">Cantidad</label><label for="" id="ob">*</label>
                      <input type="number" pattern="[0-9]{1,3}" name="Cantbien" id="Cantbien" minlength="1" maxlength="3" min="1" max="100" class="form-control" placeholder="Cantidad" disabled required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-7">
                      <label for="">Descripcion</label><label for="" id="ob">*</label>
                      <input type="text" pattern="[A-Za-z ]{2,90}" name="Desbien" id="Desbien" class="form-control" minlength="2" maxlength="90" placeholder="Descripcion" disabled style="text-transform: uppercase;" required>
                    </div>
                    <div class="form-group col-3">
                      <label for="">Precio</label><label for="" id="ob">*</label>
                      <div class="input-group">
                        <input type="text" pattern="[0-9.]{1,9}" name="Valbien" id="Valbien" class="form-control" min="1" minlength="1" maxlength="9" disabled required>
                        <div class="input-group-append">
                          <select name="divisa" id="divisa" class="custom-select" disabled>
                            <option value="Bs">Bs.</option>
                            <option value="$">$.</option>
                          </select>
                        </div>
                      </div>
                    </div>                    
                  </div>
                  <!-- Row1 (Bienes ELectronicos, Materiales, Material de oficina, Transporte) -->
                  <div class="row EL MA OF TP" id="fila" style="display:none;">
                    <!-- Caracteristicas muebles -->
                    <div class="form-group col-md-4">
                      <label for="">Marca</label><label for="" id="ob">*</label>
                      <select name="Marca" id="Marca" class="custom-select" disabled required>
                        <option value="">Seleccione un valor</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">Modelo</label><label for="" id="ob">*</label>
                      <select name="Modelo" id="Modelo" class="custom-select" disabled required>
                        <option value="">Seleccione un valor</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="">Color</label><label for="" id="ob">*</label>
                      <select name="Color" id="Color" class="custom-select" disabled required>
                      <?php echo $this->Control('BienesController')->SelectColores(); ?>
                      </select>
                    </div>
                  </div>
                  <!-- ./Row1 -->
                  <!-- Row2 (Bienes ELectronicos, Materiales, Material de oficina, Transporte) -->
                  <div class="row EL MA OF" id="fila" style="display:none;">
                    <div class="form-group col-md-4">
                      <label for="">Catalogo</label><label for="" id="ob">*</label>
                      <input type="text" name="Catalogo" pattern="[0-9-]{10,20}" id="Catalogo" style="text-transform: uppercase;" pattern="Minimo 10 caracteres, Maximo 20" minlength="10" maxlength="20" class="form-control" placeholder="Catalogo" disabled required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="">Serial</label><label for="" id="ob">*</label>
                      <input type="text" name="Serial" id="Serial" minlength="4"style="text-transform: uppercase;" maxlength="20" class="form-control" placeholder="Serial" disabled required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="">Depreciacion</label><label for="" id="ob">*</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Bs</span>
                        </div>
                        <input type="text" pattern="[0-9.,]{1,9}" name="Depre" id="Depre" min="0" minlength="1" maxlength="9" class="form-control" disabled required>
                      </div>
                    </div>
                    <div class="col-md-2 form-group">
                      <div class="form-check">
                        <input type="checkbox" name="componente" id="if_componente" class="form-check-input" value="1" disabled>
                        <label class="form-check-label" for="">Es un componente?</label>
                      </div>
                    </div>
                  </div>
                  <!-- ./Row2 -->             
                  <!-- Row3 (Transporte)-->
                  <div class="row TP" id="fila" style="display:none;">
                    <div class="form-group col-md-3">
                      <label for="">Placa</label><label for="" id="ob">*</label>
                      <input type="text" name="Placa" id="Placa" class="form-control" minlength="6" maxlength="6" placeholder="Placa" disabled style="text-transform: uppercase;" required>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="">Año</label><label for="" id="ob">*</label>
                      <input type="number" name="Anio" id="Anio" step="1" max="<?php echo $this->Control('BienesController')->Year();?>" min="1990" minlength="4" maxlength="4" class="form-control" placeholder="Año" disabled required>
                    </div>
                  </div>
                  <!-- ./Row3 -->
                  <!-- Row4 (Bien Inmueble) -->
                  <div class="row IN" id="fila" style="display:none;">
                    <div class="form-group col-md-5">
                      <label for="">Terreno</label><label for="" id="ob">*</label>
                      <textarea name="Terreno" id="Terreno" class="form-control" minlength="10" maxlength="120" cols="15" rows="3" placeholder="Descripcion del terreno" disabled required></textarea>
                    </div>
                  </div>
                  <!-- ./Row4 -->
                  <!-- Row5 (Bien Semoviente) -->
                  <div class="row BS" id="fila" style="display:none;">
                    <div class="form-group col-md-4">
                      <label for="">Especie</label><label for="" id="ob">*</label>
                      <select name="Esp" id="Esp" class="custom-select" disabled required>
                      </select>
                    </div>
                    <div class="form-group col-md-3">
                      <label for="">Raza</label><label for="" id="ob">*</label>
                      <select name="Raza" id="Raza" class="custom-select" disabled required>
                      </select>
                    </div>                 
                    <div class="form-group col-md-3">
                      <label for="">Peso</label><label for="" id="ob">*</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Kg</span>
                        </div>
                        <input type="text" name="Peso" pattern="[0-9.]{2,4}" id="Peso"  min="1" minlength="2" maxlength="4" class="form-control" disabled required>
                      </div>
                    </div>
                    <div class="form-group col-md-2">
                      <label for="">Sexo</label><label for="" id="ob">*</label>
                      <div class="form-check">
                        <input type="radio" name="sexo" id="S1" value='F' class="form-check-input" disabled required>
                        <label for="S1" class="form-check-label">F</label>
                      </div>
                      <div class="form-check">
                        <input type="radio" name="sexo" id="S2" value='M' class="form-check-input" disabled required>
                        <label for="S2" class="form-check-label">M</label>
                      </div>
                    </div>
                  </div>
                  <!-- ./Row5 -->

                  <div class="row card-footer">
                    <div class="col-md-12 text-center">
                      <div class="btn-group ">
                        <button type="button" id="btnAdd" data-formulario="formulario" value="Insert" class="btn btn-success" title="Guardar"> 
                          <i class="fas fa-save"></i> Registrar
                        </button>
                        <button type="reset" class="btn btn-danger">  Limpiar</button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalCatalogo"> 
                            <i class="fas fa-search" ></i> Listar
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </form>
              <!-- ./form end -->
            </div>
          </div>
        </div>
        <!-- ./row end -->
      </div>
    </div>
  <!-- /.content-wrapper -->
</div>
<?php $this->Footer('Bienes'); ?>
<script src="<?php echo constant('URL');?>Views/Js/GLOBAL.js"></script>
<script src="<?php echo constant('URL');?>Views/Js/Bienes/FormDinamic.js"></script>
</body>
</html>

