<?php 
	class ComponentesController extends Controller{
		public function __construct(){
			parent::__construct('Componentes');
		}
		/**
		 * Funcion Insert
		 * Guardar registros
		 * @return json
		 */
		public function Insert(){
			/**
			 * Validacion si existe post
			 * @return boolean 
			 */
			if($this->Post(['Bien','Componente','origen','Factura','Dep','Obser'])){
				$origen = $this->GetPost('origen');
				$Factura = $this->GetPost('Factura');
				$Dep = $this->GetPost('Dep');
				$Obser = $this->GetPost('Obser');
				$bien = $this->GetPost('Bien');
				$Componente  = $this->GetPost('Componente');
				$orden = $this->GetPost('orden');
				$this->modelo->setDatos($origen,$Factura,$Dep,$Obser,$bien, $Componente,$this->fecha(),$orden);
				return $this->PJSON($this->modelo->Asignar());
			}else{
				return $this->PJSON($this->modelo->MakeResponse(400, 'No hay Post'));
			}
		}

		public function ConsultarEncargado($id){
			return $this->PJSON($this->modelo->ConsultarEncargado($id[0]));
		}

		/**
		 * Funcion Update
		 * Actualizar registros
		 * @return json
		 */
		public function Update(){
			/**
			 * Validacion si existe post
			 * @return boolean 
			 */
			if($this->Post(['CodB','Material','CodM_old','CodB_old'])){
				$bien = $this->GetPost('CodB');
				$material  = $this->GetPost('Material');
				$oldMaterial = $this->GetPost('CodM_old');
				$oldBeneficiado = $this->GetPost('CodB_old');
				$this->modelo->setDatos($bien, $material, $oldMaterial, $oldBeneficiado);
				return $this->PJSON($this->modelo->Update());
			}else{								
				return $this->PJSON($this->modelo->MakeResponse(400, 'No hay Post'));
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

		public function ModalAsignacion($tipo){
			return $this->PJSON($this->modelo->All($tipo[0]));
		}

		public function SearchById($cod){
			$this->PJSON($this->modelo->SearchById($cod[0]));
		}
	}