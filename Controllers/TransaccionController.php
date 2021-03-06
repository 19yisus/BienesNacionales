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
				$tipo_bienes = $this->GetPost("bien_tipos");
				
				$this->modelo->setDatos($origen,$Factura,$Dep,null,$Obser,$bien,$this->fecha(),$orden,$encargado,$tipo_bienes,null);
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
				$tipo_bienes = $this->GetPost("bien_tipos");
				$destino = $this->GetPost('Destino');

				$this->modelo->setDatos($origen,null,$Dep,null,$Obser,$bien,$this->fecha(),$orden,$encargado,$tipo_bienes, $destino);
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
				$tipo_bienes = $this->GetPost("bien_tipos");
				
				$this->modelo->setDatos($origen,null,$newdep,$Dep,$Obser,$bien,$this->fecha(),$orden,$encargado,$tipo_bienes, null);
				return $this->PJSON($this->modelo->Reasignar());
			}else{
				return $this->PJSON($this->modelo->MakeResponse(400, 'No hay Post'));
			}
		}

		public function Listar($cod_comprobante){
			echo $this->modelo->Listar($cod_comprobante[0]);
		}

		public function ConsultarEncargado($id){
			if(is_array($id)){
				return $this->PJSON($this->modelo->ConsultarEncargado($id[0]));
			}else{
				return $this->modelo->ConsultarEncargado($id);
			}
			
		}

		public function Componentes($por_dependencia){
			return $this->modelo->Componentes_bienes('Componentes','', $por_dependencia);
		}

		public function Bienes($codigo){
			return $this->modelo->Componentes_bienes('Electronicos', $codigo, '');
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
		/**
		 * Comprobante que podamos realizar alguna de las transacciones
		 * @return boolean
		 */
		public function IfTransaccion($nameTransaction){
			return $this->modelo->ValidTransacciones($nameTransaction);
		}

		public function BienesNoIncorporados($tipo){
			$this->PJSON($this->modelo->Bienes('','', $tipo[0]));
		}

		public function BienesIncorporados($datos){
			$this->PJSON($this->modelo->Bienes('Incorporado',$datos[0],$datos[1]));
		}

		public function BienesDesincorporados($datos){
			$this->PJSON($this->modelo->Bienes('Desincorporados',$datos[0],$datos[1]));
		}

		public function CatalogoComprobantes($tipo){
			if(is_array($tipo)){
				return $this->PJSON($this->modelo->CatalogoComprobantes($tipo[0]));
			}else{
				return $this->modelo->CatalogoComprobantes($tipo);
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
	}
