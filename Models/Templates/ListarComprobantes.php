<?php
  $tipo = $con1['com_tipo'];

  switch($tipo){
    case 'I':
      $tipo_comprobante = "Incorporación";
    break;

    case 'D':
      $tipo_comprobante = "Desincorporación";
    break;

    case 'R':
      $tipo_comprobante = "Reasignación";
    break;
  }

  // var_dump($con1);
?>

<div class="card card-primary card-outline">
  <div class="card-header">
    <h1 class="card-title"><strong>Datos del comprobante</strong></h1>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-sm">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Tipo de comprobante</th>
          <th>Fecha</th>
          <th>Dependencia</th>
          <?php if($tipo != 'D'){?>
          <th>Nº de factura</th>
          <?php }?>
          <th>Origen</th>
          <th>Justifcación</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $con1['com_cod'];?></td>
          <td><?php echo $tipo_comprobante;?></td>
          <td><?php echo $con1['com_fecha_comprobante'];?></td>
          <td><?php echo $con1['dep_des'];?></td>
          <?php if($tipo != 'D'){?>
          <td><?php echo $con1['com_num_factura'];?></td>
          <?php }?>
          <td><?php echo $con1['com_origen'];?></td>
          <td><?php echo $con1['com_justificacion'];?></td>
        </tr>
      </tbody>
    </table>
    <div class="card-footer">
      <p><strong>Observación: </strong><?php echo $con1['com_observacion'];?></p>
    </div>
  </div>
</div>
<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">Datos de los bienes de este comprobante</h3>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-sm">
      <thead>
        <tr>
          <th>Codigo</th>
          <th>Descripción</th>
          <th>Fecha de registro</th>
          <th>Catalogo</th>
          <th>Precio</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
<?php
  $n = 0;
  foreach($con2 as $bien){
    $estado = $bien['bien_estado'] == 1 ? "Activo" : "Innactivo";
    ?>
        <tr>
          <td><?php echo $bien['bien_cod'];?></td>
          <td><?php echo $bien['bien_des'];?></td>
          <td><?php echo $bien['bien_fecha_ingreso'];?></td>
          <td><?php echo $bien['bien_catalogo'];?></td>
          <td><?php echo $bien['bien_precio'];?></td>
          <td class="text-<?php echo ($estado == "Activo") ? "success" : "danger";?>"><?php echo $estado;?></td>
        </tr>
    <?php
    if($bien['bien_link_bien'] != null){
      $n =+ 1;
    }
  }
?>
      </tbody>
    </table>
    <?php
      if($n > 0){
        ?>
    <div class="card-footer">
      <strong>Componentes:</strong>
      <ul>
        <?php
        foreach($con2 as $componente){
          if(isset($componente['bien_link_bien'])){
            ?>
              <li>El bien con el codigo: "<strong><?php echo $componente['bien_cod'];?></strong>", 
              es un componente del bien con el codigo: "<strong><?php echo $componente['bien_link_bien'];?></strong>"</li>
            <?php
          }
        }
      }
    ?>
      </ul>
    </div>
  </div>
</div>
