<?php
	class ClasificacionController extends Controller{
		public function __construct(){
			parent::__construct('Clasificacion');
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
				if($this->Post(['Cod','Des','Tip'])){
					$cod = $this->GetPost('Cod');
					$des = $this->GetPost('Des');
					$tip = $this->GetPost('Tip');
					$this->modelo->setDatos($cod,$des,$tip);
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
				if($this->Post(['Cod','Des','Tip'])){
					$cod = $this->GetPost('Cod');
					$des = $this->GetPost('Des');
					$tip = $this->GetPost('Tip');
					$this->modelo->setDatos($cod,$des,$tip);
					return $this->PJSON($this->modelo->Update());
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
		 * Function SelectCategoria
		 * Consulta una lista de registro de las categorias
		 * @return string html
		 */
		public function SelectCategoria(){
			return $this->modelo->SelectCategoria();
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
		 * Function Cehck_codigo
		 * Para verificar que el codigo no se repita
		 * @return boolean
		 */
		public function check_codigo(){
			echo $this->modelo->checkCodigo($_GET['Cod']);
		}
	}
?>
