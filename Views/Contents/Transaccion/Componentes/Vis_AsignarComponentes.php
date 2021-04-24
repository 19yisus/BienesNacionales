<?php $this->Headers(); $this->Exit(); ?>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
  <?php $this->Nav();?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php $this->Wraper('Home page','Home/Vis_Index','Asignacion de componentes');?>
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Componentes</h3>
              </div>
              <div class="card-body">
                <form class="row" action="" method="get">
                  <div class="form-group col-9">
                    <label for="">Filtrar por dependencias</label>
                    <select name="dep_cod" id="" class="form-custom-select select-option-special w-100" required>
                      <option><?php echo $this->Control('PersonasController')->SelectDeps(4); ?></option>
                    </select>
                  </div>
                  <div class="col-3">
                      <label class="ml-5" for="">Operaciones</label>
                    <div class="form-group text-center">
                      <button class="btn btn-primary" type="submit">Filtrar</button>
                      <a class="btn btn-danger" href="./Vis_AsignarComponentes" id="limpiar">Limpiar</a>
                    </div>
                  </div>
                </form>
              <?php
                  if(isset($_GET['dep_cod'])){
                    $result = $this->Control('TransaccionController')->Componentes($_GET['dep_cod']);                  
                    foreach($result as $comp){
                      ?>
                      <!-- <div class="card"> -->
                        <form method="post" id="form-<?php echo $comp['bien_cod'];?>" class="formulario d-inline-flex flex-row align-items-center col-12 needs-validation" novalidate>
                          <div class="form-group col-2 my-auto py-2">
                            <label for="">Codigo</label>
                            <input type="text" name="componente_cod" placeholder="Codigo" id="" class="form-control" value="<?php echo $comp['bien_cod'];?>" readonly>
                          </div>
                          <div class="form-group col-2 my-auto py-2">
                            <label for="">Descripcion</label>
                            <input type="text" name="" placeholder="Descripcion" id="" class="form-control" value="<?php echo $comp['bien_des'];?>" readonly>
                          </div>
                          <div class="form-group col-2 my-auto py-2">
                            <label for="">Precio</label>
                            <input type="text" name="" placeholder="Precio" id="" class="form-control" value="<?php echo $comp['bien_precio'];?>" readonly>
                          </div>
                          <div class="form-group col-4 my-auto py-2">
                            <label for="">Bien </label><label for="" id="ob">*</label>
                            <select name="bien_cod" id="" class="custom-select select-option-special w-100" title="Bienes electronicos que requieren un componente" required>
                              <option value="">Seleccionar un bien</option>
                              <?php 
                              $var = $this->Control('TransaccionController')->Bienes($comp['bien_cod']);
                              foreach($var as $bien){
                                ?>
                                <option value="<?php echo $bien['bien_cod'];?>"><?php echo $bien['bien_cod'].' - '.$bien['bien_des'];?></option>
                                <?php
                              }
                              ?>
                            </select>
                          </div>
                          
                          <div class="form-group col-2 my-auto">
                            <label for="">Operaciones</label>
                            <button type="button" class="btn btn-success Asignar" value="#form-<?php echo $comp['bien_cod'];?>">
                              <i class="fas fa-save"></i> Asignar
                            </button>
                          </div>
                        </form>
                      <!-- </div> -->
                      <?php
                    }
                  }
              ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- /.content-wrapper -->

  <!-- Modal1 -->
<div class="modal fade" id="ModalComponente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Catalogo de Componentes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="card-body">
        <div class="table-responsive mx-auto">
          <table id="catalogo_componente" class="table table-bordered display rowrap table-sm table-hover table-striped rounded-sm" cellspacing="0" style="width: 100%;">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Categoria</th>
                <th scope="col">Estado</th>
                <th scope="col">Optiones</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- ./Modal1 -->

<!-- Modal2 -->
<div class="modal fade" id="ModalBien" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
          <table id="catalogo_bien" class="table table-bordered display rowrap table-sm table-hover table-striped rounded-sm" cellspacing="0" style="width: 100%;">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Categoria</th>
                <th scope="col">Estado</th>
                <th scope="col">Optiones</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- ./Modal2 -->
</div>
<?php $this->Footer('Componentes'); ?>
<script src="<?php echo constant('URL');?>Views/Js/GLOBAL.js"></script>
</body>
</html>