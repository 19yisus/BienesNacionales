<div class="card">
  <div class="card-header">
    <h3 class="card-title">Dependencia</h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-sm">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre de la dependencia</th>
          <th>Nucleo</th>
          <?php 
            if(!is_null($con1["dep_fecha_desactivacion"])){
              $date = new DateTime($con1["dep_fecha_desactivacion"]);
          ?>
          <th>Fecha desactivación</th>
          <?php 
            }
            if(!is_null($con1["dep_fecha_reactivacion"])){
              $date = new DateTime($con1["dep_fecha_reactivacion"]);
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
          <td><?php echo $con1["dep_cod"]; ?></td>
          <td><?php echo $con1["dep_des"]; ?></td>
          <td><?php echo $con1["nuc_des"]; ?></td>
          <?php
            if(!is_null($con1["dep_fecha_desactivacion"]) || !is_null($con1["dep_fecha_reactivacion"])){
          ?>
          <td><?php echo $date->format("d/m/Y");?></td>
          <?php }?>
          <td class="text-<?php echo (($estado == "Activo") ? "success" : "danger"); ?>" ><?php echo $estado; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<?php 
if(sizeof($con2) > 0){
  $i = 0;
?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Encargado</h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-sm">
      <thead>
        <tr>
          <th style="width: 10px">ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>cargo</th>
          <th>direccion</th>
          <th>correo</th>
          <th>telefono</th>
          <th>fecha del cargo</th>
          <th>Estado</th>
        </tr>
      </thead>
    <tbody>
<?php 
  while($i < sizeof($con2)){					
    $estado = ($con2[$i]['per_estado'] == 1) ? 'Activo' : 'Innactivo';
    $hasta = isset($con[$i]['per_hasta']) ? $con[$i]['per_hasta'] : 'Sigue';
    $date1 = new DateTime($con2[$i]["per_desde"]);
    $date2 = ($hasta != "Sigue") ? new DateTime($con[$i]['per_hasta']) : null;
    $hasta = (is_null($date2)) ? $hasta : $date2->format("d/m/Y");
?>
      <tr>
        <td><?php echo $con2[$i]["per_cedula"]; ?></td>
        <td><?php echo $con2[$i]["per_nombre"]; ?></td>
        <td><?php echo $con2[$i]["per_apellido"]; ?></td>
        <td><?php echo $con2[$i]["car_des"]; ?></td>
        <td><?php echo $con2[$i]["per_direccion"]; ?></td>
        <td><?php echo $con2[$i]["per_correo"]; ?></td>
        <td><?php echo $con2[$i]["per_telefono"]; ?></td>
        <td><?php echo $date1->format("d/m/Y").' - '.$hasta; ?> </td>
        <td class="text-<?php echo (($estado == "Activo") ? "success" : "danger"); ?>" ><?php echo $estado; ?></td>
      </tr>
<?php 
	$i += 1;
	}
}else{
?>
  <div class="card">
    <div class="card-body p-2">
      <h4 class="text-center text-danger">Sin encargado asignado</h4>
    </div>
  </div>
<?php 
}
?>
