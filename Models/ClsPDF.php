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
        
        $con1 = $this->Query($sql1)->fetch(PDO::FETCH_ASSOC);
        $status = ($con1['com_tipo'] == "D") ? 0 : 1;
        
        // DATOS DE LOS BIENES PARTE 1
        $sql2 = "SELECT clasificacion.cla_cat_cod, bien.bien_peso,bien.bien_catalogo, bien.bien_cod, bien.bien_des, bien.bien_precio, 
          bien.bien_clasificacion_cod  FROM bien
          INNER JOIN movimientos ON movimientos.mov_bien_cod = bien.bien_cod
          INNER JOIN clasificacion ON clasificacion.cla_cod = bien.bien_clasificacion_cod
          WHERE movimientos.mov_com_cod = '$codigo' AND bien.bien_estado = $status OR movimientos.mov_com_desincorporacion = '$codigo' AND bien.bien_estado = $status ;";
        
        // ENCARGADO DE ALMACEN Y BIENES NACIONALES
        $sql4 = "SELECT dependencia.dep_cod, dependencia.dep_des, personas.per_cedula, personas.per_nombre, personas.per_apellido
          FROM dependencia INNER JOIN personas ON personas.per_dep_cod = dependencia.dep_cod WHERE dependencia.dep_cod = '2' 
          OR dependencia.dep_cod = '1' AND personas.per_car_cod = 1 ORDER BY dependencia.dep_cod ASC";
        

        if($con1){
          $dep = $con1['com_dep_user'];
          $sql5 = "SELECT personas.per_cedula,CONCAT(personas.per_nombre,' ',personas.per_apellido) AS nombre FROM personas WHERE personas.per_dep_cod = $dep AND personas.per_car_cod = 1";
          $sql6 = "SELECT nucleo.nuc_des,nucleo.nuc_direccion,nucleo.nuc_codigo_postal FROM nucleo INNER JOIN dependencia ON dependencia.dep_nucleo_cod = nucleo.nuc_cod WHERE dependencia.dep_cod = $dep";

          $con2 = $this->Query($sql2)->fetchAll();
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
          $n = 1;
                    
          foreach($con2 as $bien){
            if($bien['cla_cat_cod'] != 'BS'){
              $array = [
                'categoria' => $bien['cla_cat_cod'],
                'catalogo' => $bien['bien_catalogo'],
                'cod_bien' => $bien['bien_cod'],
                'bien_des' => $bien['bien_des'],
                'precio' => $bien['bien_precio'],
                'cla' => $bien['bien_clasificacion_cod'],
              ];
            }else{
              $array = [
                'categoria' => $bien['cla_cat_cod'],
                'cod_bien' => $bien['bien_cod'],
                'bien_des' => $bien['bien_des'],
                'precio' => $bien['bien_precio'],
                'cla' => $bien['bien_clasificacion_cod'],
              ];
            }            
            array_push($bienes,$array);
          }
        }

        // $limid = 3;
        // if($comprobante['tipo'] == 'I'){
        //   $limid = 5;
        // }

        // if(sizeof($bienes) > $limid){
        //   $bienes = array_chunk($bienes, $limid);
        //   $n = sizeof($bienes);
        // }

        return [ $comprobante, $bienes_nacionales, $bienes, $almacen, $encargado_dep, $ubicacion, $n ];
          
      }catch(PDOException $e){
        error_log("Error en la consulta::models/ClsMarcas->Insert(), ERROR = ".$e->getMessage());
				return print_r($e->getMessage());
      }

    }

    public function MakeInventario($m,$f,$s){
      try{
        
        if($m == "D"){
          $estado = 0;
        }else{
          $estado = 1;
        }

        $sql = "SELECT comprobantes.com_cod, comprobantes.com_fecha_comprobante, comprobantes.com_dep_user,
        comprobantes.com_dep_ant, comprobantes.com_origen, bien.bien_cod,bien.bien_des,bien.bien_estado,bien.bien_precio,bien.bien_divisa,
        bien.bien_depreciacion
        FROM bien INNER JOIN movimientos ON movimientos.mov_bien_cod = bien.bien_cod
        INNER JOIN comprobantes ON comprobantes.com_cod = movimientos.mov_com_cod OR comprobantes.com_cod = movimientos.mov_com_desincorporacion
        WHERE comprobantes.com_tipo = '$m' AND  comprobantes.com_fecha_comprobante >= '$f' 
        AND comprobantes.com_fecha_comprobante <= '$s' AND bien.bien_estado = $estado;";
        
        $sql2 = "SELECT CONCAT( nucleo.nuc_des,' ', dependencia.dep_des) AS ubicacion FROM dependencia 
        INNER JOIN nucleo ON nucleo.nuc_cod = dependencia.dep_nucleo_cod WHERE dependencia.dep_cod = :dep ;";
        
        $con = $this->Query($sql)->fetchAll();
        $resultado = [];
        
        if(isset($con[0])){
          
          
          foreach($con AS $res){
            //DEPENDENCIA USUARIA
            $con2 = $this->Prepare($sql2);
            $con2->bindParam(":dep", $res['com_dep_user']);
            $con2->execute();
            $dep_user = $con2->fetch();

            if($m != 'I'){
              //DEPENDENCIA ANTERIOR
              $con3 = $this->Prepare($sql2);
              $con3->bindParam(":dep", $res['com_dep_ant']);
              $con3->execute();
              $dep_ant = $con3->fetch();
            }else{
              $dep_ant['ubicacion'] = '';
            }            

            $arreglo = [
              'com_cod' => $res['com_cod'],
              'com_fecha_comprobante' => $res['com_fecha_comprobante'],
              'ubicacion' => $dep_user['ubicacion'],
              'anterior' => $dep_ant['ubicacion'],
              'com_origen' => $res['com_origen'],
              'bien_cod' => $res['bien_cod'],
              'bien_des' => $res['bien_des'],
              'bien_precio' => $res['bien_precio'],
              'bien_divisa' => $res['bien_divisa'],
              'bien_depreciacion' => $res['bien_depreciacion'],
            ];

            array_push($resultado, $arreglo);
          }
        }

        return $resultado;

      }catch(PDOException $e){
        print_r("SQL Error => ".$e->getMessage());
      }
    }
  }
?>