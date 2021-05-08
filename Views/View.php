<?php
  class View extends Session{
    private $cod_comprobante;
    /**
     * RenderView()
     * @param string name view
     * @return file.php
     */
    public function RenderView($ruta){
      // var_dump($ruta[0]);
      // die("hola");
      
      if(strpos($ruta[sizeof($ruta) - 1],'Vis') !== false && $ruta[0] != "PDF"){
        $url_route = '';
                
        foreach($ruta as $key){       

          if(!strpos($key,'Vis') && gettype(strpos($key,'Vis')) == "boolean"){
            $url_route .= $key.'/';
          }else{
            $url_route .= $key;
          }
        }
        $File = './Views/Contents/'.$url_route.'.php';
        
        if(file_exists($File)){

          require_once $File;
        }else{
          $this->Redirect('');
        }
      }elseif($ruta[0] == 'PDF'){

        // die("hola");
        
        $File = "./Views/Contents/pdf/$ruta[1].php";

        if(file_exists($File)){
          
          $this->cod_comprobante = (isset($ruta[2])) ? $ruta[2] : null;
          require_once $File;
        }
      }
    }
    private function Control($name){
      require_once "./Controllers/$name.php";
      return new $name();
    }
    /**
     * Redirect()
     * @param string ruta
     * @return header()
     */
    public function Redirect($ruta = ''){
      header('Location: '. constant('URL') . $ruta );
    }

    private function Headers($title = ''){
      require_once './Views/Includes/Header.php';
    }

    private function Nav(){
      require_once './Views/Includes/Nav.php';
    }

    private function Wraper($vista = '', $ruta = '', $controlador){
      require_once './Views/Includes/WraperHeader.php';
    }
    private function Scripts($nameController = ''){
      require_once './Views/Includes/Scripts.php';
    }
    /**
     * Footer()
     * @param string $nameController
     * @return Footer.php
     * @return Modal.php
     * @return Scripts.php (jquery, sweetAlert2, .Js)
     */
    private function Footer($nameController = ''){
      
      if($nameController != ''){
        // Especific modal edit
        $url = "./Views/Contents/$nameController/ModalEdit.php";

        if(file_exists($url)){
          require_once $url;
        }
      }
      $this->Scripts($nameController);
      require_once './Views/Includes/Modal.php';
      require_once './Views/Includes/Footer.php';
    }
    /**
     * Exit
     * @return redirect to login page
     */
    private function Exit(){
      if(!$this->IfSession()){
        $this->Redirect('Login');
      }else{
        
        if(isset($_GET['url'])){
          $ruta = explode("/", $_GET["url"]);

          if($ruta[0] == "PDF"){
            $url = $ruta[0]."/".$ruta[1];
            if(!$this->validRole($url)){
              $this->Redirect('');  
            }
          }elseif(!$this->validRole($_GET['url'])){
            $this->Redirect('');
          }
        }
      }
    }
  }
