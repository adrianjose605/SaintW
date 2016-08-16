<?php
 
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Pdfs extends CI_Controller {
 
function __construct() {
        parent::__construct();
   //$this->load->model('Pdfs_model');
   $this->load->model('Saa_lib_model');
    
}
    
    public function index(){ 
      /*  //$data['provincias'] llena el select con las provincias españolas
        $data['provincias'] = $this->Pdfs_model->getProvincias();
        //cargamos la vista y pasamos el array $data['provincias'] para su uso
        $this->load->view('Pdfs_view', $data);*/
    }
 
public function generar() {
        
   
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'letter', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('3D Vision');
        $pdf->SetTitle('Libro de Ventas');
       // $pdf->SetSubject('Tutorial TCPDF');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config_alt.php de libraries/config
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
        $pdf->setFooterData($tc = array(0, 64, 0), $lc = array(0, 64, 128));
 
// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA)); 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER); 
// se pueden modificar en el archivo tcpdf_config.php de libraries/config
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
//relación utilizada para ajustar la conversión de los píxeles
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
 
// ---------------------------------------------------------
// establecer el modo de fuente por defecto
        $pdf->setFontSubsetting(true);
 
// Establecer el tipo de letra
//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
        $pdf->SetFont('helvetica', '', 10, '', true);
 
// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
        $pdf->AddPage();
 
//fijar efecto de sombra en el texto
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
             $aux=$this->input->get('id');
        $get=$this->Saa_lib_model->get_all($aux[0]);
        //var_dump($aux);
       //echo "Prueba ".$aux[0];
$html="<table>";
    $html.="<thead>";
    $html.="<tr>";
            $html.="<td>";
                $html.="Tipo Factura";
            $html.="</td>"; 
            $html.="<td>";
                $html.="Codido Cliente";
            $html.="</td>"; 
            $html.="<td>";
                $html.="Monto";
            $html.="</td>"; 
            $html.="<td>";
                $html.="Monto";
            $html.="</td>"; 
        $html.="</tr>";
    $html.="</thead>";

    $html.="<tbody>";

       for($i=0 ; $i<count($get); $i++){
    $html.="<tr>";
            $html.="<td>";
                $html .=$get[$i]['TipoFac'];
            $html.="</td>";
            $html.="<td>";
                $html .=$get[$i]['CodClie'];
            $html.="</td>"; 
            $html.="<td>";
                $html .=$get[$i]['Monto'];
            $html.="</td>"; 
            $html.="<td>";
                $html .=$get[$i]['Monto'];
            $html.="</td>"; 
    $html.="</tr>";

       }

    $html.="</tbody>";
$html.="</table>";

// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);


// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode("Lib_ventas_.pdf");
        $pdf->Output($nombre_archivo, 'I');
    }
}