<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }


    public function get_Grupo($id) {
        $this->db->select('Descripcion,LibroVentaSucursal, LibroVentaConsolidado,Facturacion,Usuarios,Permisos, Estatus, Empresas, id');
        $this->db->where('id', $id);
        $query = $this->db->get('sis_permisos');
        return $query->result_array();
    }

    






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



    public function get($id) {
        $this->db->select('saclie.Descrip , saclie.Direc1 ,Telef ,Email , saclie.Activo , saclie.CodClie');
        $this->db->where("CodEmp",$this->session->userdata('empresa'));
        $this->db->where('saclie.CodClie', $id);
        $query = $this->db->get('saclie');
        return $query->result_array();
    }


 
    public function generar_json_tabla_principal($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('Activo', $arr['estatus']);
        $likes = '';


        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(saclie.CodClie  LIKE '%" . $params[$i] . "%' OR saclie.Descrip LIKE '%" . $params[$i] . "%'";
            else
                $likes.=" OR saclie.CodClie  LIKE '%" . $params[$i] . "%' OR saclie.Descrip LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('saclie');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('saclie.Descrip Descripcion, saclie.Direc1 Direccion,Telef Telefono,Email Correo , saclie.Activo Estatus , saclie.CodClie as Opciones');

       
        if ($arr['estatus'])
            $this->db->where('saclie.Activo', $arr['estatus']);

        
        $this->db->where("CodEmp",$this->session->userdata('empresa'));
        if (!empty($likes))
            $this->db->where($likes);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);



        $query = $this->db->get('saclie');
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }
public function get_usuarios_sel($activos) {
        $this->db->select('id,Descripcion AS val');

        if ($activos)
            $this->db->where('Estatus', $activos);

        $query = $this->db->get('sis_permisos');
        return $query->result_array();
    }


    public function edit() {
        $res = array();
        $data = $this->getInputFromAngular();         
        $usuario =array();
        

               
        $this->db->where('CodClie', $data['CodClie']);
        

        if ($this->db->update('saclie', $data)) {
            $res['estatus'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['estatus'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }
        return $res;
    }
   
    public function insert() {
        $arr = $this->getInputFromAngular();
       
        $res = array();
        $this->db->select('CodClie');
        $this->db->where('CodClie', $arr['CodClie']);
        $query1 = $this->db->get('saclie');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El usuario ya esta registrado';
            return $res;
        }

       

        if ($this->db->insert('saclie', $arr)) {
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