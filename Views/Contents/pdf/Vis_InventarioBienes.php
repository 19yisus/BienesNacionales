<?php
  // $datos = $this->Control('PDFController')->Comprobante($this->cod_comprobante);
  ob_start(); 

  switch($mov){
    case 'I':
      $titulo = "Incorporados";
    break;

    case 'R':
      $titulo = "Reasignados";
    break;

    case 'D':
      $titulo = "Desincorporados";
    break;
  }

  $f = new DateTime($first);
  $s = new DateTime($second);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <div class="container h-100">
    <div class="p1 w-100">
      <img src="<?php echo constant('URL').'Views/Img/';?>logo.jpg" alt="Logo" class="img-fluid w-100">
      <h4 class="text-center">Inventario de Bienes <?php echo $titulo;?> entre las fechas <?php echo $f->format('d/m/Y')." - ".$s->format('d/m/Y');?></h4>
    </div>
    <table class="w-100 text-center mx-auto table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th><small class="text-white">Comprobante</small></th>
          <th><small class="text-white">Fecha del comprobante</small></th>
          <th><small class="text-white">ubicación</small></th>
          <?php
            if($mov != 'I'){
              ?>
          <th><small class="text-white">ubicación anterior</small></th>
              <?php
            }
          ?>
          <th><small class="text-white">Origen</small></th>
          <th><small class="text-white">Código del bien</small></th>
          <th><small class="text-white">Descripcion</small></th>
          <th><small class="text-white">Valor de adquisición</small></th>
          <th><small class="text-white">Depreciación</small></th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach($datos as $dato){
            $fecha = new DateTime($dato['com_fecha_comprobante']);
            ?> 
            <tr>
              <td>
                <small><?php echo $dato['com_cod'];?></small>
              </td>
              <td>
                <small><?php echo $fecha->format('d/m/Y h:m A');?></small>
              </td>
              <td >
                <small><?php echo $dato['ubicacion'];?></small>
              </td>
              <?php
                if($mov != 'I'){
              ?>
              <td style="width:30px;">
                <small><?php echo $dato['anterior'];?></small>
              </td>
                  <?php
                }
              ?>
              <td>
                <small><?php echo $dato['com_origen'];?></small>
              </td>
              <td>
                <small><?php echo $dato['bien_cod'];?></small>
              </td>
              <td>
                <small><?php echo $dato['bien_des'];?></small>
              </td>
              <td>
                <small style="float:left;"><?php echo $dato['bien_divisa'];?></small>
                <small style="float: right;"><?php echo $dato['bien_precio'];?></small>
              </td>
              <td>
                <small style="float: right;"><?php echo $dato['bien_depreciacion'];?></small>
              </td>
            </tr>
            <?php
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
<?php 
  $this->PrintPDF('Inventario_BienesNacionales.pdf','I');
  // header("Location: ".constant('URL').'PDF/Vis_Inventario');
?>