<?php
	class TransaccionController extends Controller{
		public function __construct(){
			parent::__construct('Transaccion');
		}
		/**
		 * Funcion Insert
		 * Guardar registros
		 * @return json
		 */
		public function Incorporar(){
			/**
			 * Validacion si existe post
			 * @return boolean
			 */
			if($this->Post(['origen','Factura','Dep','Obser'])){
				$origen = $this->GetPost('origen');
				$Factura = $this->GetPost('Factura');
				$Dep = $this->GetPost('Dep');
				$Obser = $this->GetPost('Obser');
				$bien = $this->GetPost('bien_cod');
				$orden = $this->GetPost('orden');
				$this->modelo->setDatos($origen,$Factura,$Dep,$Obser,$bien,$this->fecha(),$orden);
				return $this->PJSON($this->modelo->Incorporar());
			}else{
				return $this->PJSON($this->modelo->MakeResponse(400, 'No hay Post'));
			}
		}
		/**
		 * Funcion Insert
		 * Guardar registros
		 * @return json
		 */
		public function Desincorporar(){
			/**
			 * Validacion si existe post
			 * @return boolean
			 */
			if($this->Post(['origen','Obser'])){
				$origen = $this->GetPost('origen');
				$orden = $this->GetPost('orden');
				$Obser = $this->GetPost('Obser');
				$Dep = $this->GetPost('Dep');
				$bien = $this->GetPost('bien_cod');
				$this->modelo->setDatos($origen,null,$Dep,$Obser,$bien,$this->fecha(),$orden);
				return $this->PJSON($this->modelo->Desincorporar());
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

		public function BienesNoIncorporados(){
			$this->PJSON($this->modelo->BienesNoIncorporados());
		}

		public function BienesIncorporados($dep = []){
			$this->PJSON($this->modelo->BienesIncorporados($dep[0]));
		}

		public function CatalogoComprobantes($tipo){
			return $this->PJSON($this->modelo->CatalogoComprobantes($tipo[0]));
		}
	}
