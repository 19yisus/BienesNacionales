<?php
	/**
	 * Las clases ClsMarcas y CLsEpecies son clases duplicadas porque la nomenclatura de los controladores lo requeria asi
	 * ambas clases son casi identicas y consultan a la misma tabla marcas en la base de datos, sin embargo
	 * estos modelos estan orientados a Marcas(objetos) y Especies(animales) respectivamente
	 */
	class clsMarcas extends Model{
		private $cod,$marca,$cate;

		/**
		 * Construct
		 * Inicializa las variables privadas del modelo en null
		 */
		public function __construct(){
			parent::__construct();
			$this->cod = null;
			$this->marca = null;
			$this->cate = null;
		}

		/**
		 * Funcion setDatos para Definir las variables privadas del modelo
		 */
		public function setDatos($cod,$marca,$cate){
			$this->cod = (isset($cod)) ? $cod : NULL;
			$this->marca = $this->Limpiar($marca);
			$this->cate = $this->Limpiar($cate);
		}

		/**
		 * Funcion Insert Para Guardar los datos en la base de datos
		 * @return array
		 */
		public function Insert(){

			try{

				/**
				 * Primero se comprueba si existe una marca con el mismo nombre ingresado
				 * para evitar la duplicidad de nombres
				 * @return array si hay datos
				 * @return boolean si no hay datos
				 */
				$confirm = $this->Query("SELECT * FROM marcas WHERE mar_des = '$this->marca' ;")->fetch();

				if(!$confirm){

					$con = $this->Prepare("INSERT INTO marcas(mar_des,mar_categoria_cod,mar_estado) VALUES(:marca,:cate,'1');");

					$con -> bindParam(":marca", $this->marca);
					$con -> bindParam(":cate", $this->cate);

					$res = $con->execute();
					if ($res){
						return $this->MakeResponse(200, "Operacion Exitosa!");
					}else{
						return $this->MakeResponse(400, "Operacion Fallida!");
					}
				}else{
					return $this->MakeResponse(400, "Operacion Fallida!","La marca ya existe");
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsMarcas->Insert(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		/**
		 * Function Update Para Actualizar los datos de una marca
		 * @return array
		 */
		public function Update(){

			try{

				/**
				 * Primero se comprueba que NO se duplique la informacion de otra marca
				 * al momento de actualizar la informacion
				 * @return array si hay datos
				 * @return boolean si no hay datos
				 */
				$confirm = $this->Query("SELECT * FROM marcas WHERE mar_des = '$this->marca' AND mar_categoria_cod = '$this->cate' ;")->fetch();

				if(!$confirm){
					$con = $this->Prepare("UPDATE marcas SET mar_des = :des, mar_categoria_cod = :cate WHERE mar_cod = :cod;");

					$con -> bindParam(":cod", $this->cod);
					$con -> bindParam(":des", $this->marca);
					$con -> bindParam(":cate", $this->cate);

					$con -> execute();
					if ($con->rowCount() > 0){
						return $this->MakeResponse(200, "Operacion Exitosa!");
					}else{
						return $this->MakeResponse(400, "Operacion Fallida!, la marca no esta registrada");
					}
				}else{
					return $this->MakeResponse(400, "Operacion Fallida!","Estas duplicando la informacion de otra Marca");
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsMarcas->Update(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		/**
		 * Funcion Delete Para "eliminar" (cambiar el estado de activo a innactivo) en los registros
		 * @return array
		 */
		public function Delete($cod,$fecha){

			try{

				/**
				 * Primero se comprueba que alla modelos acivos usando esta marca
				 * @return array si hay datos
				 * @return boolean si no hay datos
				 */
				$confirm = $this->Query("SELECT * FROM modelos WHERE mod_estado = '1' AND mod_marca_cod = '$cod' ;")->fetch();

				if(!$confirm){
					//Se consulta el estado actual de esta marca para desactivar o reactivar la misma
					$con1 = $this->Query("SELECT mar_estado FROM marcas WHERE mar_cod = '$cod';")->fetch();

					if($con1['mar_estado'] == 1){
						$con = $this->Prepare("UPDATE marcas SET mar_estado = '0', mar_fecha_desactivacion = '$fecha' WHERE mar_cod = :cod;");
					}else{
						$con = $this->Prepare("UPDATE marcas SET mar_estado = '1', mar_fecha_desactivacion = null WHERE mar_cod = :cod;");
					}

					$con -> bindParam(":cod",$cod);
					$con->execute();
					if ($con->rowCount() > 0){
						return $this->MakeResponse(200, "Operacion Exitosa!");
					}else{
						return $this->MakeResponse(400, "Operacion Fallida!");
					}
				}else{
					return $this->MakeResponse(400, "Operacion Fallida!","La marca esta siendo utilizada");
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsMarcas->Delete(), ERROR = ".$e->getMessage());
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
				$con1 = $this->Query("SELECT * FROM modelos WHERE mod_marca_cod = '$cod' ;")->fetch();

				if(!$con1){
					$con = $this->Prepare("DELETE FROM marcas WHERE mar_cod = :codigo ;");
					$con -> bindParam(":codigo",$cod);
					$con -> execute();

					if($con->rowCount() > 0){
						return $this->MakeResponse(200,'Operacion exitosa!');
					}else{
						return $this->MakeResponse(400, "Operacion Fallida!");
					}
				}else{
					return $this->MakeResponse(400, "Operacion Fallida!","Debe de eliminar los Modelos de esta Marca primero");
				}
			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsMarcas->Destroy(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		/**
		 * Funcion Consulta para consultar toda la informacion de una dependencia
		 * @return array
		 */
		public function Consulta($id){

			try{
				$con = $this->Prepare("SELECT * FROM marcas WHERE mar_cod = :cod;");
				$con -> bindParam(":cod",$id);
				$con -> execute();
				$res = $con->fetch(PDO::FETCH_ASSOC);

				if(gettype($res) == 'array'){

					$Marca = array(
						'Cod' => $res['mar_cod'],
						'Des' => $res['mar_des'],
						'Cate' => $res['mar_categoria_cod']
					);

					return $this->MakeResponse(200, "Operacion Exitosa", $Marca);
				}else{
					return $this->MakeResponse(400, "Operacion Fallida!","El codigo de la marca es invalido");
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsMarcas->Consulta(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		/**
		 * Funcion Select_Nucleos
		 * lista los nucleos activos
		 * @return string html
		 */
		Public function SelectCategoria(){
			$lista = '';

			try{
				$con = $this->Query("SELECT * FROM categoria WHERE cat_cod != 'BS' AND cat_cod != 'IN' ;");

				if($con){
					$lista = "<option value=''>Seleccione un valor</option>";

					while($res = $con->fetch(PDO::FETCH_ASSOC)){
						$lista .= "<option value='".$res['cat_cod']."'>".$res['cat_des']."</option>";
					}

					return $lista;
				}else{
					$lista = "<option value=''>No hay registros</option>";
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsMarcas->SelectCategoria(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		public function All(){

			try{
				$data = $this->Query("SELECT marcas.mar_cod,marcas.mar_des,marcas.mar_estado,categoria.cat_des
				FROM marcas INNER JOIN categoria ON categoria.cat_cod = marcas.mar_categoria_cod
				WHERE marcas.mar_categoria_cod != 'BS';")->fetchAll(PDO::FETCH_ASSOC);

				return ['data' => $data];

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsNucleo->All(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		/**
		 * Function Listar para retornar un registro mas detallado de una marca de forma mas grafica
		 * @return string html
		 */
		public function Listar($cod){

			try{
				$SelectMarcas = "marcas.mar_cod, marcas.mar_des, categoria.cat_des, marcas.".'mar_estado';

				$InnerJoinBien = "
				INNER JOIN modelos ON modelos.mod_cod = bien.bien_mod_cod
				INNER JOIN marcas ON marcas.mar_cod = modelos.mod_marca_cod ";

				$con = $this->Query("SELECT $SelectMarcas FROM marcas INNER JOIN categoria ON categoria.cat_cod = marcas.mar_categoria_cod
					WHERE mar_cod = '$cod' ;")->fetch(PDO::FETCH_ASSOC);

				$con2 = $this->Query("SELECT COUNT(bien_cod) AS total FROM bien $InnerJoinBien
				WHERE marcas.mar_cod = '$cod';")->fetch(PDO::FETCH_ASSOC);

				if(sizeof($con) > 0){

          $estado = ($con['mar_estado'] == 1) ? 'Activo' : 'Innactivo';
					$card = '
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Marcas</h3>
									</div>
									<div class="card-body table-responsive p-0">
										<table class="table table-sm">
											<thead>
												<tr>
													<th>ID</th>
													<th>Nombre de la marca</th>
													<th>Nº bienes de esta Marca</th>
													<th>Categoria</th>
													<th>Estado</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>'.$con['mar_cod'].'</td>
													<td>'.$con['mar_des'].'</td>
													<td>'.$con2["total"].'</td>
													<td>'.$con['cat_des'].'</td>
													<td class="text-'.(($estado == "Activo") ? "success" : "danger").'" >'.$estado.'</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>';

				}else{

					$card .= '
					<div class="card">
						<div class="card-body p-2">
							<h4 class="text-center text-danger">Sin Marcas Registradas</h4>
						</div>
					</div>';
				}
				return $card;

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsMarcas->Listar(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}

		/**
		 * Function Id para imprimir el proximo codigo auto-incrementado de la tabla ingresada como string
		 * @return number [codigo]
		 */
		public function Id(){
			return $this->showCodIncrements('mar_cod','marcas');
		}
	}
