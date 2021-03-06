<?php
  session_start();

  class Session{
    private $Roles_Views = [
      // INVITADO PUEDE ACCEDER A ESCASAS RUTAS
      'Invitado' => [
        'NULL',
        'Home/Vis_HomePage','Home/Vis_Nosotros',
        'Nucleo/Vis_Index',
        'Dependencias/Vis_Index',
        'Clasificacion/Vis_Index',
        'Especies/Vis_Index',
        'Bienes/Vis_Index',
        'Marcas/Vis_Index',
        'Modelos/Vis_Index',
        'Personas/Vis_Index',
        'Razas/Vis_Index',
      ],
      //ASISTENTE PUEDE ACCEDER A CIERTAS RUTAS
      'Asistente' => [
        'NULL',
        'Home/Vis_HomePage','Home/Vis_Nosotros',
        'Nucleo/Vis_Index','Nucleo/Vis_Registro',
        'Dependencias/Vis_Index','Dependencias/Vis_Registro',
        'Clasificacion/Vis_Index','Clasificacion/Vis_Registro',
        'Especies/Vis_Index','Especies/Vis_Registro',
        'Bienes/Vis_Index','Bienes/Vis_Registro','Bienes/Vis_Incorporados',
        'Marcas/Vis_Index','Marcas/Vis_Registro',
        'Modelos/Vis_Index','Modelos/Vis_Registro',
        'Personas/Vis_Index','Personas/Vis_Registro',
        'Razas/Vis_Index','Razas/Vis_Registro',
      ],
      //ADMIN PUEDE ACCEDER A TODAS LAS RUTAS
      'Admin' => [
        'NULL',
        'Home/Vis_HomePage','Home/Vis_Nosotros',
        'Nucleo/Vis_Index','Nucleo/Vis_Registro',
        'Dependencias/Vis_Index','Dependencias/Vis_Registro',
        'Clasificacion/Vis_Index','Clasificacion/Vis_Registro',
        'Especies/Vis_Index','Especies/Vis_Registro',
        'Bienes/Vis_Index','Bienes/Vis_Registro','Bienes/Vis_Incorporados',
        'Marcas/Vis_Index','Marcas/Vis_Registro',
        'Modelos/Vis_Index','Modelos/Vis_Registro',
        'Personas/Vis_Index','Personas/Vis_Registro',
        'Razas/Vis_Index','Razas/Vis_Registro',
      ],
      // SUPER ADMIN PUEDE ACCEDER A TODAS LAS RUTAS
      'Super Admin' => [
        'NULL',
        'Home/Vis_Ayuda',
        'Home/Vis_HomePage','Home/Vis_Nosotros',
        'Nucleo/Vis_Index','Nucleo/Vis_Registro',
        'Dependencias/Vis_Index','Dependencias/Vis_Registro',
        'Clasificacion/Vis_Index','Clasificacion/Vis_Registro',
        'Especies/Vis_Index','Especies/Vis_Registro',
        'Bienes/Vis_Index','Bienes/Vis_Registro','Bienes/Vis_Incorporados','Bienes/Vis_Desincorporados',
        'Marcas/Vis_Index','Marcas/Vis_Registro',
        'Modelos/Vis_Index','Modelos/Vis_Registro',
        'Personas/Vis_Index','Personas/Vis_Registro',
        'Razas/Vis_Index','Razas/Vis_Registro',
        'Transaccion/Vis_AsignarComponente',
        'Transaccion/Vis_Componentes',
        'Transaccion/Incorporacion/Vis_Incorporacion',
        'Transaccion/Incorporacion/Vis_Index',
        'Transaccion/Reasignacion/Vis_Reasignacion',
        'Transaccion/Reasignacion/Vis_Index',
        'Transaccion/Desincorporacion/Vis_Desincorporacion',
        'Transaccion/Desincorporacion/Vis_Index',
        'Transaccion/Componentes/Vis_AsignarComponentes',
        'Transaccion/Vis_Innactivos',
        'PDF/Vis_Comprobante','PDF/Vis_Reportes','PDF/Vis_Inventario'
      ],
    ];

    public function __constuct(){
      $_SESSION['user'] = null;
    }

    public function IfSession(){
      if(isset($_SESSION['user']['user_id'])){
        return true;
      }
      return false;
    }

    public function SetDatos($array = []){
      $_SESSION['user']['user_id'] = $array['id'];
      $_SESSION['user']['user_name'] = $array['name'];
      $_SESSION['user']['photo'] = $array['photo'];
      $_SESSION['user']['permisos'] = $array['permisos'];

      return $this->IfSession();
    }

    public function GetDatos($key = ''){
      if(isset($_SESSION['user'])) return isset($key) && $key != '' ? $_SESSION['user'][$key] : $_SESSION['user'];
    }

    public function validRole($ruta){
      return in_array($ruta,$this->Roles_Views[$this->GetDatos('permisos')['roles_name']]);
    }

    public function Logout(){
      session_destroy();
      session_unset();
    }
  }
