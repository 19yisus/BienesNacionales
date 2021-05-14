<?php
  abstract class Model extends DB{
    public $session;
    protected $view;

    public function __construct(){
      parent::__construct();
      $this->session = new Session();
      $this->view = new View();
    } 

    protected function Query($sql){
      return $this->Conectar()->query($sql);
    }

    protected function start_transaction(){
      return $this->Conectar()->beginTransaction();
    } 

    protected function Prepare($sql){
      return $this->Conectar()->prepare($sql);
    }

    protected function Exec($con){
      try{
        return $con->execute();
      }catch(PDOEXception $e){
        print_r("Error = ".$e->getMessages());
        return false;
      }
    }

    public function MakeResponse($status, $respuesta, $datos = '', $transaction = []){
      if(isset($transaction) && isset($transaction['valid'])){
        if($transaction['valid']){
          return ['status' => $status, 'respuesta' => $respuesta, 'datos' => $datos, 'transaction' => true, 'comprobante_url' => $transaction['url']];  
        }
        
      }
      return ['status' => $status, 'respuesta' => $respuesta, 'datos' => $datos];
    }

    protected function Encript($password){
      return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    protected function GenerateCodeComprobante($v){
      $start = $v;
      $count = 1;
      $digits = 10;

      for ($n = $start; $n < $start + $count; $n++) {
          $result = str_pad($n, $digits, "0", STR_PAD_LEFT);
      }
      return $result;
    }

    public function CheckCodeComprobante($code){
      $result = $this->GenerateCodeComprobante($code);
      $valor = $this->ComprobanteLastCode();
      if($result <= $valor){
        $result = $valor + 1;
      }

      $longitud = strlen($result);            
      
      if($longitud < 10){
        $result = $this->GenerateCodeComprobante($result);
      }

      return $result;
    }

    protected function ComprobanteLastCode(){
      try{
        $con = $this->Query("SELECT com_cod FROM comprobantes ORDER BY com_cod DESC;")->fetch();

        if($con){
          return $con['com_cod'];
        }

        return false;

      }catch(PDOException $e){
        error_log("Error en la consulta::models/Model->ComprobanteLastCode(), ERROR = ".$e->getMessage());
        return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
      }
    }

    /**
     * Funtion Limpiar
     * Limpia las cadenas de texto y valores numericos que puedan contener caracteres no deseados
     * @param var
     * @return var
     */
    protected function Limpiar($cadena){
      $cadena = stripslashes($cadena);
      $cadena = str_ireplace("SELECT * FROM","",$cadena);
      $cadena = str_ireplace("DELETE * FROM","",$cadena);
      $cadena = str_ireplace("INSERT INTO","",$cadena);
      $cadena = str_ireplace("[","",$cadena);
      $cadena = str_ireplace("]","",$cadena);
      $cadena = str_ireplace("(","",$cadena);
      $cadena = str_ireplace(")","",$cadena);
      $cadena = str_ireplace("{","",$cadena);
      $cadena = str_ireplace("}","",$cadena);
      $cadena = str_ireplace("==","",$cadena);
      $cadena = str_ireplace("=","",$cadena);
      $cadena = str_ireplace("<script>","",$cadena);
      $cadena = str_ireplace("<script src= >","",$cadena);
      $cadena = str_ireplace("src=","",$cadena);
          
      if(!is_numeric($cadena)){
        $cadena = strtoupper($cadena);
      }else{
        $cadena = str_ireplace(" ","",$cadena);
      }
      return $cadena;
    }
    /**
     * Function ShowCodIncrements
     * Consulta el codigo mas alto de una tabla de la base de datos y le suma 1 para representar el proximo codigo
     * @param primaryKey
     * @param TableName
     * @return number 
     */
    public function showCodIncrements($primariKey,$table){

      try{

          $con = $this->Query("SELECT MAX($primariKey) AS maximo FROM $table ;")->fetch();
          
          $res = $con['maximo'] + 1;
          return $res;

      }catch(PDOException $e){
        error_log("Error en la consulta::models/ModelBase->showCodINcrements(), ERROR = ".$e->getMessage());
        return $this->MakeResponse(400, "Error desconocido, Revisar php-error.log");
      }
    }
  }