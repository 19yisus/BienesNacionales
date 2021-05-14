<?php 
	class RazasController extends Controller{
		public function __construct(){
			parent::__construct('Razas');
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
				if($this->Post(['Raza','Esp'])){
					$cod = null;
					$Raza = $this->GetPost('Raza'); 
					$Esp = $this->GetPost('Esp');
					$this->modelo->setDatos($cod,$Raza,$Esp);
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
				if($this->Post(['Cod','Raza','Esp'])){
					$cod = $this->GetPost('Cod');
					$Raza = $this->GetPost('Raza'); 
					$Esp = $this->GetPost('Esp');
					$this->modelo->setDatos($cod,$Raza,$Esp);
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
		 * Function Consulta   
		 * Busca los registros filtrandolo por el id unico
		 * @return json
		 */
		public function Consulta($id){ 
			$this->PJSON($this->modelo->Consulta($id[0]));
		}

		/**
		 * Function Select_Especies
		 * Consulta una lista de registro de las especies
		 * @return string html
		 */
		public function Select_Especies(){
      		echo $this->modelo->Select_Especies();			
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
	}
?>