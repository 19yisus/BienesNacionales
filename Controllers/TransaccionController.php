<?php
	class TransaccionController extends Controller{
		public function __construct(){
			parent::__construct('Transaccion');
		}
		/**
		 * Funcion Incorporacion
		 * Transaction
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
				$encargado = $this->GetPost("encargado");
				$this->modelo->setDatos($origen,$Factura,$Dep,null,$Obser,$bien,$this->fecha(),$orden,$encargado);
				return $this->PJSON($this->modelo->Incorporar());
			}else{
				return $this->PJSON($this->modelo->MakeResponse(400, 'No hay Post'));
			}
		}
		/**
		 * Funcion Desincorporacion
		 * Transaction
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
				$encargado = $this->GetPost("encargado");
				$this->modelo->setDatos($origen,null,$Dep,null,$Obser,$bien,$this->fecha(),$orden,$encargado);
				return $this->PJSON($this->modelo->Desincorporar());
			}else{
				return $this->PJSON($this->modelo->MakeResponse(400, 'No hay Post'));
			}
		}
		/**
		 * Funcion Reasignacion
		 * Transaction
		 * @return json
		 */
		public function Reasignacion(){
			/**
			 * Validacion si existe post
			 * @return boolean
			 */
			if($this->Post(['origen','Obser'])){
				$origen = $this->GetPost('origen');
				$orden = $this->GetPost('orden');
				$Obser = $this->GetPost('Obser');
				$Dep = $this->GetPost('Dep_origen');
				$newdep = $this->GetPost('Dep_destino');
				$bien = $this->GetPost('bien_cod');
				$encargado = $this->GetPost("encargado");
				$this->modelo->setDatos($origen,null,$newdep,$Dep,$Obser,$bien,$this->fecha(),$orden,$encargado);
				return $this->PJSON($this->modelo->Reasignar());
			}else{
				return $this->PJSON($this->modelo->MakeResponse(400, 'No hay Post'));
			}
		}

		public function ConsultarEncargado($id){
			return $this->PJSON($this->modelo->ConsultarEncargado($id[0]));
		}

		public function Componentes(){
			return $this->modelo->Componentes_bienes('Componentes');
		}

		public function Bienes($codigo){
			return $this->modelo->Componentes_bienes('Electronicos', $codigo);
		}

		public function Asignar(){
			if($this->Post(['componente_cod','bien_cod'])){
				$componente = $this->GetPost('componente_cod');
				$bien = $this->GetPost('bien_cod');
				return $this->PJSON($this->modelo->Asignar($componente,$bien));
			}else{
				return $this->PJSON($this->modelo->MakeResponse(400,'No hay Post'));
			}
		}

		public function print_info(){
			echo json_encode([
				"code" => $this->modelo->CheckCodeComprobante("1"),
				"fecha" => $this->fecha()
			]);
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
			$this->PJSON($this->modelo->Bienes('',''));
		}

		public function BienesIncorporados($dep = []){
			$this->PJSON($this->modelo->Bienes('Incorporado',$dep[0]));
		}

		public function BienesDesincorporados($dep = []){
			$this->PJSON($this->modelo->Bienes('Desincorporados',$dep[0]));
		}

		public function CatalogoComprobantes($tipo){
			return $this->PJSON($this->modelo->CatalogoComprobantes($tipo[0]));
		}
	}
