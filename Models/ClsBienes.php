<?php
	class clsBienes extends Model{
		private $cod_bien,$descrip,$tbien,$clasificacion,$valor,$fecha,$cantidad,$depreciacion;
		private $placa,$anio,$modelo,$peso,$sexo,$color,$terreno,$catalogo,$serail;
		/**
		 * Construct
		 * Inicializa las variables privadas del modelo en null
		 */
		public function __construct(){
			parent::__construct();
			$this->cod_bien = null;
			$this->descrip = null;
			$this->clasificacion = null;
			$this->valor = null;
			$this->fecha = null;
			$this->cantidad = null;
			$this->catalogo = null;
			$this->serial = null;
			$this->depreciacion = null;
			$this->placa = null;
			$this->anio = null;
			$this->modelo = null;
			$this->peso = null;
			$this->sexo = null;
			$this->color = null;
			$this->terreno = null;
			$this->modelo = null;
			$this->ifComponente = null;
		}
		/**
		 * Funcion setDatos para Definir las variables privadas del modelo
		 */
		public function SetDatos($datos){

			$this->cod_bien = isset($datos['Codbien']) ? $this->Limpiar($datos['Codbien']) : null;
			$this->descrip = isset($datos['Desbien']) ? $this->Limpiar($datos['Desbien']) : null;
			$this->clasificacion = isset($datos['Clbien']) ? $this->Limpiar($datos['Clbien']) : null;
			$this->valor = isset($datos['Valbien']) ? $this->Limpiar($datos['Valbien']) : null;
			$this->fecha = isset($datos['Fecbien']) ? $this->Limpiar($datos['Fecbien']) : null;
			$this->cantidad = isset($datos['Cantbien']) ? $this->Limpiar($datos['Cantbien']) : null;
			$this->catalogo = isset($datos['Catalogo']) ? $this->Limpiar($datos['Catalogo']) : null;
			$this->serial = isset($datos['Serial']) ? $this->Limpiar($datos['Serial']) : null;
			$this->depreciacion = isset($datos['Depre']) ? $this->Limpiar($datos['Depre']) : null;
			$this->placa = isset($datos['Placa']) ? $this->Limpiar($datos['Placa']) : null;
			$this->anio = isset($datos['Anio']) ? $this->Limpiar($datos['Anio']) : null;
			// $this->modelo = isset($datos['Raza']) ? $this->Limpiar($datos['Raza']) : isset($datos['Modelo']) ? $this->Limpiar($datos['Modelo']) : null;
			$this->peso = isset($datos['Peso']) ? $this->Limpiar($datos['Peso']) : null;
			$this->sexo = isset($datos['sexo']) ? $this->Limpiar($datos['sexo']) : null;
			$this->color = isset($datos['Color']) ? $this->Limpiar($datos['Color']) : null;
			$this->terreno = isset($datos['Terreno']) ? $this->Limpiar($datos['Terreno']) : null;
			$this->ifComponente = isset($datos['componente']) ? 1 : 0;

			if(isset($datos['Raza'])){
				$this->modelo = $this->Limpiar($datos['Raza']);
			}elseif(isset($datos['Modelo'])){
				$this->modelo = $this->Limpiar($datos['Modelo']);
			}else{
				$this->modelo = null;
			}
			$this->modelo = ($this->terreno !=  null ? null : $this->modelo);
		}
		/**
		 * Funcion Insert Para Guardar los datos en la base de datos
		 * @return array
		 */
		public function Insert(){

			try{
				$i = 0;
				while($i < $this->cantidad){

					$con = $this->Prepare("INSERT INTO bien(
						bien_cod,
						bien_des,
						bien_catalogo,
						bien_fecha_ingreso,
						bien_precio,
						bien_depreciacion,
						bien_estado,
						bien_color_cod,
						bien_serial,
						bien_clasificacion_cod,
						bien_link_bien,
						bien_mod_cod,
						bien_sexo,
						bien_peso,
						bien_anio,
						bien_placa,
						bien_terreno,
						ifcomponente)
						VALUES(:codigo,:den,:catalogo,:fecha,:precio,:depre,'1',:color,:c_serial,:clasificacion,
						null,:modelo,:sexo,:peso,:anio,:placa,:terreno,:ifcomponente);");

					$codigo = $this->AsingnacionCodigo($this->clasificacion);

					$con -> bindParam(":codigo",$codigo);
					$con -> bindParam(":den",$this->descrip);
					$con -> bindParam(":catalogo",$this->catalogo);
					$con -> bindParam(":fecha",$this->fecha);
					$con -> bindParam(":precio",$this->valor);
					$con -> bindParam(":depre",$this->depreciacion);
					$con -> bindParam(":color",$this->color);
					$con -> bindParam(":c_serial",$this->serial);
					$con -> bindParam(":clasificacion",$this->clasificacion);
					$con -> bindParam(":modelo",$this->modelo);
					$con -> bindParam(":sexo",$this->sexo);
					$con -> bindParam(":peso",$this->peso);
					$con -> bindParam(":anio",$this->anio);
					$con -> bindParam(":placa",$this->placa);
					$con -> bindParam(":terreno",$this->terreno);
					$con -> bindParam(":ifcomponente",$this->ifComponente);

					$res = $con -> execute();

					$i += 1;

					if(!$res){
						break;
						return false;
					}
				}

				$mensajeExito = (($this->cantidad > 1) ? "Operacion Exitosa! ".$this->cantidad." Bienes han sido incluidos" : "Operacion Exitosa!");

				if ($i == $this->cantidad){
					return $this->MakeResponse(200, $mensajeExito);
				}else{
					return $this->MakeResponse(400, "Operacion Fallida");
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsBienes->Insert();, ERROR = ".$e->getMessage());
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
				 * Primero se comprueba el bien no este asignado a una dependencia
				 * al momento de actualizar la informacion
				 * @return array si hay datos
				 * @return boolean si no hay datos
				 */
				$con1 = $this->Prepare("SELECT * FROM movimientos WHERE mov_bien_cod = :codigo1");
				$con1 -> bindParam(":codigo1",$this->cod_bien);
				$con1 -> execute();
				$con1 = $con1 -> fetch();

				if(!$con1){
					$con = $this->Prepare("UPDATE bien SET
						bien_des = :des,
						bien_catalogo = :catalogo,
						bien_fecha_ingreso = :fecha,
						bien_precio = :precio,
						bien_depreciacion = :depre,
						bien_color_cod = :color,
						bien_serial = :c_serial,
						bien_mod_cod = :modelo,
						bien_sexo = :sexo,
						bien_peso = :peso,
						bien_anio = :anio,
						bien_placa = :placa,
						bien_terreno = :terreno WHERE bien_estado = '1' AND bien_cod = :codigo ;");

					$con -> bindParam(":codigo",$this->cod_bien);
					$con -> bindParam(":des",$this->descrip);
					$con -> bindParam(":catalogo",$this->catalogo);
					$con -> bindParam(":fecha",$this->fecha);
					$con -> bindParam(":precio",$this->valor);
					$con -> bindParam(":depre",$this->depreciacion);
					$con -> bindParam(":color",$this->color);
					$con -> bindParam(":c_serial",$this->serial);
					$con -> bindParam(":modelo",$this->modelo);
					$con -> bindParam(":sexo",$this->sexo);
					$con -> bindParam(":peso",$this->peso);
					$con -> bindParam(":anio",$this->anio);
					$con -> bindParam(":placa",$this->placa);
					$con -> bindParam(":terreno",$this->terreno);

					$con -> execute();

					if ($con->rowCount() > 0){
						return $this->MakeResponse(200, "Operacion Exitosa!");
					}else{
						return $this->MakeResponse(400, "Operacion Fallida!");
					}
				}else{
					return $this->MakeResponse(400, "Operacion Fallida!","El bien ya esta en uso!");
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsBienes->Update(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		/**
		 * Funcion Delete Para "eliminar" (cambiar el estado de activo a innactivo) en los registros
		 * @return array
		 */
		public function Delete($cod, $fecha){
			try{
				/**
				 * Primero se comprueba si el bien esta en uso
				 * @return array si hay datos
				 * @return boolean si no hay datos
				 */
				$con1 = $this->Query("SELECT mov_com_desincorporacion FROM movimientos WHERE mov_bien_cod = '$cod' ;")->fetch();
				//OBSERVACION : MODIFICAR ESTO LUEGO
				
				if(!$con1[0]){

					$con2 = $this->Query("SELECT mov_com_cod FROM movimientos WHERE mov_bien_cod = '$cod';")->fetch();
					
					if(!$con2[0]){

						$con = $this->Query("SELECT bien_estado FROM bien WHERE bien_cod = '$cod' ;")->fetch();

						if($con['bien_estado'] == 1){
							$con2 = $this->Prepare("UPDATE bien SET bien_estado = '0', bien_fecha_desactivacion = '$fecha' WHERE bien_cod = :cod;");
						}else{
							$con2 = $this->Prepare("UPDATE bien SET bien_estado = '1', bien_fecha_desactivacion = null WHERE bien_cod = :cod;");
						}

						$con2 -> bindParam(":cod",   $cod);
						$con2->execute();

						if ($con2->rowCount() > 0){
							return $this->MakeResponse(200, "Operacion Exitosa!");
						}else{
							return $this->MakeResponse(400, "Operacion Fallida!");
						}
					}else{
						return $this->MakeResponse(400, "Operacion Fallida!","El bien esta Incorporado!");
					}
				}else{
					return $this->MakeResponse(400, "Operacion Fallida!","El bien ya esta Desincorporado!");
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsBienes->Delete(), ERROR = ".$e->getMessage());
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
				$con1 = $this->Query("SELECT * FROM movimientos WHERE mov_bien_cod = '$cod' ;")->fetch();

				if(!$con1){
					$con = $this->Prepare("DELETE FROM bien WHERE bien_cod = :codigo ;");
					$con -> bindParam(":codigo",$cod);
					$con -> execute();

					if($con->rowCount() > 0){
						return $this->MakeResponse(200,'Operacion exitosa!');
					}else{
						return $this->MakeResponse(400, "Operacion Fallida!");
					}
				}else{
					return $this->MakeResponse(400, "Operacion Fallida!","Elimine los Comprobantes con este bien primero");
				}
			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsBienes->Destroy(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		/**
		 * Funcion Consulta para consultar toda la informacion de una dependencia
		 * @return array
		 */
		public function Consulta($id){

			try{

				$con = $this->Prepare("SELECT
					bien.bien_serial,
					bien.bien_cod,
					bien.bien_catalogo,
					bien.bien_clasificacion_cod,
					modelos.mod_marca_cod,
					bien.bien_mod_cod,
					bien.bien_color_cod,
					bien.bien_depreciacion,
					bien.bien_des,
					bien.bien_fecha_ingreso,
					categoria.cat_cod,
					bien.bien_link_bien,
					bien.bien_peso,
					bien.bien_placa,
					bien.bien_precio,
					bien.bien_sexo,
					bien.bien_terreno,
					bien.bien_anio
						FROM bien
					INNER JOIN clasificacion ON clasificacion.cla_cod = bien.bien_clasificacion_cod
					INNER JOIN categoria ON categoria.cat_cod = clasificacion.cla_cat_cod
					INNER JOIN modelos ON modelos.mod_cod = bien.bien_mod_cod
					WHERE bien.bien_cod = :codigo ;");
				$con -> bindParam(":codigo", $id);
				$con -> execute();
				$res = $con -> fetch(PDO::FETCH_ASSOC);

				if(gettype($res) == 'array'){

					$Bien = array(
						'Cod' => $res['bien_cod'],
						'Des' => $res['bien_des'],
						'Pre' => $res['bien_precio'],
						'Fecha' => $res['bien_fecha_ingreso'],
						'Anio' => $res['bien_anio'],
						'Terr' => $res['bien_terreno'],
						'Sexo' => $res['bien_sexo'],
						'Placa' => $res['bien_placa'],
						'Peso' => $res['bien_peso'],
						'Link' => $res['bien_link_bien'],
						'Depre' => $res['bien_depreciacion'],
						'Color' => $res['bien_color_cod'],
						'Mod' => $res['bien_mod_cod'],
						'CCla' => $res['bien_clasificacion_cod'],
						'Serial' => $res['bien_serial'],
						'Cate' => $res['cat_cod'],
						'Mar' => $res['mod_marca_cod'],
						'Cata' => $res['bien_catalogo']
					);
					return $this->MakeResponse(200, "Operacion Exitosa!", $Bien);
				}else{
					return $this->MakeResponse(400, "El codigo del bien es invalido");
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsBienes->Consulta(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		public function AsingnacionCodigo($valor){
			$start = $valor;
			$count = 1;
			$digits = 7;

			for ($n = $start; $n < $start + $count; $n++) {
				$result = str_pad($n, $digits, "0", STR_PAD_RIGHT);
			}

			$valor = $this->Busqueda_Codigo($start);

			if($result <= $valor){
				$result = $valor + 1;
			}

			$longitud = strlen($result);

			if ($longitud < 7){
				$codigo = "0".$result;
				return $codigo;
			}else{
				return  $result;
			}
		}
		/**
		 * Funcion SelectCategoria
		 * lista los nucleos activos
		 * @return string html
		 */
		Public function SelectCategoria(){
			try{
				$con = $this->Query("SELECT * FROM categoria;");

				if($con){
					$lista = "<option value=''>Seleccione un valor</option>";

					while($res = $con->fetch(PDO::FETCH_ASSOC)){
						$cod = $res['cat_cod'];
						$des = $res['cat_des'];
						$lista .= "<option value='$cod'>$des</option>";
					}

					return $lista;
				}else{
					$lista = "<option value=''>No hay registros</option>";
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsBienes->SelectCategoria(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		/**
		 * Funcion SelectClasificacion
		 * lista Las clasificaciones segun codigo y estado
		 * @return string html
		 */
		public function SelectClasificacion(){
			try{
				$con = $this->Query("SELECT clasificacion.cla_cod,clasificacion.cla_des,categoria.cat_cod,categoria.cat_des
					FROM clasificacion INNER JOIN categoria ON categoria.cat_cod = clasificacion.cla_cat_cod;");

				if($con){
					$lista = "<option value=''>Seleccione un valor</option>";

					while($res = $con->fetch(PDO::FETCH_ASSOC)){
						$categoria_cod = $res['cat_cod'];
						$categoria_des = $res['cat_des'];
						$clasificacion_cod = $res['cla_cod'];
						$clasificacion_des = $res['cla_des'];

						$lista .= "<option data-categoria='$categoria_cod'
						value='$clasificacion_cod' >$clasificacion_cod - $clasificacion_des - $categoria_des</option>";
					}

					return $lista;
				}else{
					$lista = "<option value=''>No hay registros</option>";
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsBienes->SelectClasificacion(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		/**
		 * Funcion SelectColores
		 * lista los colores registrados
		 * @return string html
		 */
		public function SelectColores(){
			try{
				$con = $this->Query("SELECT * FROM colores;");

				if($con){
					$lista = "<option value=''>Seleccione un valor</option>";

					while($res = $con->fetch(PDO::FETCH_ASSOC)){
						$cod = $res['color_cod'];
						$des = $res['color_des'];
						$lista .= "<option value='$cod'>$des</option>";
					}

					return $lista;
				}else{
					$lista = "<option value=''>No hay registros</option>";
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsBienes->SelectColores(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		public function Busqueda_Codigo($tip){ //ESTA FUNCION CONSULTA EN LA DB, EL ULTIMO BIEN POR SU CLASIFICACION, PARA LUEGO TOMAR ESE CODIGO E INCREMENTARLO A 1
			try{
					$con = $this->Prepare("SELECT bien_cod FROM bien WHERE bien_clasificacion_cod = :cla ORDER BY bien_cod DESC");
					$con->bindParam(":cla", $tip);
					$con->execute();
					$res = $con->fetch();

					if ($res){
						return $res['bien_cod'];
					}else{
						return false;
					}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsBienes->Busqueda_Codigo(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		/**
		 * Funcion Select_Marcas
		 * lista las marcas Segun categoria
		 * @return string html
		 */
		Public function Select_Marcas($categoria){
			$tipos = [
				'EL' => 'Electronico',
				'MA' => 'Material',
				'OF' => 'Oficina',
				'TP' => 'Transporte',
				'BS' => 'Semoviente',
			];
			try{
				$con = $this->Query("SELECT * FROM marcas WHERE mar_estado = '1' AND mar_categoria_cod = '$categoria';");

				if($con){
					$lista = "<option value=''>Seleccione un valor</option>";

					while($res = $con->fetch(PDO::FETCH_ASSOC)){
						$cod = $res['mar_cod'];
						$des = $res['mar_des'];
						$categoria = $tipos[$res['mar_categoria_cod']];

						$lista .= "<option value='$cod'>$des - $categoria</option>";
					}

					return $lista;
				}else{
					$lista = "<option value=''>No hay registros</option>";
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsBienes->Select_Marcas(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		/**
		 * Funcion Select_Modelos
		 * lista los modelos Segun Marca
		 * @return string html
		 */
		Public function Select_Modelo($marca){

		    try{
				$con = $this->Query("SELECT * FROM modelos WHERE mod_estado = '1' AND mod_marca_cod = '$marca';");

				if($con){
					$lista = "<option value=''>Seleccione un valor</option>";

					while($res = $con->fetch(PDO::FETCH_ASSOC)){
						$cod = $res['mod_cod'];
						$des = $res['mod_des'];
						$lista .= "<option value='$cod'>$des</option>";
					}

					return $lista;
				}else{
					$lista = "<option value=''>No hay registros</option>";
				}

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsBienes->Select_Modelo(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		public function All(){

			try{
				$data = $this->Query("SELECT DISTINCT bien.bien_cod,bien.bien_des,bien.bien_precio,bien.bien_fecha_ingreso,categoria.cat_des,
					bien.bien_estado FROM bien
				INNER JOIN clasificacion ON bien.bien_clasificacion_cod = clasificacion.cla_cod
				INNER JOIN categoria ON clasificacion.cla_cat_cod = categoria.cat_cod WHERE
				bien_cod NOT IN(SELECT mov_bien_cod FROM movimientos);")->fetchAll(PDO::FETCH_ASSOC);

				return ['data' => $data];

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsNucleo->All(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
		/**
		 * Function Listar para retornar un registro mas detallado de una dependencia de forma mas grafica
		 * @return string html
		 */
		public function Listar($cod){
			$cod = $this->Limpiar($cod);

			try{

				$con = $this->Prepare("SELECT
					bien.bien_cod,
					bien.bien_estado,
					bien.bien_catalogo,
					bien.bien_serial,
					bien.bien_terreno,
					bien.bien_placa,
					bien.bien_anio,
					bien.bien_des,
					bien.bien_fecha_ingreso,
					bien.bien_precio,
					categoria.cat_des,
					categoria.cat_cod,
					bien.bien_sexo,
					bien.bien_mod_cod
					FROM bien
					INNER JOIN clasificacion ON clasificacion.cla_cod = bien.bien_clasificacion_cod
					INNER JOIN categoria ON categoria.cat_cod = clasificacion.cla_cat_cod
				 WHERE bien.bien_cod = :codigo;");

				$con2 = $this->Prepare("SELECT * FROM movimientos WHERE mov_bien_cod = :cod");

				$con3 = $this->Prepare("SELECT marcas.mar_des,modelos.mod_des FROM modelos
					INNER JOIN marcas ON marcas.mar_cod = modelos.mod_marca_cod WHERE modelos.mod_cod = :modelo ;");

				$con4 = $this->Prepare("SELECT COUNT(bien_cod) AS cantidad FROM bien WHERE bien_link_bien = :cod_bien");

				$con5 = $this->Prepare("SELECT * FROM bien
					INNER JOIN clasificacion ON clasificacion.cla_cod = bien.bien_clasificacion_cod
					INNER JOIN categoria ON categoria.cat_cod = clasificacion.cla_cat_cod
				 WHERE bien.bien_link_bien = :link ; ");

				$con6 = $this->Prepare("SELECT * FROM bien INNER JOIN colores ON colores.color_cod = bien.bien_color_cod WHERE bien.bien_cod = :codBien ;");

				// PRIMERA CONSULTA
				$con -> bindParam(":codigo", $cod);
				$con -> execute();
				$con = $con -> fetch(PDO::FETCH_ASSOC);
				// ./EXECUCION DE LA PRIMERA CONSULTA

				// SEGUNDA CONSULTA
				$con2 -> bindParam(":cod", $cod);
				$con2 -> execute();
				$con2 = $con2 -> fetch(PDO::FETCH_ASSOC);
				// ./EXECUCION DE LA SEGUNDA CONSULTA

				require "Templates/ListarBienes.php";
				return $card;

			}catch(PDOException $e){
				error_log("Error en la consulta::models/ClsBienes->Listar(), ERROR = ".$e->getMessage());
				return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
			}
		}
	}
