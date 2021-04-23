<?php
  class PDFController extends Controller{
    private $mpdf;
    public $codigo_comprobante;

    public function __construct(){
      parent::__construct('PDF');

      $this->codigo_comprobante = null;

      require_once './vendor/autoload.php';
      $this->mpdf = new \Mpdf\Mpdf([
        'tempDir' => __DIR__ . '/custom/temp/dir/path',
        'format' => 'Legal'
      ]);
      $this->mpdf->SetFooter("{PAGENO}");      
    }

    public function Comprobante($cod){
      return $this->modelo->GetComprobante($cod);
    }

    public function PrintPDF(){
      $html = ob_get_contents();
      ob_end_clean();
      $stylesheet = file_get_contents(constant('URL')."Views/Assets/dist/css/adminlte.min.css");
      $this->mpdf->AddPage('p','','','','',20,20,10,10);
      $this->mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
      $this->mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);  
      $this->mpdf->Output();
    }
  }
?>