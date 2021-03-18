<?php
	class PersonasController extends Controller{
		public function __construct(){
			parent::__construct('Personas');
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
				if($this->Post(['Cod','Nom','Ape','Tel','Cargo','Email','Fecha','Dir','Dep'])){
					$Cod = $this->GetPost('Cod');
					$Nom = $this->GetPost('Nom');
					$Ape = $this->GetPost('Ape');
					$Tel = $this->GetPost('Tel');
					$Cargo = $this->GetPost('Cargo');
					$Email = $this->GetPost('Email');
					$Fecha = $this->GetPost('Fecha');
					$Dir = $this->GetPost('Dir');
					$Dep = $this->GetPost('Dep');
					$this->modelo->setDatos($Cod,$Nom,$Ape,$Tel,$Cargo,$Email,$Fecha,$Dir,$Dep);
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
		 * Actualiza registros
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
				if($this->Post(['Cod','Nom','Ape','Tel','Cargo','Email','Fecha','Dir','Dep'])){
					$Cod = $this->GetPost('Cod');
					$Nom = $this->GetPost('Nom');
					$Ape = $this->GetPost('Ape');
					$Tel = $this->GetPost('Tel');
					$Cargo = $this->GetPost('Cargo');
					$Email = $this->GetPost('Email');
					$Fecha = $this->GetPost('Fecha');
					$Dir = $this->GetPost('Dir');
					$Dep = $this->GetPost('Dep');
					$this->modelo->setDatos($Cod,$Nom,$Ape,$Tel,$Cargo,$Email,$Fecha,$Dir,$Dep);
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
					$cod = $this->GetPost('Cod');
					$fecha = $this->fecha();
					return $this->PJSON($this->modelo->Delete($cod,$fecha));
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
			$this->PJSON($this->modelo->Consulta($id[0]));
		}

		/**
		 * Function SelectCargos
		 * Consulta una lista de registro de los Cargos
		 * @return string html
		 */
		public function SelectCargos(){
			echo $this->modelo->Select_Cargos();
		}

		/**
		 * Function SelectDeps
		 * Consulta una lista de registro de las dependencias
		 * @return string html
		 */
		public function SelectDeps($condition = ''){
			echo $this->modelo->Select_Dependencias($condition);
		}

		/**
		 * Function FechaActual
		 * @return string fecha actual
		 */
		public function FechaActual(){
			return $this->fecha();
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
			return $this->PJSON($this->modelo->All());
		}
		/**
		 * Function Chech_Cedula
		 * revisa que no alla una cedula duplicada a la hora de registrar a una persona
		 * @return boolean
		 */
		public function check_cedula(){
			echo $this->modelo->checkCedula($_GET['Cod']);
		}
		/**
		 * Function Chech_Email
		 * revisa que no alla un correo duplicado a la hora de registrar a una persona
		 * @return boolean
		 */
		public function check_email(){
			echo $this->modelo->checkEmail($_GET['Email']);
		}
	}
?>