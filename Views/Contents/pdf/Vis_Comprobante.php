<?php
  $this->Exit();
  $datos = $this->Control('PDFController')->Comprobante($this->cod_comprobante);
  ob_start();
    
  $comprobante = $datos[0];
  $bienes_nacionales = $datos[1];
  $bienes = $datos[2];
  $almacen = $datos[3];
  
  $fecha = explode('-', $comprobante['fecha']);
  $fecha = array_reverse($fecha);
  $fecha = $fecha[0].'/'.$fecha[1].'/'.$fecha[2];
  

  switch($comprobante['tipo']){
    case 'I':
      $title = "Comprobante de incorporación";
    break;

    case 'R':
      $title = "Comprobante de Desincorporación";
    break;

    case 'D':
      $title = "Comprobante de Reasignación";
    break;
  }
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
        <div>
          <strong>Nº: </strong><?php echo $comprobante['cod'];?>
        </div>

        <div>
          <strong>Fecha: </strong><?php echo $fecha;?>
        </div>
      </div>

      <div class="">
        <h5 class="text-center p-1 ">
          <strong><?php echo $title; ?></strong>
        </h5>
      </div>

      <div class="my-2">

        <table class="w-75 mx-auto text-center">
          <tr class="border border-secondary rounded-lg">
            <td class="w-50 p-2">              
              <span class="p-3 bg-light text-white rounded-circle border border-secondary">O</span>
              <strong>Bienes mueble</strong>
            </td>
            <td class="w-50 p-2">
              <span class="p-3 m-2 bg-light text-white rounded-circle border border-secondary">O</span>
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

      <div class="p-1 bg-secondary text-white">
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

      <div class="bg-secondary">
        <h6 class="text-center pt-1 text-white">
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
            <th scope="col">Catalogo</th>
            <th scope="col">Codigo del bien</th>
            <th scope="col">Descripcion</th>
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
          <tr class="">
            <td class="p-1" width="25%">
              <label>Numero de factura: </label>
              <p><?php echo $comprobante['factura'];?></p>
            </td>
            <td class="p-1">
              <strong>observacion: </strong><?php echo $comprobante['observacion'];?>
            </td>
            <td class="p-1">
              <label>Justificacion: </label>
              <p><?php echo $comprobante['justificacion'];?></p>
            </td>            
          </tr>
        </table>
      </div>

      <div class="bg-secondary">
        <h6 class="text-center text-white p-1">
          <strong>Responsable Patrimonial Primario</strong>
        </h6>
      </div>
      <div class="border border-secondary w-100 text-center">
        <table class="w-100" border="1">
          <tr class="bg-secondary text-center ">
            <td class="text-white">
              <strong>Cedula de identidad</strong>
            </td>
            <td class="text-white">
              <strong>Nombre y Apellido </strong>
            </td>
            <td class="text-white">
              <strong>Cargo </strong>
            </td>
          </tr>
          <tr class="" heigth="30px;">
            <td class="p-2" width="25%">
              11454222
            </td>
            <td class="p-2">
              jose alfredo
            </td>
            <td class="p-2">
              Recto
            </td>      
          </tr>
        </table>
      </div>

      <div class="py-5 text-center ">
        <p><?php echo $bienes_nacionales['nombre'].' '.$bienes_nacionales['apellido'].' '.$bienes_nacionales['dep_name']; ?></p>
      </div>
    </div>
  </div>
</body>
</html>
<?php
  $this->Control('PDFController')->PrintPDF();
?>