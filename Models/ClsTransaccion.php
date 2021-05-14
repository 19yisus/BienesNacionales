<?php
	class clsTransaccion extends model{
		private $bien,$Obser,$Dep_anterior,$Dep_actual,$origen,$Factura,$fecha,$orden,$encargado, $tipo_bienes, $destino;

		public function __construct(){
			parent::__construct();
			$this->bien = null;
			$this->Obser = null;
			$this->Dep_actual = null;
			$this->Dep_anterior = null;
			$this->origen = null;
			$this->Factura = null;
			$this->fecha = null;
			$this->orden = null;
			$this->encargado = null;
			$this->tipo_bienes = null;
			$this->destino = null;
		}

		public function setDatos($origen,$Factura,$Dep_actual,$Dep_anterior,$Obser,$bien,$fecha,$orden,$encargado, $tipo_bienes, $destino){
			$this->Obser = isset($Obser) ? $this->Limpiar($Obser) : null;
			$this->Dep_anterior = isset($Dep_anterior) ? $this->Limpiar($Dep_anterior) : null;
			$this->Dep_actual = isset($Dep_actual) ? $this->Limpiar($Dep_actual) : null;
			$this->origen = isset($origen) ? $this->Limpiar($origen) : null;
			$this->Factura = isset($Factura) ? $this->Limpiar($Factura) : null;
			$this->bien = (is_array($bien)) ? $bien : array($bien);
			$this->fecha = $fecha;
			$this->orden = isset($orden) ? $this->Limpiar($orden) : null;
			$this->encargado = isset($encargado) ? $this->Limpiar($encargado) : null;
			$this->tipo_bienes = isset($tipo_bienes) ? $tipo_bienes : null;
			$this->destino = isset($destino) ? $this->Limpiar($destino) : null;
		}

		private function CreateComprobante($conexion,$tipo){
			$usuario = $this->session->GetDatos("user_id"). "-".$this->session->GetDatos("user_name");
			$code_comprobante = $this->CheckCodeComprobante('1');
			$comprobantes = $conexion->Prepare("INSERT INTO comprobantes(com_cod,com_tipo,com_bien_tipos,com_estado,com_dep_user,com_dep_ant,
			com_fecha_comprobante,com_num_factura,com_justificacion,com_observacion,com_origen,com_destino,com_info_encargado,com_info_usuario)
				VALUES(:codigo,'$tipo',:tipos,'1',:dependencia,:dependencia_ant,NOW(),:num_factura,:orden,:observacion,:origen,:destino,:encargado,:usuario);");

			$comprobantes->bindParam(":codigo", $code_comprobante);
			$comprobantes->bindParam(":dependencia", $this->Dep_actual);
			$comprobantes->bindParam(":dependencia_ant", $this->Dep_anterior);
			$comprobantes->bindParam(":num_factura", $this->Factura);
			$comprobantes->bindParam(":orden", $this->orden);
			$comprobantes->bindParam(":observacion", $this->Obser);
			$comprobantes->bindParam(":origen", $this->origen);
			$comprobantes->bindParam(":destino", $this->destino);
			$comprobantes->bindParam(":encargado", $this->encargado);
			$comprobantes->bindParam(":usuario", $usuario);
			$comprobantes->bindParam(":tipos", $this->tipo_bienes);

			return [ $comprobantes, $code_comprobante ];
		}

		private function GetComps(){
			$array_mov = [];

			foreach($this->bien as $bien_cod){
				$info_mov = $this->Query("SELECT movimientos.mov_com_cod,movimientos.mov_com_desincorporacion FROM movimientos WHERE movimientos.mov_bien_cod = '$bien_cod' ;")->fetch(PDO::FETCH_ASSOC);
				
				if(!isset($array_mov[0])){

					if(isset($info_mov['mov_com_cod'])){
						array_push($array_mov,['com_cod' => $info_mov['mov_com_cod']]);
					}
					if(isset($info_mov['mov_com_desincorporacion'])){
						array_push($array_mov,['com_cod' => $info_mov['mov_com_desincorporacion']]);
					}
				}else{
					foreach($array_mov as $row){
						
						if(isset($info_mov['mov_com_cod'])){
							if(!in_array($info_mov['mov_com_cod'], $row)){
								array_push($array_mov, ['com_cod' => $info_mov['mov_com_cod']]);
							}
						}

						if(isset($info_mov['mov_com_desincorporacion'])){
							if(!in_array($info_mov['mov_com_desincorporacion'], $row)){
								array_push($array_mov, ['com_cod' => $info_mov['mov_com_desincorporacion']]);
							}
						}
					}
				}	
			}	
			
			return $array_mov;
		}

		private function checkComprobantes($array){
			
			foreach($array as $comprobante){
				$codigo = $comprobante['com_cod'];

				$sql = "SELECT * FROM movimientos WHERE movimientos.mov_com_cod = '$codigo' OR movimientos.mov_com_desincorporacion = '$codigo';";
				$con = $this->Query($sql)->fetchAll();

				if(!isset($con[0])){
					$this->Query("UPDATE comprobantes SET comprobantes.com_estado = 0 WHERE comprobantes.com_cod = '$codigo' ;");
				}
			}
		}

		public function Incorporar(){

			try{
				$con = $this->conectar();
				$con->beginTransaction();
				$res = $this->CreateComprobante($con, 'I');
				$mov = $con->Prepare("INSERT INTO movimientos(mov_com_cod,mov_com_desincorporacion,mov_bien_cod) VALUES(:com_I,null,:cod_bien);");
				if($res[0]->execute()){
					$response = true;

					foreach($this->bien as $key){
						$mov->bindParam(":com_I", $res[1]);
						$mov->bindParam(":cod_bien", $key);

						if(!$mov->execute()){
							$con->rollback();
							$response = false;
							break;
						}
					}

				if($response){
						$con->commit();
						return $this->MakeResponse(200, "Operacion exitosa","", [
							'valid' => true,
							'url' => constant('URL') .'PDF/Vis_Comprobante/'. $res[1]
						]);
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
				$res = $this->CreateComprobante($con, 'D');
				$mov = $con->Prepare("UPDATE movimientos SET mov_com_desincorporacion = :com_D WHERE mov_bien_cod = :cod_bien;");
				$bien = $con->Prepare("UPDATE bien SET bien_estado = '0', bien_fecha_desactivacion = NOW(), bien_fecha_reactivacion = null WHERE bien_cod = :cod;");
				$this->CatchComponentes();
				$cod_comps = $this->GetComps();
				
				if($res[0]->execute()){
					$response = true;

					foreach($this->bien as $key){

						$mov->bindParam(":com_D", $res[1]);
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
						$this->checkComprobantes($cod_comps);
						return $this->MakeResponse(200, "Operacion exitosa","", [
							'valid' => true,
							'url' => constant('URL') .'PDF/Vis_Comprobante/'. $res[1]
						]);
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

		public function Reasignar(){

			try{
				$con = $this->conectar();
				$con->beginTransaction();
				$res = $this->CreateComprobante($con, 'R');
				$mov = $con->Prepare("UPDATE movimientos SET mov_com_cod = :com_R WHERE mov_bien_cod = :cod_bien;");
				$bien = $con->Prepare("UPDATE bien SET bien_estado = '1', bien_fecha_desactivacion = null, bien_fecha_reactivacion = NOW()  WHERE bien_cod = :cod;");
				$this->CatchComponentes();
				$cod_comps = $this->GetComps();

				if($res[0]->execute()){
					$response = true;
					
					foreach($this->bien as $key){
						
						$mov->bindParam(":com_R", $res[1]);
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
						$this->checkComprobantes($cod_comps);
						return $this->MakeResponse(200, "Operacion exitosa","", [
							'valid' => true,
							'url' => constant('URL') .'PDF/Vis_Comprobante/'. $res[1]
						]);
					}else{
						$con->rollback();
						return $this->MakeResponse(400, "Operacion Fallida");
					}
				}else{
					$con->rollback();
					return $this->MakeResponse(400, "Operacion Fallida");
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->Reasignar(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		
		public function CatchComponentes(){
			foreach($this->bien as $bien_cod){
				$con1 = $this->Query("SELECT bien.ifcomponente,bien.bien_link_bien FROM bien WHERE bien.bien_cod = '$bien_cod';")->fetch();
				
				if($con1['ifcomponente'] == 1){
					if(!in_array($con1['bien_link_bien'], $this->bien)){
						array_push($this->bien, $con1['bien_link_bien']);
					}
				}else{
				
					$con2 = $this->Query("SELECT bien.bien_cod FROM bien WHERE bien.bien_link_bien = '$bien_cod' ;");
					while($key = $con2->fetch(PDO::FETCH_ASSOC)){
						$c = $key['bien_cod'];

						if(!in_array($key['bien_cod'], $this->bien)){
							array_push($this->bien, $key['bien_cod']);
						}
					}
				}
			}
		}

		public function ValidTransacciones($name_transaction){

			try{

				switch($name_transaction){
					case 'I':
						$res = $this->Bienes('','');
					break;

					case 'D':
						$res = $this->Bienes('Incorporado','withoutDep');
					break;

					case 'R':
						$res = $this->Bienes('Desincorporado','withoutDep');
					break;
				}

				return isset($res);

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->ValidTransacciones(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		public function CatalogoComprobantes($tipo){

			try{
				$select_inner = ",dependencia.dep_des FROM comprobantes INNER JOIN dependencia ON dependencia.dep_cod = comprobantes.com_dep_user
						INNER JOIN movimientos ON movimientos.mov_com_cod = comprobantes.com_cod OR  movimientos.mov_com_desincorporacion = comprobantes.com_cod";

				$where = "";
				
				if($tipo != "A"){
					if($tipo == "I"){
						$where = " WHERE com_tipo != 'D' ";
					}elseif($tipo == "Desactivados"){
						$select_inner = " FROM comprobantes ";
						$where = " WHERE comprobantes.com_estado = 0 ";
					}else{
						$where = " WHERE com_tipo = '$tipo' ";
					}
				}

				$comprobante = $this->Query("SELECT comprobantes.com_cod,COUNT(comprobantes.com_cod) AS total_bienes,comprobantes.com_origen,
					comprobantes.com_tipo,comprobantes.com_fecha_comprobante $select_inner $where GROUP BY comprobantes.com_cod;")->fetchAll(PDO::FETCH_ASSOC);

				$n = sizeof($comprobante);
				for($i = 0; $i < $n; $i++){
					$date = new DateTIme($comprobante[$i]['com_fecha_comprobante']);
					$comprobante[$i]['com_fecha_comprobante'] = $date->format('d/m/Y');
				}

				return ['data' => $comprobante];

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->CatalogoComprobantes(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		public function ConsultarEncargado($id){
			try{
				$dep = $this->Query("SELECT dep_cod FROM dependencia WHERE dep_cod = $id")->fetch();
				if(isset($dep[0])){
					$con = $this->Query("SELECT per_cedula,per_nombre,per_apellido FROM personas WHERE per_car_cod = '1' AND per_dep_cod = $id ;")->fetch();
					if(isset($con[0])){
						$res = "V-".$con['per_cedula']." ".$con['per_nombre']." ".$con["per_apellido"];
					}else{
						$res = 'Sin-encargado';
					}
				}else{
					$res = 'No-dependencia';
				}

				return $res;
				
				
			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->ConsultarEncargado(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		public function Componentes_bienes($condition, $codigo = '', $por_dependencia = ''){

			try{

				if($condition == 'Componentes'){
					if($por_dependencia == ''){

						$con = $this->Query("SELECT bien.bien_cod,bien.bien_des,bien.bien_precio FROM bien 
							INNER JOIN movimientos ON movimientos.mov_bien_cod = bien.bien_cod 
							WHERE bien.ifcomponente = 1 AND bien.bien_link_bien IS NULL AND bien.bien_estado = 1;")->fetchAll(PDO::FETCH_ASSOC);
					}else{
						$con = $this->Query("SELECT DISTINCT bien.bien_cod,bien.bien_des,bien.bien_precio FROM bien 
							INNER JOIN movimientos ON movimientos.mov_bien_cod = bien.bien_cod 
							INNER JOIN comprobantes ON comprobantes.com_cod = movimientos.mov_com_cod
							WHERE bien.ifcomponente = 1 AND bien.bien_link_bien IS NULL AND bien.bien_estado = 1 
							AND comprobantes.com_dep_user = $por_dependencia;")->fetchAll(PDO::FETCH_ASSOC);
					}
				}else if($condition == 'Electronicos'){
					$con = $this->Query("SELECT bien.bien_cod, bien.bien_des FROM bien
						INNER JOIN clasificacion ON clasificacion.cla_cod = bien.bien_clasificacion_cod
						INNER JOIN categoria ON categoria.cat_cod = clasificacion.cla_cat_cod
						INNER JOIN movimientos ON movimientos.mov_bien_cod = bien.bien_cod
						INNER JOIN comprobantes ON comprobantes.com_cod = movimientos.mov_com_cod WHERE
						clasificacion.cla_cat_cod = 'EL' AND bien.ifcomponente = 0 AND bien.bien_estado = '1' AND comprobantes.com_dep_user =(
						SELECT comprobantes.com_dep_user FROM movimientos
						INNER JOIN comprobantes ON comprobantes.com_cod = movimientos.mov_com_cod
						WHERE movimientos.mov_bien_cod = $codigo );")->fetchAll(PDO::FETCH_ASSOC);
				}				
				
				if(isset($con[0])){
					return $con;		
				}
				return [];

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->Componentes_bienes(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		public function Bienes($conditions, $dep, $tipo){
			try{
				$estado = ($conditions == 'Incorporado' ? 1 : 0);
				$extraJoin = "INNER JOIN comprobantes ON comprobantes.com_cod = movimientos.mov_com_desincorporacion";
				$where = " AND clasificacion.cla_cat_cod != 'MA' AND clasificacion.cla_cat_cod != 'BS' ";

				if($tipo == "materiales"){
					$where = " AND clasificacion.cla_cat_cod = 'MA' ";
				}elseif($tipo == "semoviente"){
					$where = " AND clasificacion.cla_cat_cod = 'BS' ";
				}

				error_log($tipo);
				
				if($estado == 1){
					$extraJoin = "INNER JOIN comprobantes ON comprobantes.com_cod = movimientos.mov_com_cod";
				}
				
				if($conditions != ''){
					// OR comprobantes.com_cod = movimientos.mov_com_reasignacion
					$com_depUser = '';

					if($dep != 'withoutDep'){
						$com_depUser = "AND comprobantes.com_dep_user = '$dep' ";
					}

					$Bienes = $this->Query("SELECT bien.bien_cod,bien.bien_des,bien.bien_catalogo,dependencia.dep_des FROM bien
						INNER JOIN clasificacion ON clasificacion.cla_cod = bien.bien_clasificacion_cod
						INNER JOIN movimientos ON movimientos.mov_bien_cod = bien.bien_cod $extraJoin
						INNER JOIN dependencia ON dependencia.dep_cod = comprobantes.com_dep_user WHERE bien.bien_estado = $estado
						AND bien.bien_cod IN(SELECT mov_bien_cod FROM movimientos) $where ")->fetchAll(PDO::FETCH_ASSOC);

				}else{
					$sql = "SELECT bien.bien_cod,bien.bien_des,bien.bien_fecha_ingreso,bien.bien_catalogo FROM bien
					INNER JOIN clasificacion ON clasificacion.cla_cod = bien.bien_clasificacion_cod
					WHERE bien.bien_estado = '1' AND bien.bien_cod NOT IN(SELECT movimientos.mov_bien_cod FROM movimientos) $where ";

					$Bienes = $this->Query($sql)->fetchAll(PDO::FETCH_ASSOC);
				}
				
				return ['data' => $Bienes];

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->BienesNoIncorporados(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		public function Asignar($componente,$bien){

			try{
				$con2 = $this->Prepare("UPDATE bien SET bien_link_bien = :beneficiado WHERE bien_cod = :material ;");
				$con2 -> bindParam(":material", $componente);
				$con2 -> bindParam(":beneficiado", $bien);
				$res = $con2 ->execute();
				if($res){
					return $this->MakeResponse(200, "Operacion exitosa");
				}
				return $this->MakeResponse(400, "Operacion Fallida");

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->Asignar(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		public function Listar($codigo){
			try{
				$sql1 = "SELECT DISTINCT comprobantes.com_cod, comprobantes.com_tipo, dependencia.dep_des, comprobantes.com_fecha_comprobante, 
					comprobantes.com_num_factura, comprobantes.com_justificacion, comprobantes.com_observacion, comprobantes.com_origen, comprobantes.com_info_encargado,comprobantes.com_info_usuario
					FROM comprobantes
					INNER JOIN movimientos ON movimientos.mov_com_cod = comprobantes.com_cod 
					OR movimientos.mov_com_desincorporacion = comprobantes.com_cod
					INNER JOIN dependencia ON dependencia.dep_cod = comprobantes.com_dep_user
					WHERE comprobantes.com_cod = '$codigo'; ";

				$con1 = $this->Query($sql1)->fetch(PDO::FETCH_ASSOC);

				if($con1['com_tipo'] == "D"){
					$status = 0;
				}else{
					$status = 1;
				}

				$sql2 = "SELECT bien.bien_cod, bien.bien_des, bien.bien_fecha_ingreso, bien.bien_catalogo, bien.bien_precio, bien.ifcomponente,
					bien.bien_link_bien, bien.bien_estado, bien.bien_divisa FROM bien INNER JOIN movimientos ON movimientos.mov_bien_cod = bien.bien_cod 
					WHERE movimientos.mov_com_cod = '$codigo' OR movimientos.mov_com_desincorporacion = '$codigo' AND bien.bien_estado = $status;";
					
				$con2 = $this->Query($sql2)->fetchAll(PDO::FETCH_ASSOC);	
					
					
					require_once 'Templates/ListarComprobantes.php';
				
			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->Listar(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}			
		}

		/**
		 * Function Destroy
		 * Elimina fisicamente un registro de la base de datos que ya no este en uso
		 * @return array
		 */
		public function Destroy($cod){

			try{
				$con1 = $this->Query("SELECT * FROM movimientos WHERE mov_com_cod = '$cod' OR mov_com_desincorporacion = '$cod';")->fetch();

				if(!$con1){
					$con = $this->Prepare("DELETE FROM comprobantes WHERE com_cod = :codigo ;");
					$con -> bindParam(":codigo",$cod);
					$con -> execute();

					if($con->rowCount() > 0){
						return $this->MakeResponse(200,'Operacion exitosa!');
					}else{
						return $this->MakeResponse(400, "Operacion Fallida!");
					}
				}else{
					return $this->MakeResponse(400, "Operacion Fallida!","Este comprobante no puede ser eliminado");
				}
			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsTransaccion->Destroy(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
	}
