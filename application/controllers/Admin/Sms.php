<?php

class Sms extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sms_model');
    }

    public function clientes(){

  
    header('Content-Type: application/json');
    echo json_encode($this->Sms_model->clientes());

    }
    public function nuevo(){

    if (!$this->session->userdata('logueado')) {

         redirect('usuarios/acceso');
     } else{
         $this->load->model('Usuarios_model');
         $p=$this->Usuarios_model->permisos($this->session->userdata('permiso'));
         if($p->Facturacion==1){  

            $data['Permisos']=$p->Permisos;
            $data['LVS']=$p->LibroVentaSucursal;
            $data['LV']=$p->LibroVentaConsolidado;
            $data['Facturacion']=$p->Facturacion;
            $data['Usuarios']=$p->Usuarios;
            $data['Empresas']=$p->Empresas;
            $data['Sucursales']=$p->Sucursales;
             $data['Sms']=$p->Mensajes;
            $data['Contac']=$p->Contactos;
            $data['nombre']=$this->session->userdata('nombre');
            

        $this->load->view('templates/header');
        $this->load->view('navbars/admin',$data);
        $this->load->view('Admin/Sms_n');     
        $this->load->view('templates/footer');
        }else{
            redirect($last);  
        }

    }
    }

    public function send_sms(){

   include_once ("lib/centaurosms.php");
$SMS = new CentauroSMS('991509570419159','lFmkOIfuSZNOeSXaFOiq');

$destinatarios = array("id" => "0","cel" => "04249342034","nom" => "Adrian");  
$msg = 'Mensaje de prueba';
$js='{"id":"0","cel":"04249342034","nom":"Pedro Perez"},{"id":"0","cel":"04249342034","nom":"Jose Perez"}';
//$js = json_encode($destinatarios);
$result = $SMS->set_sms_send($js,$msg); 
echo (json_encode($result));

    }

}