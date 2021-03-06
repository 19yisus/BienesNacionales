<?php
  class clsPersonas extends Model{
		private $cod,$nom,$ape,$tel,$cargo,$email,$fecha,$dir,$dep;

		/**
		 * Construct
		 * Inicializa las variables privadas del modelo en null
		 */
		public function __construct(){
			parent::__construct();
			$this->cod = null;
			$this->nom = null;
			$this->ape = null;
			$this->tel = null;
			$this->cargo = null;
			$this->email = null;
			$this->fecha = null;
			$this->dir = null;
			$this->dep = null;
		}

		/**
		 * Funcion setDatos para Definir las variables privadas del modelo
		 */
		public function setDatos($Cod,$Nom,$Ape,$Tel,$Cargo,$Email,$Fecha,$Dir,$Dep){
			$this->cod = $this->Limpiar($Cod);
			$this->nom = $this->Limpiar($Nom);
			$this->ape = $this->Limpiar($Ape);
			$this->tel = $this->Limpiar($Tel);
			$this->tel = str_ireplace("-","",$this->tel);
			$this->cargo = $this->Limpiar($Cargo);
			$this->email = $this->Limpiar($Email);
			$this->fecha = $this->Limpiar($Fecha);
			$this->dir = $this->Limpiar($Dir);
			$this->dep = $this->Limpiar($Dep);
			$this->tel = str_ireplace(" ","",$this->tel);
		}

		/**
		 * Funcion Insert Para Guardar los datos en la base de datos
		 * @return array
		 */
		public function Insert(){

			try{

				/**
				 * Primero se comprueba si existe una persona con los mismos datos ingresado
				 * para evitar la duplicidad de informacion
				 * @return array si hay datos
				 * @return boolean si no hay datos
				 */
				$confirm = $this->Query("SELECT * FROM personas WHERE per_cedula = '$this->cod';")->fetch();

				if(!$confirm){

					/**
					 * Luego se comprueba si ya hay una persona activa con el cargo de encargado en la dependencia ingresada
					 * para evitar que alla 2 personas registradas en una dependenciaf
					 * @return array si hay datos
					 * @return boolean si no hay datos
					 */
					$confirm2 = $this->Query("SELECT * FROM personas WHERE per_estado = '1'
						AND per_dep_cod = '$this->dep' AND per_car_cod = '$this->cargo' AND per_car_cod = '1'
						AND per_cedula != '$this->cod';")->fetch();

					if(!$confirm2){

						$con = $this->Prepare("INSERT INTO personas(
							per_cedula,
							per_nombre,
							per_apellido,
							per_estado,
							per_car_cod,
							per_dep_cod,
							per_telefono,
							per_correo,
							per_direccion,
							per_desde,
							per_hasta
							) VALUES(:cod,:nom,:ape,'1',:cargo,:dep,:tel,:email,:dir,:fecha,Null);");

						$con -> bindParam(":cod",$this->cod);
						$con -> bindParam(":nom",$this->nom);
						$con -> bindParam(":ape",$this->ape);
						$con -> bindParam(":cargo",$this->cargo);
						$con -> bindParam(":dep",$this->dep);
						$con -> bindParam(":tel",$this->tel);
						$con -> bindParam(":email",$this->email);
						$con -> bindParam(":dir",$this->dir);
						$con -> bindParam(":fecha",$this->fecha);

						$res = $con->execute();

						if ($res){
							return $this->MakeResponse(200, "Operacion Exitosa!");
						}else{
							return $this->MakeResponse(400, "Operacion Fallida!");
						}
					}else{
						return $this->MakeResponse(400, "Operacion Fallida!","Ya hay un encargado registrado en esta dependencia");
					}
				}else{
					return $this->MakeResponse(400, "Operacion Fallida!", "Ya hay una persona registrada con esta cedula: V-$this->cod");
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsPersonas->Insert(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		/**
		 * Function Update Para Actualizar los datos de una dependencia
		 * @return array
		 */
		public function Update(){

			try{
				/**
				 * Primero se comprueba que NO se duplique la informacion de otra persona
				 * al momento de actualizar la informacion
				 * @return array si hay datos
				 * @return boolean si no hay datos
				 */
				$confirm = $this->Query("SELECT * FROM personas
					WHERE per_correo = '$this->email' AND per_telefono = $this->tel AND per_cedula != '$this->cod';")->fetch();

				if(!$confirm){

					/**
					 * Se comprueba que no alla 1 persona activa en la dependencia seleccionada
					 * @return array si hay datos
					 * @return boolean si no hay datos
					 */
					$confirm2 = $this->Query("SELECT * FROM personas WHERE per_dep_cod = '$this->dep'
						AND per_car_cod = '$this->cargo' AND per_car_cod = '1'
						AND per_estado = '1' AND per_cedula != '$this->cod';")->fetch();

					if(!$confirm2){

						$con = $this->Prepare("UPDATE personas SET
						per_nombre = :nom,
						per_apellido = :ape,
						per_car_cod = :cargo,
						per_dep_cod = :dep,
						per_telefono = :tel,
						per_correo = :email,
						per_direccion = :dir,
						per_desde = :fecha
						WHERE per_cedula = :cod;");

						$con -> bindParam(":cod",$this->cod);
						$con -> bindParam(":nom",$this->nom);
						$con -> bindParam(":ape",$this->ape);
						$con -> bindParam(":cargo",$this->cargo);
						$con -> bindParam(":dep",$this->dep);
						$con -> bindParam(":tel",$this->tel);
						$con -> bindParam(":email",$this->email);
						$con -> bindParam(":dir",$this->dir);
						$con -> bindParam(":fecha",$this->fecha);

						$con -> execute();

						if ($con->rowCount() > 0){
							return $this->MakeResponse(200, "Operacion Exitosa!");
						}else{
							return $this->MakeResponse(400, "Operacion Fallida!");
						}
					}else{
						return $this->MakeResponse(400, "Operacion Fallida!","Ya hay otro encargado activo en esta dependencia");
					}
				}else{
					return $this->MakeResponse(400, "Operacion Fallida!","Estas duplicando datos de otra persona");
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsPersonas->Update(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		private function changeStatus($cod,$status){
			if($status == 0){
				$con = $this->Prepare("UPDATE personas SET per_estado = $status, 
				per_hasta = NOW(), per_fecha_desactivacion = NOW(), per_fecha_reactivacion = null WHERE per_cedula = :cod;");
				$con -> bindParam(":cod",   $cod);
			}else{
				$con = $this->Prepare("UPDATE personas SET per_estado = $status, 
				per_hasta = null, per_fecha_desactivacion = null, per_fecha_reactivacion = NOW() WHERE per_cedula = :cod;");
				$con -> bindParam(":cod",   $cod);
			}

			$con -> execute();

			if($con->rowCount() > 0){
				return $this->MakeResponse(200, "Operacion Exitosa!");
			}else{
				return $this->MakeResponse(200, "Operacion Fallida!");
			}
		}
		/**
		 * Funcion Delete Para "eliminar" (cambiar el estado de activo a innactivo) en los registros
		 * @return array
		 */
		public function Delete($cod){

			try{
				/**
				 * Primero se consulta la existencia de la persona
				 * y se consulta su estado
				 * @return array si hay datos
				 * @return boolean si no hay datos
				 */
				$con1 = $this->Query("SELECT per_estado,per_dep_cod,per_car_cod FROM personas WHERE per_cedula = '$cod' ;")->fetch();

				if($con1){
					$depen = $con1['per_dep_cod'];
					$cargo = $con1['per_car_cod'];

					if($con1['per_estado'] == 1){
						return $this->changeStatus($cod,0);

					}else{

						if($cargo == 2){
							return $this->changeStatus($cod,1);
						}else{
							$con = $this->Query("SELECT * FROM personas WHERE per_dep_cod = '$depen' AND per_car_cod = '1'
								AND per_cedula != '$cod' AND per_estado = 1;")->fetch();

							if(!$con){
								return $this->changeStatus($cod,1);
							}else{
								return $this->MakeResponse(400, "Operacion Fallida!","Ya hay un encargado activo en la dependencia");
							}
						}
					}
				}else{
					return $this->MakeResponse(400, "Operacion Fallida!","La cedula ingresada es incorrecta!");
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsPersonas->Delete(), ERROR = ".$e->getMessage());
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
				$con1 = $this->Query("SELECT * FROM personas WHERE per_cedula != '$cod' AND per_car_cod = '1' AND per_estado = '1';")->fetch();

				if($con1){
					$con = $this->Prepare("DELETE FROM personas WHERE per_cedula = :codigo ;");
					$con -> bindParam(":codigo",$cod);
					$con -> execute();

					if($con->rowCount() > 0){
						return $this->MakeResponse(200,'Operacion exitosa!');
					}else{
						return $this->MakeResponse(400, "Operacion Fallida!");
					}
				}else{
					return $this->MakeResponse(400, "Operacion Fallida!","Debe de haber algun encargado activo en esta Dependencia");
				}
			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsPersonas->Destroy(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		/**
		 * Funcion Consulta para consultar toda la informacion de una persona
		 * @return array
		 */
		public function Consulta($id){

			try{
				$con = $this->Prepare("SELECT * FROM personas WHERE per_cedula = :codigo");
				$con -> bindParam(":codigo",$id);
				$con -> execute();
				$res = $con->fetch(PDO::FETCH_ASSOC);

				if(gettype($res) == 'array'){

					$Per = array(
						'Cod' => $res['per_cedula'],
						'Name' => $res['per_nombre'],
						'LastName' => $res['per_apellido'],
						'Dir' => $res['per_direccion'],
						'Email' => $res['per_correo'],
						'Tel' => $res['per_telefono'],
						'Fecha' => $res['per_desde'],
						'CodCargo' => $res['per_car_cod'],
						'CodDep' => $res['per_dep_cod']
					);

					return $this->MakeResponse(200, "Operacion Exitosa!", $Per);
				}else{
					return $this->MakeResponse(400, "Operacion Fallida!","La cedula es invalida");
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsPersonas->Consulta(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		/**
		 * Funcion Select_Cargos
		 * lista los Cargos registrados
		 * @return string html
		 */
		Public function Select_Cargos(){

			try{
				$con = $this->Query("SELECT * FROM cargos;");
				$select = "<option value=''>Seleccione un valor</option>";

				while($res = $con->fetch(PDO::FETCH_ASSOC)){
					$select .= "<option value='".$res['car_cod']."'>".$res['car_des']."</option>";
        }

			return $select;
			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsPersonas->Select_Cargos(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		/**
		 * Funcion Select_Dependencias
		 * lista las Dependencias registradas y activas
		 * @return string html
		 */
		Public function Select_Dependencias($condition = ''){
			// 1 -> Dependencias con encargados asignados
			// 2 -> Dependencias con encargados asignados y bienes desincorporados
			// 3 -> Dependencias con encargados asignados y bienes incorporados
			// else -> Todas las dependencias activas
			try{
				$select = "dependencia.dep_cod,dependencia.dep_des,nucleo.nuc_des,nucleo.nuc_tipo_nucleo";

				if($condition != '' && $condition == 1){
					// Todas las dependencias que tengan un encarmado activo
					$con = $this->Query("SELECT DISTINCT  $select FROM dependencia
					INNER JOIN nucleo ON nucleo.nuc_cod = dependencia.dep_nucleo_cod
					INNER JOIN personas ON personas.per_dep_cod = dependencia.dep_cod
					WHERE dependencia.dep_estado = '1';");
				}elseif($condition != '' && $condition == 2){
					// Dependencias que tengan bienes Desincorporados
					$con = $this->Query("SELECT DISTINCT  $select FROM dependencia
					INNER JOIN nucleo ON nucleo.nuc_cod = dependencia.dep_nucleo_cod
					INNER JOIN personas ON personas.per_dep_cod = dependencia.dep_cod
					INNER JOIN comprobantes ON dependencia.dep_cod = comprobantes.com_dep_user
					WHERE comprobantes.com_tipo = 'D' AND dependencia.dep_estado = '1' AND 
					comprobantes.com_cod IN(SELECT movimientos.mov_com_desincorporacion FROM movimientos);");					
      	}elseif($condition != '' && $condition == 3){
					//Dependencias que tengan bienes incorporados
					$con = $this->Query("SELECT DISTINCT  $select FROM dependencia
					INNER JOIN nucleo ON nucleo.nuc_cod = dependencia.dep_nucleo_cod
					INNER JOIN personas ON personas.per_dep_cod = dependencia.dep_cod
					INNER JOIN comprobantes ON dependencia.dep_cod = comprobantes.com_dep_user
					INNER JOIN movimientos ON movimientos.mov_com_cod = comprobantes.com_cod
					WHERE comprobantes.com_cod IN(SELECT movimientos.mov_com_cod FROM movimientos);");					
      	}elseif($condition != '' && $condition == 4){
					//Dependencias que tengan bienes y componentes incorporados
					$con = $this->Query("SELECT DISTINCT  $select FROM
								dependencia
						INNER JOIN nucleo ON nucleo.nuc_cod = dependencia.dep_nucleo_cod
						INNER JOIN comprobantes ON comprobantes.com_dep_user = dependencia.dep_cod
						INNER JOIN movimientos ON movimientos.mov_com_cod = comprobantes.com_cod
						INNER JOIN bien ON bien.bien_cod = movimientos.mov_bien_cod
						WHERE
							bien.ifcomponente = 1 AND bien.bien_link_bien IS NULL;");					
      	}else{
					// Todas las dependencias activas
      		$con = $this->Query("SELECT $select FROM dependencia
					INNER JOIN nucleo ON nucleo.nuc_cod = dependencia.dep_nucleo_cod
					WHERE dependencia.dep_estado = '1';");
      	}

				$select = "<option value=''>Seleccione un valor</option>";

				while($res = $con->fetch(PDO::FETCH_ASSOC)){
					$select .= "<option value='".$res['dep_cod']."'>".$res['dep_des']." - ".$res['nuc_des']." - ".$res['nuc_tipo_nucleo']."</option>";
        		}

			return $select;
			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsPersonas->Select_Dependencias(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		/**
		 * Funcion checkCedula para comprobar que la cedula ingresada no exista
		 * @return array
		 */
		public function checkCedula($cedula){

			try{
				$con = $this->Query("SELECT per_cedula FROM personas WHERE per_cedula = '$cedula';")->fetch(PDO::FETCH_ASSOC);

				if($con == false){
					return 'true';
				}

				return 'false';
			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsNucleo->checkCedula(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		/**
		 * Funcion checkEmail para comprobar que la cedula ingresada no exista
		 * @return array
		 */
		public function checkEmail($correo){

			try{
				$con = $this->Query("SELECT per_correo FROM personas WHERE per_correo = '$correo';")->fetch(PDO::FETCH_ASSOC);

				if($con == false){
					return 'true';
				}

				return 'false';
			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsNucleo->checkCedula(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		/**
		 * Funcion All para retornar todo el contenido de una base de datos
		 * @return array
		 */
		public function All(){

			try{
				$data = $this->Query("SELECT personas.per_cedula,CONCAT(personas.per_nombre,' ',personas.per_apellido) AS nombre,
				cargos.car_des,dependencia.dep_des,personas.per_estado,nucleo.nuc_des
				FROM personas
				LEFT JOIN cargos ON cargos.car_cod = personas.per_car_cod
				LEFT JOIN dependencia ON dependencia.dep_cod = personas.per_dep_cod
				LEFT JOIN nucleo ON nucleo.nuc_cod = dependencia.dep_nucleo_cod ;")->fetchAll(PDO::FETCH_ASSOC);

				return ['data' => $data];

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsNucleo->All(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

    	/**
		 * Function Listar para retornar un registro mas detallado de una persona de forma mas grafica
		 * @return string html
		 */
		public function Listar($cod){

			$SelectPer = "
			personas.per_cedula,
			personas.per_nombre,
			personas.per_apellido,
			personas.per_estado,
			personas.per_telefono,
			personas.per_correo,
			personas.per_direccion,
			personas.per_desde,
			personas.per_hasta,personas.per_fecha_desactivacion,personas.per_fecha_reactivacion,
			cargos.car_des,
			dependencia.dep_des";

			$InnerJoinPer = "INNER JOIN cargos ON cargos.car_cod = personas.per_car_cod INNER JOIN dependencia ON dependencia.dep_cod = personas.per_dep_cod";
			try{
				$con1 = $this->Query("SELECT $SelectPer FROM personas $InnerJoinPer	WHERE personas.per_cedula = '$cod' ;")->fetch(PDO::FETCH_ASSOC);

        $estado = ($con1['per_estado'] == 1) ? 'Activo' : 'Innactivo';
        $hasta = isset($con1['per_hasta']) ? $con1['per_hasta'] : 'Actualmente';

				require_once "Templates/ListarPersonas.php";

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsPersonas->Listar(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
  }
