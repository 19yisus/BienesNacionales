<?php
  class PDFController extends Controller{
    private $mpdf;
    public $codigo_comprobante;

    public function __construct(){
      parent::__construct('PDF');
      
      $this->codigo_comprobante = null;
      
      $vendor = "./vendor/autoload.php";
      if(file_exists($vendor)){
        require_once($vendor);

        $this->mpdf = new \Mpdf\Mpdf([
          'tempDir' => __DIR__ . '/custom/temp/dir/path',
          'format' => 'Legal',
        ]);
        $this->mpdf->SetFooter("{PAGENO}");      
      }else{
        error_log("Autoload.php file it's not exists!, please run the comand 'composer install' ");
        header('Location: '. constant('URL') );
        
      }
    }

    public function Comprobante($cod){
      return $this->modelo->GetComprobante($cod);
    }

    public function Inventario(){
      $mov = $_POST['mov'];
      $first = $_POST['first_date'];
      $second = $_POST['second_date'];

      $datos = $this->modelo->MakeInventario($mov,$first,$second);

      if(isset($datos[0])){
        require './Views/Contents/pdf/Vis_InventarioBienes.php';
      }else{
        ?>
        <script>
          alert('No existen registros, intenta con otras fechas diferentes');
          // window.location.href = "<?php echo constant('URL');?>PDF/Vis_Inventario";
          window.close();
        </script>
        <?php
      }
      
    }

    public function PrintPDF($filaname, $op = ''){
      $html = ob_get_contents();
      ob_end_clean();
      $stylesheet = file_get_contents(constant('URL')."Views/Assets/dist/css/adminlte.min.css");
      $this->mpdf->AddPage('p','','','','',20,20,10,10);
      $this->mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
      $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);  
      if($op != ''){
        $this->mpdf->Output($filaname, $op);
      }else{
        $this->mpdf->Output($filaname);
      }
    }
  }
?>