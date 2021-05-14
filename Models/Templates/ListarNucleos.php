<div class="card">
  <div class="card-header">
    <h3 class="card-title">Nucleo</h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-sm">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre del nucleo</th>
          <th>Direccion</th>
          <th>Codigo Postal</th>
          <th>Tipo de nucleo</th>
          <?php 
            if(!is_null($con1["nuc_fecha_desactivacion"])){
              $date = new DateTime($con1["nuc_fecha_desactivacion"]);
          ?>
          <th>Fecha desactivación</th>
          <?php 
            }
            if(!is_null($con1["nuc_fecha_reactivacion"])){
              $date = new DateTime($con1["nuc_fecha_reactivacion"]);
          ?>
          <th>Fecha reactivación</th>
          <?php 
            }
          ?>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $con1['nuc_cod']; ?></td>
          <td><?php echo $con1['nuc_des']; ?></td>
          <td><?php echo $con1['nuc_direccion']; ?></td>
          <td><?php echo $con1['nuc_codigo_postal']; ?></td>
          <td><?php echo $tipo; ?></td>
          <?php
            if(!is_null($con1["nuc_fecha_desactivacion"]) || !is_null($con1["nuc_fecha_reactivacion"])){
          ?>
          <td><?php echo $date->format("d/m/Y");?></td>
          <?php }?>
          <td class="text-<?php echo ($estado == "Activo") ? "success" : "danger"; ?>" ><?php echo $estado; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<?php 

if(sizeof($con2) > 0){
?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Dependencias</h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-sm">
      <thead>
        <tr>
          <th style="width: 10px">ID</th>
          <th>Nombre de la dependencia</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
<?php 
  foreach ($con2 as $key) {
    $estado = ($key['dep_estado'] == '1') ? 'Activo' : 'Innactivo';
?>
  <tr>
    <td><?php echo $key['dep_cod']; ?></td>
    <td><?php echo $key['dep_des']; ?></td>
    <td class="text-<?php echo (($estado == "Activo") ? "success" : "danger"); ?>" ><?php echo $estado; ?></td>
  </tr>
<?php 
  }
}else{
?>
<div class="card">
  <div class="card-body p-2">
    <h4 class="text-center text-danger">Sin dependencias asignadas</h4>
  </div>
</div>
<?php }?>