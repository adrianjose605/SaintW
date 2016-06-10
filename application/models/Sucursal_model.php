<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursal_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }


    
////////////////////Usuarios/////////////////////////////////////////////////////////////////
    
   /* public function modificar_usuario() {
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

    }*/

   /* public function consultar() {
        $data = $this->getInputFromAngular();
        $usuario = [];
        $usuario = ['nombre' => $data['nom'],
        'ventas' => $data['p1'],
        'reportes' => $data['p2'],
        'registros' => $data['p3'],
        'clave' => md5($data['pass'])];


        $this->db->insert('usuario_sistema', $usuario);
    }*/

public function get_sucursal_sel($activos) {
        $this->db->select('Descrip , CodSucu as id');
        $this->db->where('CodEmp', $this->session->userdata('empresa'));
        if ($activos)
            $this->db->where('Estatus', $activos);
 

        $query = $this->db->get('dbo.SASUCU');
        return $query->result_array();
    }


    public function get_Sucursal($id) {
        $this->db->select('Descrip,Estatus,CodSucu, Direccion, Telefono');
        $this->db->where('dbo.SASUCU.CodSucu', $id);
        $query = $this->db->get(' dbo.SASUCU');
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
                $likes.="(Descrip LIKE '%".$params[$i]."%' OR Direccion LIKE '%" . $params[$i] . "%'";
            else
                $likes.=" OR Descrip LIKE '%".$params[$i]."%' OR Direccion '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('dbo.SASUCU');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select(' dbo.SASUCU.Descrip AS Nombre,Direccion,Telefono ,dbo.SASUCU.Estatus, dbo.SASUCU.CodSucu as Opciones');

        //$this->db->where('sch_sistema.SIS_USUARIO.id_Grupo = sch_sistema.SIS_PERMISOS.id');
        //$this->db->where('sch_sistema.SIS_USUARIO.id_Empresa = dbo.SASUCU.id');


        if ($arr['estatus'])
            $this->db->where('dbo.SASUCU.Estatus', $arr['estatus']);

         if ($this->session->userdata('empresa')!='1') 
             $this->db->where('CodEmp', $this->session->userdata('empresa'));
        
        if (!empty($likes))
            $this->db->where($likes);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);



        $query = $this->db->get('dbo.SASUCU');
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }
    
/*public function get_empresas_sel($activos) {
        $this->db->select('id,Nombre AS val');

        if ($activos)
            $this->db->where('Estatus', $activos);

        $query = $this->db->get('dbo.SASUCU');
        return $query->result_array();
    }*/


    public function edit_sucursal() {
        $res = array();
        $data = $this->getInputFromAngular();         
        $empr =array();
        
        
            $empr = [
            'Descrip' => $data['Descrip'],
            'Direccion' => $data['Direccion'],
            'Estatus' => $data['Estatus'],
            'Telefono'=>$data['Telefono']               
            ];
   
        
              
        $this->db->where('CodSucu', $data['CodSucu']);
        

        if ($this->db->update('dbo.SASUCU', $empr)) {
            $res['estatus'] = 1;
            $res['mensaje'] = 'Actualizado con Exito';
        } else {
            $res['estatus'] = 0;
            $res['mensaje'] = 'Ocurrio un Problema al Actualizar';
        }
        return $res;
    }
   
    public function insert_sucursal() {
        $arr = $this->getInputFromAngular();
       // $arr['id_Usuario_registro']=$this->session->userdata('id');
       /* if(isset($arr['CodEmp'])){


        }
        
        $res = array();
        $this->db->select('Rif');
        $this->db->where('Rif', $arr['Rif']);
        $query1 = $this->db->get('sch_sistema.SIS_EMP');
        if ($query1->num_rows() > 0) {
            $res['status'] = 0;
            $res['mensaje'] = 'El usuario ya esta registrado';
            return $res;
        }
*/
        //$this->db->set('fecha_registro', 'GETDATE()', FALSE);
    $this->db->select('CodSucu');
    $query1 = $this->db->get('dbo.SASUCU');
    $aux=0; $mayor=0;
    foreach ($query1->result() as $row){
        $aux= $row->CodSucu;
        if($aux>$mayor){
            $mayor=$aux;
        }

    }
    $arr['CodSucu']=$mayor+1;
    if ($this->db->insert('dbo.SASUCU', $arr)) {
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