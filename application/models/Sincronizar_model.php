<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sincronizar_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }


    public function get_saclie($id) {
        $this->db->select('*');
        $this->db->where('CodEmp', $id);
        $query = $this->db->get('saclie');
        return $query->result_array();
    }
    public function insert_saclie($qry) {
        $query =$this->db->query($qry);
        
        return $query;
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
        $this->db->select('SACLIE.Descrip , SACLIE.Direc1 ,Telef ,Email , SACLIE.Activo , SACLIE.CodClie');
        $this->db->where('SACLIE.CodClie', $id);
        $query = $this->db->get('SACLIE');
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
                $likes.="(SACLIE.CodClie  LIKE '%" . $params[$i] . "%' OR SACLIE.Descrip LIKE '%" . $params[$i] . "%'";
            else
                $likes.=" OR SACLIE.CodClie  LIKE '%" . $params[$i] . "%' OR SACLIE.Descrip LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('SACLIE');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('SACLIE.Descrip Descripcion, SACLIE.Direc1 Direccion,Telef Telefono,Email Correo , SACLIE.Activo Estatus , SACLIE.CodClie as Opciones');

       
        if ($arr['estatus'])
            $this->db->where('SACLIE.Activo', $arr['estatus']);

        
        
        if (!empty($likes))
            $this->db->where($likes);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);



        $query = $this->db->get('SACLIE');
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


    public function edit() {
        $res = array();
        $data = $this->getInputFromAngular();         
        $usuario =array();
        

               
        $this->db->where('CodClie', $data['CodClie']);
        

        if ($this->db->update('SACLIE', $data)) {
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
        $query1 = $this->db->get('SACLIE');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El usuario ya esta registrado';
            return $res;
        }

       

        if ($this->db->insert('SACLIE', $arr)) {
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