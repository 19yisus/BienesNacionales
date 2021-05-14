<?php 
  if($con["mar_categoria_cod"] == "BS"){
    $title = "Especie";
    $th2 = "Nombre de la Especie";
    $th3 = "Nº bienes de esta Especie";
    $th4 = "Nº Razas de esta Especie";
    $td4 = $con3["total"];

  }else{
    $title = "Marca";
    $th2 = "Nombre de la marca";
    $th3 = "Nº bienes de esta Marca";
    $th4 = "Categoria";
    $td4 = $con['cat_des'];
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
            if(!is_null($con["mar_fecha_desactivacion"])){
              $date = new DateTime($con["mar_fecha_desactivacion"]);
          ?>
          <th>Fecha desactivación</th>
          <?php 
            }
            if(!is_null($con["mar_fecha_reactivacion"])){
              $date = new DateTime($con["mar_fecha_reactivacion"]);
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
          <td><?php echo $con['mar_cod']; ?></td>
          <td><?php echo $con['mar_des']; ?></td>
          <td><?php echo $con2["total"]; ?></td>
          <td><?php echo $td4; ?></td>
          <?php
            if(!is_null($con["mar_fecha_desactivacion"]) || !is_null($con["mar_fecha_reactivacion"])){
          ?>
          <td><?php echo $date->format("d/m/Y");?></td>
          <?php }?>
          <td class="text-<?php echo (($estado == "Activo") ? "success" : "danger"); ?>" ><?php echo $estado; ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>