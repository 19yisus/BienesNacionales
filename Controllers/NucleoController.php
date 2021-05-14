<?php
	class NucleoController extends Controller{
		public function __construct(){
			parent::__construct('Nucleo');
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
			if($this->modelo->session->GetDatos('permisos')['crear'] == 1){
				/**
				 * Validacion si existe post
				 * @return boolean
				 */
				if( $this->Post(['Des','CP','Dir','Tip']) ){
					$cod = null;
					$des = $this->GetPost('Des');
					$cp = $this->GetPost('CP');
					$dir = $this->GetPost('Dir');
					$tip = $this->GetPost('Tip');
					$nu = ($this->GetPost('Tip') == 'SP') ? null : $this->modelo->CodNucleo();

					$this->modelo->setDatos($cod,$des,$cp,$dir,$tip,$nu);
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
				if( $this->Post(['Des','CP','Dir','Cod']) ){
					$cod = $this->GetPost('Cod');
					$des = $this->GetPost('Des');
					$cp = $this->GetPost('CP');
					$dir = $this->GetPost('Dir');
					$tip = (!$this->Post(['Tip'])) ? 'SP' : $this->GetPost('Tip');
					$nu = ($this->GetPost('Tip') == 'SP') ? null : $this->modelo->CodNucleo();

					$this->modelo->setDatos($cod,$des,$cp,$dir,$tip,$nu);
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
		 * Desactiva registro
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
				if( $this->Post(['Cod']) ){
					return $this->PJSON($this->modelo->Delete($this->GetPost('Cod')));
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
		 * Function Listar
		 * Lista los datos traidos desde el modelo de forma grafica
		 * @return string (html)
		 */
		public function Listar($valor){
			echo $this->modelo->Listar($valor[0]);
		}
		/**
		 * Function Consulta
		 * Busca los registros filtrandolo por el id unico
		 * @return json
		 */
		public function Consulta($id){
			$this->PJSON($this->modelo->Consulta($id[0]));
		}
		/**
		 * Function ShowCodigoIncrementado
		 * Consulta la secuencia actual y le suma +1 para mostrar cual sera el proximo codigo
		 * @return number
		 */
		public function ShowCodigoIncrementado(){
			echo $this->modelo->Id();
		}
		/**
		 * Function PaginadorController
		 * Consulta un paginador para mostrar un catalogo de registros
		 * @return json
		 */
		public function PaginadorController(){
			return $this->PJSON($this->modelo->All());
		}
		/**
		 * Funcion IsThereSedePrincipal
		 * para verificar si hay un nucleo registrado
		 * @return boolean
		 */
		public function IsThereSedePrincipal(){
			return $this->PJSON($this->modelo->IsThereSedePrincipal());
		}

		/**
		 * Function Cehck_codigo
		 * Para verificar que el codigo no se repita
		 * @return boolean
		 */
		public function check_postal(){
			echo $this->modelo->checkPostal($_GET['CP']);
		}
	}
?>
