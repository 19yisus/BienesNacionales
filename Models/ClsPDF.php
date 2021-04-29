<?php
  class ClsPDF extends Model{

    public function __construct(){
      parent::__construct();
    }

    public function GetComprobante($codigo){

      try{
        //DATOS DEL COMPROBANTE
        $sql1 = "SELECT comprobantes.com_cod, comprobantes.com_tipo, comprobantes.com_bien_tipos, comprobantes.com_fecha_comprobante, comprobantes.com_num_factura,
          comprobantes.com_justificacion, comprobantes.com_observacion, comprobantes.com_origen, comprobantes.com_info_encargado,
          comprobantes.com_dep_user, comprobantes.com_destino, dependencia.dep_des, nucleo.nuc_des
          FROM comprobantes INNER JOIN dependencia ON dependencia.dep_cod = comprobantes.com_dep_user 
          INNER JOIN nucleo ON nucleo.nuc_cod = dependencia.dep_nucleo_cod
          WHERE comprobantes.com_cod = '$codigo' AND comprobantes.com_estado = 1";
        
        // DATOS DE LOS BIENES PARTE 1
        $sql2 = "SELECT bien.bien_catalogo, bien.bien_cod, bien.bien_des, bien.bien_precio, bien.bien_clasificacion_cod  FROM bien
          INNER JOIN movimientos ON movimientos.mov_bien_cod = bien.bien_cod
          WHERE movimientos.mov_com_cod = '$codigo' OR movimientos.mov_com_desincorporacion = '$codigo' ";
        
        // DATOS DE LOS BIENES PARTE 2 
        $sql3 = "SELECT bien.bien_clasificacion_cod, COUNT(*) AS total, SUM(bien.bien_precio) AS precio_total FROM bien
          INNER JOIN movimientos ON movimientos.mov_bien_cod = bien.bien_cod
          WHERE movimientos.mov_com_cod = '$codigo' OR movimientos.mov_com_desincorporacion = '$codigo'
          GROUP BY bien.bien_clasificacion_cod;";
        
        // ENCARGADO DE ALMACEN Y BIENES NACIONALES
        $sql4 = "SELECT dependencia.dep_cod, dependencia.dep_des, personas.per_cedula, personas.per_nombre, personas.per_apellido
          FROM dependencia INNER JOIN personas ON personas.per_dep_cod = dependencia.dep_cod WHERE dependencia.dep_cod = '2' 
          OR dependencia.dep_cod = '1' ";
        $con1 = $this->Query($sql1)->fetch(PDO::FETCH_ASSOC);

        if($con1){
          $dep = $con1['com_dep_user'];
          $sql5 = "SELECT personas.per_cedula,CONCAT(personas.per_nombre,' ',personas.per_apellido) AS nombre FROM personas WHERE personas.per_dep_cod = $dep AND personas.per_car_cod = 1";
          $sql6 = "SELECT nucleo.nuc_des,nucleo.nuc_direccion,nucleo.nuc_codigo_postal FROM nucleo INNER JOIN dependencia ON dependencia.dep_nucleo_cod = nucleo.nuc_cod WHERE dependencia.dep_cod = $dep";

          $con2 = $this->Query($sql2)->fetchAll();
          $con3 = $this->Query($sql3)->fetchAll();
          $con4 = $this->Query($sql4)->fetchAll();
          $con5 = $this->Query($sql5)->fetch(PDO::FETCH_ASSOC);
          $con6 = $this->Query($sql6)->fetch(PDO::FETCH_ASSOC);

          $encargado = explode(' ',$con1['com_info_encargado']);
          $date = new DateTime($con1['com_fecha_comprobante']);

          $comprobante = [
            'cod' => $con1['com_cod'],
            'fecha' => $date->format('d/m/Y'),
            'tipo_bienes' => $con1['com_bien_tipos'],
            'tipo' => $con1['com_tipo'],
            'factura' => $con1['com_num_factura'],
            'justificacion' => $con1['com_justificacion'],
            'observacion' => $con1['com_observacion'],
            'origen' => $con1['com_origen'],
            'dep_des' => $con1['dep_des'],
            'nuc' => $con1['nuc_des'],
            'dep_cod' => $con1['com_dep_user'],
            'cedula' => $encargado[0],
            'nombre' => $encargado[1],
            'apellido' => $encargado[2],
            'com_destino' => $con1['com_destino']
          ];

          $bienes_nacionales = [
            'nombre' => $con4[0]['per_nombre'],
            'apellido' => $con4[0]['per_apellido'],
            'dep_name' => $con4[0]['dep_des'],
          ];

          $almacen = [
            'cedula' => $con4[1]['per_cedula'],
            'nombre' => $con4[1]['per_nombre'],
            'apellido' => $con4[1]['per_apellido'],
            'dep_cod' => $con4[1]['dep_cod'],
            'dep_name' => $con4[1]['dep_des'],
          ];

          $encargado_dep = [
            'cedula' => $con5['per_cedula'],
            'nombre' => $con5['nombre']
          ];

          $ubicacion = [
            'sede' => $con6['nuc_des'],
            'postal' => $con6['nuc_codigo_postal'],
            'direccion' => $con6['nuc_direccion']
          ];
          
          $bienes = [];
        
          foreach($con2 as $bien){
            $array = [
              'catalogo' => $bien['bien_catalogo'],
              'cod_bien' => $bien['bien_cod'],
              'bien_des' => $bien['bien_des'],
              'precio' => $bien['bien_precio'],
              'cla' => $bien['bien_clasificacion_cod'],
            ];

            if(isset($bienes)){
              
              foreach($bienes as $sub_bien){
                if($array['cla'] == $sub_bien['cla']){
                  unset($array['catalogo'],$array['cod_bien'],$array['precio'],$array['cla']);
                  break;
                }
              }              
              
              if(isset($array['catalogo'])){
                foreach($con3 as $resum){
                  if($array['cla'] == $resum['bien_clasificacion_cod']){
                    $extra = [
                      'total' => $resum['total'],
                      'precio_total' => $resum['precio_total'],
                    ];

                    $array = array_merge($array, $extra);
                  }
                }
                array_push($bienes, $array);
              }

            }else{
              array_push($bienes, $array);
            }   
          }
        }

        return [ $comprobante, $bienes_nacionales, $bienes, $almacen, $encargado_dep, $ubicacion ];
          
      }catch(PDOException $e){
        error_log("Error en la consulta::models/ClsMarcas->Insert(), ERROR = ".$e->getMessage());
				return print_r($e->getMessage());
      }

    }
  }
?>