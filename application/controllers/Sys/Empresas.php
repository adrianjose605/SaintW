<?php

class Empresas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Empresas_model');
    }    
    

     public function ver_sel($activos = true) {
        $res = array();
        $result = $this->Empresas_model->get_empresas_sel($activos);
        foreach ($result as $row) {
            $res[] = $row;
        }
        echo json_encode($res);
    }
    /**
     * Creacion  de un nuevo pais
     */
    public function nueva_empresa(){
        echo json_encode($this->Empresas_model->insert_empresa());         
    }
   
    public function modificar_Empresas(){
        echo json_encode($this->Empresas_model->edit_Empresas());         
    }
        
    public function tabla_principal_Empresas($count = 5, $page = 1, $order = 'sch_sistema.SIS_EMP.Nombre', $type = 'asc'){
         if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Empresas_model->generar_json_tabla_principal($inicio, $count, $order, $type);

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
    
  
    public function verE ($id=1){             
        $result=$this->Empresas_model->get_Empresas($id);
        foreach ($result as $row) {
            echo  (json_encode( $row));
            break;
        }
    }
           
     

    public function index() {
        $data['nombre'] = $this->session->userdata('nombre');
        $data['title'] = 'Empresas';

        if (!$this->session->userdata('logueado')) {

         redirect('Usuarios/acceso');
     } else{
         $this->load->model('Usuarios_model');
         $p=$this->Usuarios_model->permisos($this->session->userdata('permiso'));
         if($p->Empresas==1){  

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
        $this->load->view('Sys/Empresas');     
        $this->load->view('templates/footer');
        }else{
            redirect($last);  
        }

    }
     
       
    }
    
}
