<?php 
  if($con1["mar_categoria_cod"] == "BS"){
    $title = "Raza";
    $th2 = "Nombre de la Raza";
    $th3 = "Especie";
    $th4 = "Nº bienes con esta Raza";
    $td4 = $con3["total"];

  }else{
    $title = "Modelo";
    $th2 = "Nombre del Modelo";
    $th3 = "Marca";
    $th4 = "Nº bienes con este Modelo";
  }
?>
<div class="card">
  <div class="card-header">
    <h3 class="card-title"><?php echo $title; ?></h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-sm">
      <thead>
        <tr>
          <th>ID</th>
          <th><?php echo $th2; ?></th>
          <th><?php echo $th3; ?></th>
          <th><?php echo $th4; ?></th>
          <?php 
            if(!is_null($con1["mod_fecha_desactivacion"])){
              $date = new DateTime($con1["mod_fecha_desactivacion"]);
          ?>
          <th>Fecha desactivación</th>
          <?php 
            }
            if(!is_null($con1["mod_fecha_reactivacion"])){
              $date = new DateTime($con1["mod_fecha_reactivacion"]);
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
          <td><?php echo $con1["mod_cod"]; ?></td>
          <td><?php echo $con1["mod_des"]; ?></td>
          <td><?php echo $con1["mar_des"]; ?></td>
          <td><?php echo $con2["total"]; ?></td>
          <?php
            if(!is_null($con1["mod_fecha_desactivacion"]) || !is_null($con1["mod_fecha_reactivacion"])){
          ?>
          <td><?php echo $date->format("d/m/Y");?></td>
          <?php }?>
          <td class="text-<?php echo (($estado == "Activo") ? "success" : "danger"); ?>" ><?php echo $estado; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>