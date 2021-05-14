<?php
	class DependenciasController extends Controller{
		public function __construct(){
			parent::__construct('Dependencias');
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
				if($this->Post(['Des','Nu'])){
					$cod = null;
					$des = $this->GetPost('Des');
					$nu = $this->GetPost('Nu');
					$this->modelo->setDatos($cod,$des,$nu);
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
				if($this->Post(['Cod','Des','Nu'])){
					$cod = $this->GetPost('Cod');
					$des = $this->GetPost('Des');
					$nu = $this->GetPost('Nu');
					$this->modelo->setDatos($cod,$des,$nu);
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
		 * Eliminar registro
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
			return $this->PJSON($this->modelo->Consulta($id[0]));
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
		 * Function Select_Nucleos
		 * Consulta una lista de registro de los nucleos 
		 * @return string html
		 */
		public function Select_Nucleos(){
			echo $this->modelo->Select_Nucleos();
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
		 * Fucntion Isthereprincipal
		 * Una revision para verificar que no allan dependencias registradas para el primer registro
		 * @return boolean
		 */
		public function Isthereprincipal(){
			return $this->PJSON($this->modelo->Isthereprincipal());
		}
	}
?>