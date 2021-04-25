<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="ml-1 text-info"><?php echo $controlador; ?></h1>
      </div><!-- /.col -->
      <?php 
      if($this->IfSession()){
        if($this->GetDatos('permisos')['crear'] == 1 && $ruta != ''){
        ?>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <?php 
            $result = $this->Control('TransaccionController')->Componentes('');
            
            if(isset($result[0])){
              if(strpos($ruta,'Transaccion') !== false){
                ?>
                  <li class="breadcrumb-item">
                    <a href="<?php echo constant('URL')?>Transaccion/Componentes/Vis_AsignarComponentes" class="btn btn-outline-danger">Reemplazar Componentes</a>
                  </li>
                <?php
              } 
            }            
            if(strpos($ruta,'Bienes') !== false){
              $incorporado = $this->Control('BienesController')->Incorporados('any');
                          
              if(isset($incorporado['data']['bien_cod'])){
              ?>
              <li class="breadcrumb-item">
                  <a href="<?php echo constant('URL')?>Bienes/Vis_Incorporados" class="btn btn-outline-success">Bienes Incorporados</a>
                </li>
              <?php
              }
            }
          ?>
          <li class="breadcrumb-item">
            <a class="btn btn-outline-primary" href="<?php echo constant('URL').$ruta;?>"><?php echo $vista;?></a>
          </li>
        </ol>
      </div><!-- /.col -->
    <?php 
        }
      }
    ?>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->