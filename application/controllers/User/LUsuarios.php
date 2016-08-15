<?php

class LUsuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios_model');
    }    
    

     public function ver_sel($activos = true) {
        $res = array();
        $result = $this->Usuarios_model->get_usuarios_sel($activos);
        foreach ($result as $row) {
            $res[] = $row;
        }
        echo json_encode($res);
    }
    /**
     * Creacion  de un nuevo pais
     */
    public function nuevo_usuario(){
        echo json_encode($this->Usuarios_model->insert_usuario());         
    }
   
    public function modificar_usuarios(){
        echo json_encode($this->Usuarios_model->edit_usuarios());         
    }
        
    public function tabla_principal_usuarios($count = 5, $page = 1, $order = 'sis_usuario.Nombre', $type = 'asc'){
         if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Usuarios_model->generar_json_tabla_principal($inicio, $count, $order, $type);

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
    
  
    public function verU ($id=1){             
        $result=$this->Usuarios_model->get_usuarios($id);
        foreach ($result as $row) {
            echo  (json_encode( $row));
            break;
        }
    }
           
    /*public function ver_sel($activos=true){        
        $res=array();
        $result = $this->Usuarios_model->get_Usuarios_sel($activos);
        foreach ($result as $row) {
            $res[]= $row;            
        }
        echo json_encode($res);        
    }*/
    

    public function index() {
        $data['nombre'] = $this->session->userdata('nombre');
        $data['title'] = 'Usuarios';

        if (!$this->session->userdata('logueado')) {

         redirect('usuarios/acceso');
     } else{
         $this->load->model('Usuarios_model');
         $p=$this->Usuarios_model->permisos($this->session->userdata('permiso'));
         if($p->Usuarios==1){  

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
        $this->load->view('User/Usuarios');     
        $this->load->view('templates/footer');
        }else{
            redirect($last);  
        }

    }
     
       
    }
    
}
