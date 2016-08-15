<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }


    
////////////////////Usuarios/////////////////////////////////////////////////////////////////
    
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



    public function get_Empresas($id) {
        $this->db->select('Rif, Nombre,Descripcion, fecha_registro,Estatus,id, Direccion, Telefono');
        $this->db->where('sis_emp.id', $id);
        $query = $this->db->get(' sis_emp');
        return $query->result_array();
    }

    
 
 
    public function generar_json_tabla_principal($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('Estatus', $arr['estatus']);
        $likes = '';


        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(Nombre LIKE '%".$params[$i]."%' OR Rif LIKE '%" . $params[$i] . "%'";
            else
                $likes.=" OR Nombre LIKE '%".$params[$i]."%' OR Rif LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('sis_emp');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('Rif, sis_emp.Nombre,Descripcion ,Telefono ,sis_emp.Fecha_registro , sis_emp.Estatus, sis_emp.id as Opciones');

        //$this->db->where('sis_usuario.id_Grupo = SIS_PERMISOS.id');
        //$this->db->where('sis_usuario.id_Empresa = sis_emp.id');


        if ($arr['estatus'])
            $this->db->where('sis_emp.Estatus', $arr['estatus']);

        
        
        if (!empty($likes))
            $this->db->where($likes);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);



        $query = $this->db->get('sis_emp');
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }
public function get_empresas_sel($activos) {
        $this->db->select('id,Nombre AS val');

        if ($activos)
            $this->db->where('Estatus', $activos);

        if ($this->session->userdata('empresa')!='0') 
             $this->db->where('id', $this->session->userdata('empresa'));
        

        $query = $this->db->get('sis_emp');
        return $query->result_array();
    }


    public function edit_empresas() {
        $res = array();
        $data = $this->getInputFromAngular();         
        $empr =array();
        
        
            $empr = [
            'Nombre' => $data['Nombre'],
            'Descripcion' => $data['Descripcion'],
            'Estatus' => $data['Estatus'],
            'Rif'=>$data['Rif'] ,
            'Telefono'=>$data['Telefono'],
             'Descripcion'=>$data['Descripcion']                 
            ];
   
        
              
        $this->db->where('Rif', $data['Rif']);
        

        if ($this->db->update('sis_emp', $empr)) {
            $res['estatus'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['estatus'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }
        return $res;
    }
   
    public function insert_empresa() {
        $arr = $this->getInputFromAngular();
        $arr['id_Usuario_registro']=$this->session->userdata('id');
        $res = array();
        $this->db->select('Rif');
        $this->db->where('Rif', $arr['Rif']);
        $query1 = $this->db->get('sis_emp');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El usuario ya esta registrado';
            return $res;
        }

        //$this->db->set('fecha_registro', 'GETDATE()', FALSE);

        if ($this->db->insert('sis_emp', $arr)) {
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