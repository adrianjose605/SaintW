<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

/////////////////////////////////////GRUPOS DE USUARIOS/////////////////////////////////////////////////////////////

public function edit_grupos() {
        $res = array();
        $arr = $this->getInputFromAngular();
        
        
        $this->db->where('id', $arr['id']);        
        unset($arr['id']);
        if ($this->db->update('SIS_PERMISOS', $arr)) {
            $res['status'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['status'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }
        return $res;
    }

      public function insert_grupo() {
        $arr = $this->getInputFromAngular();
        $res = array();
        $this->db->select('Descripcion');
        $this->db->where('Descripcion', $arr['Descripcion']);
        $query1 = $this->db->get('SIS_PERMISOS');
        if($arr['Descripcion']==""){
           $res['status'] = 0;
           $res['mensaje'] = 'Nombre de grupo invalido';
           return $res;
       }

       if ($query1->num_rows() > 0) {
        $res['status'] = 0;
        $res['mensaje'] = 'El grupo ya se encuentra registrado';
        return $res;
    }

    
    
    if ($this->db->insert('SIS_PERMISOS', $arr)) {
        $res['status'] = 1;
        $res['mensaje'] = 'Registrado con Exito';
    } else {
        $res['status'] = 0;
        $res['mensaje'] = 'Error Desconocido';
    }

    return $res;
}
    public function get_Grupo($id) {
        $this->db->select('Descripcion,LibroVentaSucursal, LibroVentaConsolidado,Facturacion,Usuarios,Permisos, Estatus, Empresas, id');
        $this->db->where('id', $id);
        $query = $this->db->get('SIS_PERMISOS');
        return $query->result_array();
    }

    public function generar_json_tabla_grupos($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('Estatus', $arr['estatus']);
        $likes = '';


        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="( Descripcion LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR Descripcion LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('SIS_PERMISOS');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('Descripcion,LibroVentaSucursal, LibroVentaConsolidado,Facturacion,Usuarios,Permisos, Estatus,Empresas, id AS Opciones');
        if ($arr['estatus'])
            $this->db->where('Estatus', $arr['estatus']);
        if (!empty($likes))
            $this->db->where($likes);


        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);

        $query = $this->db->get('SIS_PERMISOS');
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        

        return $respuesta;
    }


////////////////////PERMISOS/////////////////////////////////////////////////////////////////



    function permisos($idpermiso){
        $this->db->select('*');
        $this->db->from('EnterpriseTest.SIS_PERMISOS');
        $this->db->where('id',$idpermiso);
        $result= $this->db->get();
        
        return $result->row();

    }

    /*function login($usuario, $clave){
        $query="call iniciar_sesion('$usuario', '$clave')";
        $result=$this->db->query($query);

        return $result->result_array();

    }*/

// EN FUNCIONAMIENTO
    function acceso($data){
        $this->db->select('*');
        $this->db->from('SIS_USUARIO');
        $this->db->where('Usuario',$data['usuario']);
        $result= $this->db->get();
        $user= $result->row();
        

        if(isset($user)){
            $this->db->select('*');
            $this->db->where('Usuario',$data['usuario']);
            $this->db->where('Clave',$data['clave']);
            $result= $this->db->get('SIS_USUARIO');
            return $result->row();
        }else{

            return NULL; 
        };
        
        

    }



    
    /*function verificacion() {
        $data = $this->getInputFromAngular();
        $usuario = array('nombre' => $data('nom'),
            'nombre' => $data('nom'),
            'usuario' => $data('us'),
            'ventas' => $data('p1'),
            'reportes' => $data('p2'),
            'registro' => $data('p3'),
            'clave' => $data('pass'),);
        $this->db->where('usuario', $usuario['usuario']);
        $query = $this->db->get('usuario_sistema');

        if ($query->row()) {

            if ($query->row()->clave == $usuario['clave']) {

                return 1;
            } else {

                return 2;
            }
        } else {

            return 3;
        }
    }*/

////////////////////Usuarios/////////////////////////////////////////////////////////////////
    public function crear() {
        $data = $this->getInputFromAngular();
        $usuario = [];
        $usuario = ['nombre' => $data['nom'],
        'usuario' => $data['us'],
        'ventas' => $data['p1'],
        'reportes' => $data['p2'],
        'registros' => $data['p3'],
        'clave' => md5($data['pass']),
        'telefono'=> $data['tlfn']];


        $this->db->insert('usuario_sistema', $usuario);
    }

    public function modificar() {
        $data = $this->getInputFromAngular();
        $usuario = [];
        $usuario = [
        'nombre' => $data['nom'],
        'ventas' => $data['p1'],
        'reportes' => $data['p2'],
        'registros' => $data['p3'],
        'pass' => md5($data['pass']),
        'telefono'=> $data['tlfn']];
        
        $this->db->where('usuario', $usuario['usuario']);
        $this->db->update('usuario_sistema', $usuario);

        $this->db->update('usuario_sistema', $usuario);
    }

    public function modificar_usuario() {
        $data = $this->getInputFromAngular();
        $usuario = [];
        if(($data['pass'])){

        }
        if(($data['descripcion'])){
            unset($data['descripcion']);
        }
        $usuario = [
        'nombre' => $data['nombre'],
        'apellido' => $data['apellido'],
        
        ];
        
        $this->db->where('usuario.id', $data['id']);
        $this->db->update('usuarios', $usuario);

    }

    public function consultar() {
        $data = $this->getInputFromAngular();
        $usuario = [];
        $usuario = ['nombre' => $data['nom'],
        'ventas' => $data['p1'],
        'reportes' => $data['p2'],
        'registros' => $data['p3'],
        'clave' => md5($data['pass'])];


        $this->db->insert('usuario_sistema', $usuario);
    }



    public function get_usuarios($id) {
        $this->db->select('Usuario,Nombre,Apellido, fecha_registro,SIS_USUARIO.Estatus, SIS_PERMISOS.Descripcion, SIS_USUARIO.id, SIS_PERMISOS.id, SIS_USUARIO.Clave, SIS_USUARIO.Correo, SIS_USUARIO.Telefono,SIS_USUARIO.id_Grupo, SIS_USUARIO.id_Empresa');
        $this->db->where('SIS_USUARIO.id', $id);
        $this->db->where(' SIS_PERMISOS.id=SIS_USUARIO.id_Grupo');
        $query = $this->db->get('SIS_USUARIO, SIS_PERMISOS');
        return $query->result_array();
    }

    
    
    /*public function get_Grupos_sel($activos=false){
        $this->db->select('ver_noticias,enviar_noticias,boton_panico,crear_usuarios,permisos,estatus,descripcion,id');
        
        if ($activos)
            $this->db->where('Estatus', $activos);
        
        $query = $this->db->get('permisos');
        return $query->result_array();
    }*/


    /*public function get_Usuarios_sel($activos=false){
        $this->db->select('usuario  AS id,nombre AS Nombre, apellido as Apellido, fecha_registro as Fecha de registro');
        
        if ($activos)
            $this->db->where('Estatus', $activos);
        
        $query = $this->db->get('usuarios');
        return $query->result_array();
    }*/
 
    public function generar_json_tabla_principal($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('Estatus', $arr['estatus']);
        $likes = '';


        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(Usuario LIKE '%".$params[$i]."%' OR SIS_USUARIO.Nombre LIKE '%" . $params[$i] . "%'";
            else
                $likes.=" OR Usuario LIKE '%".$params[$i]."%' OR SIS_USUARIO.Nombre LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('SIS_USUARIO');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('Usuario,SIS_USUARIO.Nombre,Apellido ,SIS_USUARIO.Fecha_registro ,SIS_PERMISOS.Descripcion as Privilegios,SIS_EMP.Nombre AS Empresa, SIS_USUARIO.Estatus, SIS_USUARIO.id as Opciones');

        $this->db->where('SIS_USUARIO.id_Grupo = SIS_PERMISOS.id');
        $this->db->where('SIS_USUARIO.id_Empresa = SIS_EMP.id');


        if ($arr['estatus'])
            $this->db->where('SIS_USUARIO.Estatus', $arr['estatus']);

        
        
        if (!empty($likes))
            $this->db->where($likes);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);



        $query = $this->db->get('SIS_USUARIO, SIS_PERMISOS, SIS_EMP');
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }
public function get_usuarios_sel($activos) {
        $this->db->select('id,Descripcion AS val');

        if ($activos)
            $this->db->where('Estatus', $activos);

        $query = $this->db->get('SIS_PERMISOS');
        return $query->result_array();
    }


    public function edit_usuarios() {
        $res = array();
        $data = $this->getInputFromAngular();         
        $usuario =array();
        


        $this->db->select('Clave');
        $this->db->where('Usuario',$data['Usuario']);
        $result= $this->db->get('SIS_USUARIO');

        $passw=$result->row();


        if(($data['Clave'])!=" "){
            $usuario = [
            'Nombre' => $data['Nombre'],
            'Apellido' => $data['Apellido'],
            'Estatus' => $data['Estatus'],
            'Clave'=>$data['Clave'] ,
            'Correo'=>$data['Correo'], 
            'Telefono'=>$data['Telefono'],
            'id_Grupo'=>$data['id_Grupo'],
             'id_Empresa'=>$data['id_Empresa']                 
            ];
        }else{
            $usuario = [
            'Nombre' => $data['Nombre'],
            'Apellido' => $data['Apellido'],
            'Estatus' => $data['Estatus'],
           'Clave'=>$data['Clave'] ,
            'Correo'=>$data['Correo'], 
            'Telefono'=>$data['Telefono'],
            'id_Grupo'=>$data['id_Grupo'],
             'id_Empresa'=>$data['id_Empresa']                
            ];
        }
               
        $this->db->where('Usuario', $data['Usuario']);
        

        if ($this->db->update('SIS_USUARIO', $usuario)) {
            $res['estatus'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['estatus'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }
        return $res;
    }
   
    public function insert_usuario() {
        $arr = $this->getInputFromAngular();
        $arr['id_Usuario_registro']=$this->session->userdata('id');
        $res = array();
        $this->db->select('Usuario');
        $this->db->where('Usuario', $arr['Usuario']);
        $query1 = $this->db->get('SIS_USUARIO');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El usuario ya esta registrado';
            return $res;
        }

        //$this->db->set('fecha_registro', 'GETDATE()', FALSE);

        if ($this->db->insert('SIS_USUARIO', $arr)) {
            $res['estatus'] = 1;
            $res['mensaje'] = 'Registrado con Exito';
        } else {
            $res['estatus'] = 0;
            $res['mensaje'] = 'Error Desconocido';
        }

        return $res;
    }

  




}

?>