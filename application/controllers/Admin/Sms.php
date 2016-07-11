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

}