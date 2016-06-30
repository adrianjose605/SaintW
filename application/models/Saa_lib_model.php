<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Saa_lib_model extends CI_Model{
		
		public function __construct(){
        	$this->load->database();
		}

		public function get_all($aux) {
		   	//echo "Prueba ".$aux;
		    $this->db->where('CodSucu ='.$aux);
		    $this->db->limit(10);
		    $query = $this->db->get('saa_lib');
		    //var_dump($query->result_array());
		    return $query->result_array();
	    }

	    //Ventas Diarias
	    public function get_ventas_diarias($mes){

	    }

	    //Total Credito por sucursal
	    public function get_credito_sucursal(){
	    	$this->db->select('TipoFac, SUM(Credito) as totalCredito');
	    	$this->db->where("TipoFac = 'B'");
	    	$this->db->group_by('TipoFac');
	    	$query = $this->db->get('saa_lib');
		    return $query->result_array();
	    } 
	     //Total Credito por sucursal
	    public function get_serie_sucursal(){
	    	$this->db->select('Monto');
	    	$this->db->where("TipoFac = 'A'");
	    	$this->db->where("CodEmp", $this->session->userdata('empresa'));
	    	$this->db->limit('12');
	    	$query = $this->db->get('saa_lib');
		     $result=$query->result_array();
		     $aux=array();
		     $i=0;
		    foreach ($query->result() as $fila)
			{$aux[$i]=$fila->Monto*1;
			$i++;
			}
			return $aux;
		/*
		     for($i=0; $i<count($result);$i++){
		     	$aux[$i]=$result['Monto'];
		     }*/
	    }

	    //Total facturado
	    public function get_facturado_sucursal(){
	    	$this->db->select('TipoFac, SUM(Monto) as totalFacturado');
	    	$this->db->where("TipoFac = 'A'");
	    	$this->db->group_by('TipoFac');
	    	$query = $this->db->get('saa_lib');
		    return $query->result_array();
	    }

	    //Total facturas realizadas
	    public function get_facturas_sucursal(){
	    	$this->db->select('COUNT(*) as total');
	    	$this->db->where("TipoFac = 'A'");
	    	$query = $this->db->get('saa_lib');
		    return $query->result_array();
	    }







	    public function generar_json_tabla_facturas($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
      /*  if ($arr['estatus'])
            */
        $likes = '';

        $this->db->where('CodEmp',$this->session->userdata('empresa'));
        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="( Descrip LIKE '%" . $params[$i] . "%'";
            else
                $likes.="OR Descrip LIKE '%" . $params[$i] . "%'";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('dbo.SAFACT');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('Descrip,TipoFac, CodClie,NroCtrol,Monto,MtoTax, FechaE,  NroCtrol AS Opciones');
       
        if (!empty($likes))
            $this->db->where($likes);


        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);

        $query = $this->db->get('dbo.SAFACT');
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        

        return $respuesta;
    }
		
	}

 ?>