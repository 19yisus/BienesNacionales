<?php
	class clsTransaccion extends model{
		private $bien,$Obser,$Dep,$origen,$Factura,$fecha,$orden;

		public function __construct(){
			parent::__construct();
			$this->bien = null;
			$this->Obser = null;
			$this->Dep = null;
			$this->origen = null;
			$this->Factura = null;
			$this->fecha = null;
			$this->orden = null;
		}

		public function setDatos($origen,$Factura,$Dep,$Obser,$bien,$fecha,$orden){
			$this->Obser = $this->Limpiar($Obser);
			$this->Dep = $this->Limpiar($Dep);
			$this->origen = $this->Limpiar($origen);
			$this->Factura = $this->Limpiar($Factura);
			$this->bien = (is_array($bien)) ? $bien : $this->Limpiar($bien);
			$this->fecha = $fecha;
			$this->orden = $this->Limpiar($orden);

			foreach($bien as $key){
				error_log("BIENE INCORPORADO: $key");
			}
		}

		public function Incorporar(){

			try{
				$con = $this->conectar();
				$con->beginTransaction();
				$code_comprobante = $this->CheckCodeComprobante('1');

				$comprobantes = $con->Prepare("INSERT INTO comprobantes(
					com_cod,com_tipo,com_estado,com_dep_user,com_dep_ant,com_fecha_comprobante,com_num_factura,com_orden_compra,com_observacion,com_origen)
					VALUES(:codigo,'I','1',:dependencia,null,:fecha,:num_factura,:orden,:observacion,:origen);");

                $comprobantes->bindParam(":codigo", $code_comprobante);
                $comprobantes->bindParam(":dependencia", $this->Dep);
                $comprobantes->bindParam(":fecha", $this->fecha);
                $comprobantes->bindParam(":num_factura", $this->Factura);
                $comprobantes->bindParam(":orden", $this->orden);
                $comprobantes->bindParam(":observacion", $this->Obser);
                $comprobantes->bindParam(":origen", $this->origen);

                $mov = $con->Prepare("INSERT INTO movimientos(mov_com_incorporacion,mov_com_reasignacion,mov_com_desincorporacion,mov_bien_cod)
                	VALUES(:com_I,null,null,:cod_bien);");

                if($comprobantes->execute()){
                	$response = true;

                	foreach($this->bien as $key){
                		$mov->bindParam(":com_I", $code_comprobante);
	                	$mov->bindParam(":cod_bien", $key);

	                	if(!$mov->execute()){
	                		$con->rollback();
	                		$response = false;
	                		break;
	                	}
                	}

            		if($response){
                		$con->commit();
                		return $this->MakeResponse(200, "Operacion exitosa", `Comprobante: <a href='#' >$code_comprobante</a>`);
                	}else{
                		$con->rollback();
                		return $this->MakeResponse(400, "Operacion Fallida");
                	}
                }else{
                	$con->rollback();
                	return $this->MakeResponse(400, "Operacion Fallida");
                }

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->Incorporar(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		public function Desincorporar(){

			try{
				$con = $this->conectar();
				$con->beginTransaction();
				$code_comprobante = $this->CheckCodeComprobante('1');

				$comprobantes = $con->Prepare("INSERT INTO comprobantes(
					com_cod,com_tipo,com_estado,com_dep_user,com_dep_ant,com_fecha_comprobante,com_num_factura,com_orden_compra,com_observacion,com_origen)
					VALUES(:codigo,'D','1',:dependencia,null,:fecha,null,:orden,:observacion,:origen);");

                $comprobantes->bindParam(":codigo", $code_comprobante);
                $comprobantes->bindParam(":dependencia", $this->Dep);
                $comprobantes->bindParam(":fecha", $this->fecha);
                // $comprobantes->bindParam(":num_factura", $this->Factura);
                $comprobantes->bindParam(":orden", $this->orden);
                $comprobantes->bindParam(":observacion", $this->Obser);
                $comprobantes->bindParam(":origen", $this->origen);

                $mov = $con->Prepare("UPDATE movimientos SET mov_com_desincorporacion = :com_D WHERE mov_bien_cod = :cod_bien;");
								$bien = $con->Prepare("UPDATE bien SET bien_estado = '0' WHERE bien_cod = :cod;");

                if($comprobantes->execute()){
                	$response = true;

                	foreach($this->bien as $key){
                		$mov->bindParam(":com_D", $code_comprobante);
	                	$mov->bindParam(":cod_bien", $key);

										$bien->bindParam(":cod", $key);

	                	if(!$mov->execute()){
	                		$con->rollback();
	                		$response = false;
	                		break;
	                	}

										if(!$bien->execute()){
	                		$con->rollback();
	                		$response = false;
	                		break;
	                	}
                	}

            		if($response){
                		$con->commit();
                		return $this->MakeResponse(200, "Operacion exitosa", `Comprobante: <a href='#' >$code_comprobante</a>`);
                	}else{
                		$con->rollback();
                		return $this->MakeResponse(400, "Operacion Fallida");
                	}
                }else{
                	$con->rollback();
                	return $this->MakeResponse(400, "Operacion Fallida");
                }

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->Desincorporar(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		public function CatalogoComprobantes($tipo){

			try{
				$comprobante = $this->Query("SELECT comprobantes.com_cod,comprobantes.com_origen,
					comprobantes.com_fecha_comprobante,dependencia.dep_des FROM comprobantes
					INNER JOIN dependencia ON dependencia.dep_cod = comprobantes.com_dep_user
					WHERE com_tipo = '$tipo' ;")->fetchAll(PDO::FETCH_ASSOC);

				return ['data' => $comprobante];

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->CatalogoComprobantes(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		public function ConsultarEncargado($id){
			try{
				$con = $this->Query("SELECT per_cedula,per_nombre FROM personas WHERE per_car_cod = '1' ;")->fetch(PDO::FETCH_ASSOC);
				$res = "V-".$con['per_cedula']." ".$con['per_nombre'];
				return $res;
			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->ConsultarEncargado(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		public function BienesNoIncorporados(){
			try{

				$Bienes = $this->Query("SELECT bien_cod,bien_des,bien_fecha_ingreso,bien_catalogo
					FROM bien WHERE bien_estado = '1'
					AND bien_cod NOT IN(SELECT mov_bien_cod FROM movimientos);")->fetchAll(PDO::FETCH_ASSOC);

				return ['data' => $Bienes];

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->BienesNoIncorporados(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		public function BienesIncorporados($dep){
			try{

				$Bienes = $this->Query("SELECT bien.bien_cod,bien.bien_des,bien.bien_catalogo,dependencia.dep_des
					FROM bien
					INNER JOIN movimientos ON movimientos.mov_bien_cod = bien.bien_cod
					INNER JOIN comprobantes ON comprobantes.com_cod = movimientos.mov_com_incorporacion
					OR comprobantes.com_cod = movimientos.mov_com_reasignacion
					INNER JOIN dependencia ON dependencia.dep_cod = comprobantes.com_dep_user
					WHERE bien.bien_estado = '1'
					AND bien.bien_cod IN(SELECT mov_bien_cod FROM movimientos)
					AND comprobantes.com_dep_user = '$dep';")->fetchAll(PDO::FETCH_ASSOC);

				return ['data' => $Bienes];

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->BienesNoIncorporados(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		// public function Update(){

		// 	try{

		// 			$con = $this->Query("SELECT bien_link_bien FROM bien WHERE bien_cod = '$this->oldMaterial' ;")->fetch();

		// 			if(isset($con) && $con['bien_link_bien'] == $this->bien){
		// 				$con2 = $this->Prepare("UPDATE bien SET bien_link_bien = null WHERE bien_cod = :Old_bien_material ;");
		// 				$con2 -> bindParam(":Old_bien_material", $this->oldMaterial);
		// 				$res = $con2 -> execute();

		// 				if($res){
		// 					return $this->Asignar();
		// 				}
		// 				return $this->MakeResponse(400, "Operacion Fallida");
		// 			}

		// 			return $this->MakeResponse(400, "Operacion Fallida");
		// 		}else{
		// 			$con = $this->Query("SELECT bien_link_bien FROM bien WHERE bien_cod = '$this->material' ;")->fetch();

		// 			if(isset($con) && $con['bien_link_bien'] == $this->oldBeneficiado){
		// 				$con2 = $this->Prepare("UPDATE bien SET bien_link_bien = :beneficiado WHERE bien_cod = :material ;");
		// 				$con2 -> bindParam(":material", $this->material);
		// 				$con2 -> bindParam(":beneficiado", $this->bien);
		// 				$res = $con2 ->execute();

		// 				if($res){
		// 					return $this->MakeResponse(200, "Operacion exitosa");
		// 				}
		// 				return $this->MakeResponse(400, "Operacion Fallida");
		// 			}
		// 		}
		// 	}catch(PDOException $e){
		// 		error_log("Error en la consulta::models/ClsMateria->Update(), ERROR = ".$e->getMessage());
		// 		return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
		// 	}
		// }

		public function Consulta($cod){

			try{

				$con = $this->Query("SELECT bien_link_bien,bien_des,bien_precio,bien_fecha_ingreso FROM bien WHERE
				bien_cod = '$cod' ;")->fetch(PDO::FETCH_ASSOC);

				$Material = array(
					'Cod' => $cod,
					'Des' => $con['bien_des'],
					'Pre' => $con['bien_precio'],
					'Fecha' => $con['bien_fecha_ingreso']
				);

				$con2 = $this->Query("SELECT bien_des,bien_precio,bien_fecha_ingreso FROM bien WHERE
				bien_cod = ".$con['bien_link_bien']." ;")->fetch(PDO::FETCH_ASSOC);

				$Bien = array(
					'Cod' => $con['bien_link_bien'],
					'Des' => $con2['bien_des'],
					'Pre' => $con2['bien_precio'],
					'Fecha' => $con2['bien_fecha_ingreso']
				);

				return [
					'Bien' => $Bien, 'Material' => $Material
				];

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->Consulta(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		public function Pag($pagina){

			$encabezados = ['Codigo','Descripcion','Categoria','Asignado al bien','operaciones'];
			$columnas = ['bien_cod','bien_estado','bien_des','cat_des','bien_link_bien'];

			$arreglo = [
        'table' => 'bien',
        'control' => 'MaterialesController',
        'actual' => $pagina,
        'columns' => $columnas,
        'cantColumns' => 5,
        'encabezado' => $encabezados,
        'btnEdLegend' => 'Este Material no puede ser modificado',
        'extraQuery' => 'INNER JOIN clasificacion ON clasificacion.cla_cod = bien.bien_clasificacion_cod
					INNER JOIN categoria ON categoria.cat_cod = clasificacion.cla_cat_cod
					WHERE clasificacion.cla_cat_cod = "MA" AND bien.bien_link_bien IS NOT NULL ',

				'extraSelect' => 'bien.bien_cod,bien.bien_link_bien,bien.bien_des,categoria.cat_des,bien.bien_estado',
				'sin' => ['estado','consul']
      ];
			return $this->paginador($arreglo);

		}
		/**
		 * Function All
		 * Consulta todos los registro de la tabla para generar un paginador del lado del front-end con jquery
		 * @return array
		 */
		public function All($tipo){

			try{
				if($tipo == 'Componente'){
					$data = $this->Query("SELECT bien.bien_cod,bien.bien_des,bien.bien_estado,categoria.cat_des FROM bien
					INNER JOIN clasificacion ON clasificacion.cla_cod = bien.bien_clasificacion_cod
					INNER JOIN categoria ON categoria.cat_cod = clasificacion.cla_cat_cod
					WHERE clasificacion.cla_cat_cod = 'EL' AND bien.bien_link_bien IS NULL AND bien.ifcomponente = '1'
						;")->fetchAll(PDO::FETCH_ASSOC);
				}else{
					$data = $this->Query("SELECT bien.bien_cod,bien.bien_des,bien.bien_estado,categoria.cat_des FROM bien
					INNER JOIN clasificacion ON clasificacion.cla_cod = bien.bien_clasificacion_cod
						INNER JOIN categoria ON categoria.cat_cod = clasificacion.cla_cat_cod
						WHERE clasificacion.cla_cat_cod = 'EL' OR clasificacion.cla_cat_cod = 'TP'
						;")->fetchAll(PDO::FETCH_ASSOC);
				}

				return ['data' => $data];

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsNucleo->All(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		public function ModalAsign(array $tipo){

			if($tipo[0] == 'Materiales'){

				$encabezados = ['Codigo','Descripcion','Categoria','Estado','Opciones'];
				$columnas = ['bien_cod','bien_estado','bien_des','cat_des',];

				$arreglo = [
					'table' => 'bien',
					'control' => 'MaterialesController',
					'actual' => $tipo[1],
					'columns' => $columnas,
					'cantColumns' => 4,
					'encabezado' => $encabezados,
					'btnEdLegend' => '',
					'extraQuery' => 'INNER JOIN clasificacion ON clasificacion.cla_cod = bien.bien_clasificacion_cod
						INNER JOIN categoria ON categoria.cat_cod = clasificacion.cla_cat_cod
						WHERE clasificacion.cla_cat_cod = "EL" AND bien.bien_link_bien IS NULL AND bien.ifcomponente = "1" ',
					'extraSelect' => '
						bien.bien_cod,
						bien.bien_des,
						categoria.cat_des,
						bien.bien_estado',
					'sin' => [

						],
					'btnMaterial' => true,
					'tipo' => 'Materiales'
					];

			}else{

				$encabezados = ['Codigo','Descripcion','Categoria','Estado','Opciones'];
				$columnas = ['bien_cod','bien_estado','bien_des','cat_des',];

				$arreglo = [
					'table' => 'bien',
					'control' => 'MaterialesController',
					'actual' => $tipo[1],
					'columns' => $columnas,
					'cantColumns' => 4,
					'encabezado' => $encabezados,
					'btnEdLegend' => '',
					'extraQuery' => 'INNER JOIN clasificacion ON clasificacion.cla_cod = bien.bien_clasificacion_cod
						INNER JOIN categoria ON categoria.cat_cod = clasificacion.cla_cat_cod
						WHERE clasificacion.cla_cat_cod = "EL" OR clasificacion.cla_cat_cod = "TP" ',
					'extraSelect' => '
						bien.bien_cod,
						bien.bien_des,
						categoria.'.'cat_des'.',
						bien.bien_estado',
					'sin' => [

						],
					'btnMaterial' => true,
					'tipo' => 'Bienes'
					];
			}

			return $this->paginador($arreglo);
		}

		public function SearchById($cod){

			try{
				$Select = "bien_cod,bien_des,bien_precio,bien_fecha_ingreso";
				$con = $this->Query("SELECT $Select FROM bien WHERE bien_cod = $cod ;");

				$res = $con->fetch(PDO::FETCH_ASSOC);

				return [
					'Cod' => $res['bien_cod'],
					'Des' => $res['bien_des'],
					'Pre' => $res['bien_precio'],
					'Fecha' => $res['bien_fecha_ingreso']
				];

			}catch(PDOEXception $e){
				error_log("Error en la consulta::models/ClsTransaccion->SearchById(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
	}
