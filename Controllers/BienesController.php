<?php
	class BienesController extends Controller{
		public function __construct(){
			parent::__construct('Bienes');
		}
		/**
		 * Funcion Insert
		 * Guardar registros
		 * @return json
		 */
		public function Insert(){ 
			/**
			 * Validacion si el usuario cuenta con el permiso para esta accion
			 * @return boolean
			 */
			if($this->modelo->session->GetDatos('permisos')['crear'] == 1){/**
				* Validacion si existe post
				* @return boolean 
				*/
				if($this->Post(['Codbien'])){
					$this->modelo->setDatos($_POST);
					return $this->PJSON($this->modelo->Insert());
				}else{
					return $this->PJSON($this->modelo->MakeResponse(400, 'No hay Post'));
				}
			}else{
				return $this->PJSON($this->modelo->MakeResponse(400, 'No tienes permisos para esta accion'));
			}
		}
		/**
		 * Funcion Update
		 * Actualizar registros
		 * @return json
		 */
		public function Update(){
			/**
			 * Validacion si el usuario cuenta con el permiso para esta accion
			 * @return boolean
			 */
			if($this->modelo->session->GetDatos('permisos')['modificar'] == 1){
				/**
				 * Validacion si existe post
				 * @return boolean 
				 */
				if($this->Post(['Codbien'])){
					$this->modelo->setDatos($_POST);
					return $this->PJSON($this->modelo->Update());
				}else{
					return $this->PJSON($this->modelo->MakeResponse(400, 'No hay Post'));
				}
			}else{
				return $this->PJSON($this->modelo->MakeResponse(400, 'No tienes permisos para esta accion'));
			}
		}
		/**
		 * Funcion Delete
		 * Desactivar registro
		 * @return json
		 */
		public function Delete(){
			/**
			 * Validacion si el usuario cuenta con el permiso para esta accion
			 * @return boolean
			 */
			if($this->modelo->session->GetDatos('permisos')['modificar'] == 1){
				/**
				 * Validacion si existe post
				 * @return boolean 
				 */
				if($this->Post(['Cod'])){
					return $this->PJSON($this->modelo->Delete($this->GetPost('Cod'),$this->fecha()));
				}else{
					return $this->PJSON($this->modelo->MakeResponse(400, 'No hay Post'));
				}
			}else{
				return $this->PJSON($this->modelo->MakeResponse(400, 'No tienes permisos para esta accion'));
			}
		}
		/**
		 * Function Destroy
		 * Elimina fisicamente un registro
		 * @return json
		 */
		public function Destroy(){

			if($this->modelo->session->GetDatos('permisos')['eliminar'] == 1){
				if($this->Post(['Cod'])){
					return $this->PJSON($this->modelo->Destroy($this->GetPost('Cod')));
				}else{
					return $this->PJSON($this->modelo->MakeResponse(400, 'No hay Post'));
				}
			}else{
				return $this->PJSON($this->modelo->MakeResponse(400, 'No tienes permisos para esta accion'));
			}
		}
		/**
		 * Function Consulta 
		 * Busca los registros filtrandolo por el id unico
		 * @return json
		 */
		public function Consulta($id){
			return $this->PJSON($this->modelo->Consulta($id[0]));
		}

		/**
		 * Function Listar 
		 * Lista los datos traidos desde el modelo de forma grafica 
		 * @return string (html)
		 */
		public function Listar($valor){
			echo $this->modelo->Listar($valor[0]);
		}

		/**
		 * Function PaginadorController 
		 * Consulta un paginador para mostrar un catalogo de registros
		 * @return json
		 */
		public function PaginadorController(){ 
			return $this->PJSON($this->modelo->ALl());
		}
		/**
		 * Function codificador
		 * crea codigo de cada bien
		 * @return string
		 */
		public function Codificador($valor){
			$start = $valor[0];
			$count = 1;
			$digits = 7;

			for ($n = $start; $n < $start + $count; $n++) {
				$result = str_pad($n, $digits, "0", STR_PAD_RIGHT);
			}

			$valor = $this->modelo->Busqueda_Codigo($start);

			if($result <= $valor){
				$result = $valor + 1;
			}

			$longitud = strlen($result);

			if ($longitud < 7){
				$codigo = "0".$result;
				echo $codigo;
			}else{
				echo  $result;
			}
		}
		/**
		 * Function ConsultaClasificacion
		 * @return string (select de clasificacion)
		 */		
		public function ConsultaClasificacion(){
			echo $this->modelo->SelectClasificacion();
		}
		/**
		 * Function SelectColores
		 * @return string (select de colores)
		 */
		public function SelectColores(){
			return $this->modelo->SelectColores();
		}
		/**
		 * Function Select_Marcas
		 * @return string (select marcas)
		 */
		public function Select_Marcas($categoria){
			echo $this->modelo->Select_Marcas($categoria[0]);			
		}
		/**
		 * Function SelectCategoria
		 * @return string (select categorias)
		 */
		public function SelectCategoria(){
			return $this->modelo->SelectCategoria();
		}
		/**
		 * Function Select_modelo
		 * @return string (select modelos)
		 */
		public function Select_Modelo($marca){
			echo $this->modelo->Select_Modelo($marca[0]);
		}
	}
?>