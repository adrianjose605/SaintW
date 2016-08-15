<?php

class Sms extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sms_model');
       

      
    }

    public function clientes($count = 5, $page = 1, $order = 'Descrip', $type = 'asc'){

  
    //header('Content-Type: application/json');
    //echo json_encode($this->Sms_model->clientes());
  if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Sms_model->generar_json_tabla($inicio, $count, $order, $type);

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


  public function tabla_principal_clientes($count = 300, $page = 1, $order = 'Descrip', $type = 'asc'){
         if ($type != 'asc') {
            $type = 'desc';
        }
        $ret = array();
        $inicio = $page * $count - $count;
        $array = $this->Sms_model->generar_json_tabla($inicio, $count, $order, $type);

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

    public function recent(){

  
    header('Content-Type: application/json');
    echo json_encode($this->Sms_model->recent());

    }
    public function nuevo(){

    if (!$this->session->userdata('logueado')) {

         redirect('usuarios/acceso');
     } else{
         $this->load->model('Usuarios_model');
         $p=$this->Usuarios_model->permisos($this->session->userdata('permiso'));
         if($p->Mensajes==1){  

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

    public function send_sms($var=false){
   include_once ("lib/centaurosms.php");
    $SMS = new CentauroSMS('991509570419159','lFmkOIfuSZNOeSXaFOiq');
    $js1=null;
    // var_dump(json_decode(file_get_contents('php://input')));
    $post=json_decode(file_get_contents('php://input'));
    
    for($i=0;$i<count($post[0]);$i++){
        $num=str_replace(array(" ", "-","+"),"",$post[0][$i]->cel);
        $js1[]=array("id" => $post[0][$i]->id,"cel" =>$num,"nom" => $post[0][$i]->nom);
        // $js1[]=array("id" => $post[0][1]->id,"cel" =>$post[0][1]->cel,"nom" => $post[0][1]->nom);
    
    }
    

    $destinatarios = array("id" => "0","cel" => "04249342034","nom" => "Adrian");  
    $msg = $post[1];
    //$js='{"id":"0","cel":"04249342034","nom":"Pedro Perez"},{"id":"0","cel":"04249342034","nom":"Jose Perez"}';
    //$js = json_encode($destinatarios);
    //print_r($js);
    $js1 = json_encode($js1);
    $js1 =str_replace(array("[", "]"),"",$js1);
    //echo($js1);
    //echo($msg);
    $result = $SMS->set_sms_send($js1,$msg); 
    //echo($result);
    if($result['status']==200)
    $ret=$this->Sms_model->envio($result,$msg);

    echo (json_encode($result));

    }

    public function delete_sms($var=false){

   // var_dump(json_decode(file_get_contents('php://input')));
    $post=json_decode(file_get_contents('php://input'));
    
  for($i=0;$i<count($post[0]);$i++){
   
    $ms1[]=array("id" => $post[0][$i]->id);
    
  }

    $ret=$this->Sms_model->delete($ms1);

    echo (json_encode($ret));

    }

}