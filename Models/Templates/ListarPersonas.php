<div class="card">
  <div class="card-header">
    <h3 class="card-title">Persona</h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-sm">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Cargo</th>
          <th>Fecha del cargo</th>
          <th>Telefono</th>
          <?php 
            if(!is_null($con1["per_fecha_desactivacion"])){
              $date = new DateTime($con1["per_fecha_desactivacion"]);
          ?>
          <th>Fecha desactivación</th>
          <?php 
            }
            if(!is_null($con1["per_fecha_reactivacion"])){
              $date = new DateTime($con1["per_fecha_reactivacion"]);
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
          <td><?php echo $con1['per_cedula']; ?></td>
          <td><?php echo $con1['per_nombre']; ?></td>
          <td><?php echo $con1['per_apellido']; ?></td>
          <td><?php echo $con1['car_des']; ?></td>
          <td><?php echo $con1['per_desde'].' - '.$hasta; ?></td>
          <td><?php echo $con1['per_telefono']; ?></td>
          <?php
            if(!is_null($con1["per_fecha_desactivacion"]) || !is_null($con1["per_fecha_reactivacion"])){
          ?>
          <td><?php echo $date->format("d/m/Y");?></td>
          <?php }?>
          <td class="text-<?php echo (($estado == "Activo") ? "success" : "danger"); ?>" ><?php echo $estado; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="card-body p-0">
    <table class="table table-sm">
      <thead>
        <tr>
          <th>Dependencia</th>
          <th>Direccion</th>
          <th>Correo</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $con1['dep_des']; ?></td>
          <td><?php echo $con1['per_direccion']; ?></td>
          <td><?php echo $con1['per_correo']; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>