<?php

class Saa_libs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Saa_lib_model');
    }

    public function Ventas() {
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
        $this->load->view('Admin/Facturas');     
        $this->load->view('templates/footer');
        }else{
            redirect($last);  
        }

    }
       
    }
public function mail(){

$destinatario = "adrianjose605@gmail.com, sergiorhm@hotmail.com"; 
$asunto = "Este mensaje es de prueba"; 
$cuerpo = ' 
<html> 
<head> 
   <title>Prueba de correo</title> 
</head> 
<body> 
<h1>Hola amigos!</h1> 
<p> 
<b>Bienvenidos a mi correo electrónico de prueba</b>.  
</p> 
</body> 
</html> 
'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

//dirección del remitente 
$headers .= "From: Adrian Peñaloza<adrianjose605@gmail.com>\r\n"; 

//dirección de respuesta, si queremos que sea distinta que la del remitente 
$headers .= "Reply-To: adrianpenaloza605@gmail.com\r\n"; 

//ruta del mensaje desde origen a destino 
$headers .= "Return-path: adrianpenaloza605@gmail.com\r\n"; 

//direcciones que recibián copia 
//$headers .= "Cc: maria@desarrolloweb.com\r\n"; 

//direcciones que recibirán copia oculta 
//$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n"; 

mail($destinatario,$asunto,$cuerpo,$headers);


}
    public function Lib_ventas() {
         if (!$this->session->userdata('logueado')) {

         redirect('usuarios/acceso');
     } else{
         $this->load->model('Usuarios_model');
        // $this->load->model('Pdfs_model');
         $p=$this->Usuarios_model->permisos($this->session->userdata('permiso'));
         if($p->LibroVentaConsolidado==1){  

            $data['Permisos']=$p->Permisos;
            $data['LVS']=$p->LibroVentaSucursal;
            $data['LV']=$p->LibroVentaConsolidado;
            $data['Facturacion']=$p->Facturacion;
            $data['Usuarios']=$p->Usuarios;
            $data['Empresas']=$p->Empresas;
            $data['Sucursales']=$p->Sucursales;
            $data['nombre']=$this->session->userdata('nombre');
             $data['Sms']=$p->Mensajes;
            $data['Contac']=$p->Contactos;
           
        $this->load->view('templates/header');
        $this->load->view('navbars/admin',$data);
        $this->load->view('Admin/Lib_Ventas',$data);     
        $this->load->view('templates/footer');
        }else{
            redirect($last);  
        }

    }
       
    }    public function PDF() {
         if (!$this->session->userdata('logueado')) {

         redirect('usuarios/acceso');
     } else{
         $this->load->model('Usuarios_model');
         $this->load->model('Pdfs_model');
         $p=$this->Usuarios_model->permisos($this->session->userdata('permiso'));
         if($p->LibroVentaConsolidado==1){  
            
            $data = $this->getInputFromAngular();  
           
        //$this->load->view('templates/header');
        //$this->load->view('navbars/admin',$data);
        $this->load->view('Admin/pdf_cosolidado',$data);     
        //$this->load->view('templates/footer');
        }else{
            redirect($last);  
        }

    }
       
    }

    public function dashboard() {
      if (!$this->session->userdata('logueado')) {

         redirect('usuarios/acceso');
     } else{
         $this->load->model('Usuarios_model');
         $p=$this->Usuarios_model->permisos($this->session->userdata('permiso'));
         //if($p->LibroVentaConsolidado==1){  

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
            $this->load->view('Admin/Dashboard');     
            $this->load->view('templates/footer');
        //}else{
           // redirect('usuarios/acceso');  
       // }

    }
}

public function ver(){
    header('Content-Type: application/json');
    echo json_encode($this->Saa_lib_model->get_all());
}

public function totalCredito(){
    header('Content-Type: application/json');
    echo json_encode($this->Saa_lib_model->get_credito_sucursal());
}

public function serie_ventas($id){
   //$id=$this->input->get('id');
   //echo $id;
    header('Content-Type: application/json');
    echo json_encode($this->Saa_lib_model->get_serie_sucursal($id));
}
public function barra_ventas(){
   //$id=$this->input->get('id');
   //echo $id;
    header('Content-Type: application/json');
    echo json_encode($this->Saa_lib_model->get_barra_sucursal());
}

public function dispersion_ventas($codigo,$fecha){
   
    header('Content-Type: application/json');
   echo json_encode($this->Saa_lib_model->get_dispersion_ventas($codigo,$fecha));
}

public function barra_ventas_drilldown(){
   //$id=$this->input->get('id');
   //echo $id;
    header('Content-Type: application/json');
    echo json_encode($this->Saa_lib_model->get_barra_sucursal_mes());
}public function barra_ventas_drilldown2(){
   //$id=$this->input->get('id');
   //echo $id;
    header('Content-Type: application/json');
    echo json_encode($this->Saa_lib_model->get_barra_sucursal_mes2());
}

public function totalFacturado(){
    header('Content-Type: application/json');
    echo json_encode($this->Saa_lib_model->get_facturado_sucursal());
}

public function totalFacturas(){
    header('Content-Type: application/json');
    echo json_encode($this->Saa_lib_model->get_facturas_sucursal());
}




 public function tabla_principal_ventas($count = 10, $page = 1, $order = 'NroCtrol', $type = 'asc'){
         if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Saa_lib_model->generar_json_tabla_facturas($inicio, $count, $order, $type);

        if ($type != 'asc') {
            $type = 'dsc';
        }
        $cantidad_total = $array['cantidad'][0]['cantidad'] + 0;
        $paginas_totales = ceil($cantidad_total / $count);

        $result = $array['resultado'];

        $meta = $array['meta'];
        foreach ($result as $row) {
            $ret['rows'][] = $row;
        }

        foreach ($meta as $row) {
            $ret['header'][] = array_map('utf8_encode', array('name' => $row, 'key' => $row));
        }

        $ret['pagination'] = array('count' => $count, 'page' => $page, 'pages' => $paginas_totales, 'size' => $cantidad_total);

        $ret['sort-by'] = $order;
        $ret['sort-order'] = $type;

        echo json_encode($ret);
    } 

}
