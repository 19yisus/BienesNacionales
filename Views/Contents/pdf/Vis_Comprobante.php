<?php
  $this->Exit();
  $datos = $this->Control('PDFController')->Comprobante($this->cod_comprobante);
  ob_start();
    
  $comprobante = $datos[0];
  $bienes_nacionales = $datos[1];
  $bienes = $datos[2];
  $almacen = $datos[3];
  $encargado = $datos[4];
  $ubicacion = $datos[5];

  switch($comprobante['tipo']){
    case 'I':
      $title = "de incorporación";
    break;

    case 'D':
      $title = "de Desincorporación";
    break;

    case 'R':
      $title = "de Reasignación";
    break;
  }

  $box_one = ($comprobante['tipo_bienes'] == 'muebles') ? 'bg-dark text-dark' :'bg-light text-light';
  $box_two = ($comprobante['tipo_bienes'] == 'materiales') ? 'bg-dark text-dark' :'bg-light text-light';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
</head>
<body>
  
  <div class="container">
    <img src="<?php echo constant('URL').'Views/Img/';?>logo.jpg" alt="Logo" class="img-fluid w-100">
    <div class="border rounded border-secondary">
      <div class="p-1 w-100">
        <div style="margin-left: 520px;">
          <strong>Nº: </strong><?php echo $comprobante['cod'];?>
        </div>

        <div style="margin-left: 503px;">
          <strong>Fecha: </strong><?php echo $comprobante['fecha'];?>
        </div>
      </div>

      <div class="">
        <h5 class="text-center p-1 ">
          <strong>Acta <?php echo $title; ?></strong>
        </h5>
      </div>

      <div class="my-1">

        <table class="w-75 mx-auto text-center">
          <tr class="border border-secondary rounded-lg">
            <td class="w-50 p-2">              
              <span class="p-3 <?php echo $box_one;?> rounded-circle border border-secondary">O</span>
              <strong>Bienes mueble</strong>
            </td>
            <td class="w-50 p-2">
              <span class="p-3 m-2 <?php echo $box_two;?> rounded-circle border border-secondary">O</span>
              <strong>Materiales</strong>
            </td>
          </tr>
        </table>
      </div>

      <div class="bg-light">
        <table class="w-100" border="1">
          <tr>
            <td class="w-25 text-center p-1"><strong class="h6">Organismo</strong></td>
            <td class="text-center p-1"><strong class="h6">RIF: G-20010200-4</strong></td>
          </tr>
        </table>
      </div>

      <div class="p-1  text-dark" style="background: #ccc;">
        <div>
          <strong>Denominación: </strong>UNIVERSIDAD POLITECNICA TERRITORIAL DE PORTUGUESA J.J MONTILLA
        </div>
      </div>

      <div class="border border-secondary bg-light w-100">
        <table class="w-100" border="1">
          <tr class="p-1">
            <td class="w-25 text-center"><strong class="h6">Unidad Administrativa</strong></td>
            <td class="text-center"><strong class="h6">Gestion Administrativa</strong></td>
          </tr>
        </table>
      </div>

      <div class="p-1">
        <span class="mr-auto p-1">
          <strong>Denominacion: </strong>
        </span>
      </div>

      <div class="border border-secondary bg-light w-100">
        <table class="w-100" border="1">
          <tr>
            <td class="w-25 text-center p-1"><strong class="h6">Dependencia Usuaria</strong></td>
            <td class="text-center p-1"><strong class="h6"><?php echo $comprobante['dep_des']. ' - '.$comprobante['nuc']; ?></strong></td>
          </tr>
        </table>
        <div class="p-1">
          <span>
            <strong>Denominación: </strong><?php echo $comprobante['dep_cod'];?>
          </span>
        </div>
      </div>

      <div class="" style="background: #ccc;">
        <h6 class="text-center pt-1 text-dark">
          <strong>Responsable de almacen</strong>
        </h6>
      </div>

      <div class="border border-secondary w-100 mx-auto text-center">
        <table class="w-100" border="1">
          <tr>
            <td class="p-1">
              <div>
                <strong>Codigo: </strong><?php echo $almacen['dep_cod'];?>
              </div>
              <div>
                <strong>Denominacion: </strong><?php echo $almacen['dep_name'];?>
              </div>
            </td>
            <td class="p-1">
              <div>
                <strong>Apellido: </strong><?php echo $almacen['apellido'];?>
              </div>

              <div>
                <strong>Cargo: </strong>Encargado(a)
              </div>
            </td>
            <td class="p-1">
              <div>
                <strong>Cedula: </strong><?php echo $almacen['cedula'];?>
              </div>
              <div>
                <strong>Nombre: </strong><?php echo $almacen['nombre'];?>
              </div>
            </td>
          </tr>
        </table>
      </div>

      <div class="w-100 text-center">
        <table border="1" class="w-100">
          <thead>
            <tr class="" style="background: #ccc;">
              <th class="p-1 text-center text-dark">Codigo</th>
              <th class="p-1 text-center text-dark">Concepto</th>
            </tr>
          </thead>
          <tr>
            <td class="p-1 text-center">
              <span>Codigo: 00</span>
            </td>
            <td class="p-1 text-center">
              <span>Concepto: <?php echo $comprobante['origen'];?></span>
            </td>
          </tr>
        </table>
      </div>

      <table class="table table-bordered">
        <thead class="">
          <tr>
            <th scope="col">Cantidad</th>
            <th scope="col">Código del catalogo</th>
            <th scope="col">Numero de inventario (solo para bienes)</th>
            <th scope="col">Descripción</th>
            <th scope="col">Valor Unitario</th>
            <th scope="col">Valor total</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach($bienes as $bien){
              ?>
              <tr>
                <td scope="row"><?php echo $bien['total'];?></td>
                <td><?php echo $bien['catalogo'];?></td>
                <td><?php echo $bien['cod_bien'];?></td>
                <td><?php echo $bien['bien_des'];?></td>
                <td><?php echo $bien['precio'];?></td>
                <td><?php echo $bien['precio_total'];?></td>
              </tr>
              <?php
            }
          ?>
        </tbody>
      </table>
      <div class="border border-secondary w-100 text-center">
        <table class="w-100" border="1">
          <thead>
            <tr class="" style="background: #ccc;">
              <th class="text-dark p-1">Numero de factura</th>
              <th class="text-dark p-1">Observación</th>
              <th class="text-dark p-1">Justificacion</th>
            </tr>
          </thead>
          <tr class="">
            <td class="p-1" width="25%">
              <p><?php echo $comprobante['factura'];?></p>
            </td>
            <td class="p-1">
              <p><?php echo $comprobante['observacion'];?></p>
            </td>
            <td class="p-1">
              <p><?php echo $comprobante['justificacion'];?></p>
            </td>            
          </tr>
        </table>
      </div>

      <div class="" style="background: #ccc;">
        <h6 class="text-center text-dark p-1">
          Responsable Patrimonial Primario
        </h6>
      </div>
      <div class="border border-secondary w-100 text-center">
        <table class="w-100" border="1">
          <tr class=" text-center " style="background: #ccc;">
            <td class="text-dark">
              <strong>Cedula de identidad</strong>
            </td>
            <td class="text-dark">
              <strong>Nombre y Apellido </strong>
            </td>
            <td class="text-dark">
              <strong>Cargo </strong>
            </td>
            <td class="text-dark">
              <strong>Firma </strong>
            </td>
          </tr>
          <tr class="" heigth="30px;">
            <td class="p-2" width="25%">
              <!-- 11454222 -->
            </td>
            <td class="p-2">
              <!-- jose alfredo -->
            </td>
            <td class="p-2">
              Rector/a
            </td>
            <td class="p-2">
              
            </td>
          </tr>
        </table>
      </div>

      <div class="" style="background: #ccc;">
        <h6 class="text-center text-dark p-1">
          <strong>Responsable Patrimonial Por Uso</strong>
        </h6>
      </div>
      <div class="border border-secondary w-100 text-center">
        <table class="w-100" border="1">
          <tr class=" text-center " style="background: #ccc;">
            <td class="text-dark">
              <strong>Cedula de identidad</strong>
            </td>
            <td class="text-dark">
              <strong>Nombre y Apellido </strong>
            </td>
            <td class="text-dark">
              <strong>Cargo </strong>
            </td>
            <td class="text-dark">
              <strong>Firma </strong>
            </td>
          </tr>
          <tr class="" heigth="30px;">
            <td class="p-2" width="25%">
              <?php echo $encargado['cedula'];?>
            </td>
            <td class="p-2">
            <?php echo $encargado['nombre'];?>
            </td>
            <td class="p-2">
              Encargado/a
            </td>
            <td class="p-2">
              
            </td>
          </tr>
        </table>
      </div>
      <?php
        if($comprobante['tipo'] != 'I'){
      ?>
      <div class="">
        <h6 class="text-center p-1">
          <strong>Ubicación geografica</strong>
        </h6>
      </div>
      <div class="border border-secondary w-100 text-center">
        <table class="w-100" border="1">
          <tr class="bg-secondary text-center " style="background: #ccc;">
            <td class="text-dark">
              Región
            </td>
            <td class="text-dark">
              Entidad Federal
            </td>
            <td class="text-dark">
              Sede
            </td>
            <td class="text-dark">
              Direccion 
            </td>
          </tr>
          <tr class="" heigth="30px;">
            <td class="p-2" width="25%">
              18
            </td>
            <td class="p-2">
              Portuguesa
            </td>
            <td class="p-2">
              <?php echo $ubicacion['sede'];?>
            </td>
            <td class="p-2">
            <?php echo $ubicacion['direccion'];?>
            </td>
          </tr>
        </table>
        <table class="w-100" border="1">
          <tr class="" style="background: #ccc;">
            <td class="text-dark">
              <strong>Codigo postal</strong>
            </td>
            <td class="text-dark">
              <strong>Fecha de recepción</strong>
            </td>
            <td class="text-dark">
              <strong>Firma de Recibo Conforme</strong>
            </td>
          </tr>
          <tr>
            <td class="p-2">
            <?php echo $ubicacion['postal'];?>
            </td>
            <td class="p-2">
            </td>
            <td class="p-2">
            </td>
          </tr>          
        </table>
      </div>
      <?php 
        }

        if($comprobante['tipo'] == 'D'){
          ?>
      <div class="border border-secondary w-100">
        <p class=" p-1">
          Observación del destino: <?php echo $comprobante['com_destino'];?>
        </p>
        
      </div>
          <?php
        }
      
      ?>

      <div class="pt-1 text-center">
        <p class="pt-4"><?php echo $bienes_nacionales['nombre'].' '.$bienes_nacionales['apellido'].' '.$bienes_nacionales['dep_name']; ?></p>
      </div>
    </div>
  </div>
</body>
</html>
<?php
  $this->Control('PDFController')->PrintPDF();
?>