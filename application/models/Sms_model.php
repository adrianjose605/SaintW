<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Sms_model extends CI_Model{
		
		public function __construct(){
        	$this->load->database();
		}


		public function envio($estatus,$msg){
			if($estatus['status']="200"){
				$estatus=1;
			}else{
				$estatus=0;
			}
			$mensaje = ['mensaje' => $msg,
        'id_Emp' => $this->session->userdata('empresa'),
        'id_usuario' => $this->session->userdata('id'),
        'estatus' => $estatus
        ];

		 $r=$this->db->insert('mensaje',$mensaje);
		 return $r;
		}
		public function delete($id){
		//	echo json_encode($id);
		$r=false;
		for($i=0;$i<count($id);$i++){
		$this->db->where('id',$id[$i]['id']);
		$r=$this->db->delete('mensaje');
		}
		 return $r;
		}

		public function get_all($aux) {
		   	//echo "Prueba ".$aux;
		    $this->db->where('CodSucu ='.$aux);
		    $this->db->limit(10);
		    $query = $this->db->get('saa_lib');
		    //var_dump($query->result_array());
		    return $query->result_array();
	    }

	  

	   	     //Total Credito por sucursal
	    public function clientes(){
	    	$aux=array();$qry="";
	    	
	    	$this->db->select("Descrip,  Telef");
	    	$this->db->from('saclie');	    	
	    	$this->db->where("saclie.CodEmp", $this->session->userdata('empresa'));
	    	//$this->db->limit("100");
	    	
	    	$query = $this->db->get();
		     $result=$query->result_array();
		     	$i=0;	     
		    foreach ($query->result() as $fila)
			{
				if($fila->Telef!=null && substr($fila->Telef,0,2)=='04' && (strlen($fila->Telef)==11 || strlen($fila->Telef)==12)){
			 	$aux[$i]=array('name' =>$fila->Descrip,'n'=> $fila->Telef,'img'=>'public/img/persona.png','selected'=>false);
				$i++;
				}
			}
			
			return $aux;
		
	    }


 public function generar_json_tabla($offset, $cantidad, $order, $type) {
        $arr = $this->getInputFromAngular();
        $params = preg_split('#\s+#', trim($arr['query']));
        $w = false;
        if ($arr['estatus'])
            $this->db->where('Activo', $arr['estatus']);
        $likes = '';


        for ($i = 0; $i != count($params); $i++) {
            if ($i == 0)
                $likes.="(saclie.CodClie  LIKE '%" . $params[$i] . "%' OR saclie.Descrip LIKE '%" . $params[$i] . "%' ";
            else
                $likes.=" OR (saclie.CodClie  LIKE '%" . $params[$i] . "%' OR saclie.Descrip LIKE '%" . $params[$i] . "%')";
            if ($i + 1 == count($params))
                $likes.=")";
        }

        if (!empty($likes))
            $this->db->where($likes);

            


        $this->db->select('COUNT(1) AS cantidad');


        $query1 = $this->db->get('saclie');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('saclie.Descrip Descripcion, Telef Telefono, saclie.CodClie as Marcar');

       
        if ($arr['estatus'])
            $this->db->where('saclie.Activo', $arr['estatus']);

        $this->db->where("Telef LIKE '04%'");
        
        
        $this->db->where("CodEmp",$this->session->userdata('empresa'));
        if (!empty($likes))
            $this->db->where($likes);

        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);
         $query = $this->db->get('saclie');

         
		     	$i=0;	     
		    foreach ($query->result() as $fila){
		   
				if (strlen($fila->Telefono)==11){
			 	$aux[$i]=array('Descripcion' =>$fila->Descripcion,'Telefono' =>$fila->Telefono,'selected'=>false);
				$i++;
				}
			}

       
        $respuesta['cantidad'] = $query1->result_array();
        $respuesta['resultado'] =$aux;
        $respuesta['meta'] = $query->list_fields();
        return $respuesta;
    }



  public function recent(){
	    	$aux=array();$qry="";
	    	
	    	$this->db->select("mensaje,  estatus, fecha_envio, id");
	    	$this->db->from('mensaje');	    	
	    	$this->db->where("mensaje.id_Emp", $this->session->userdata('empresa'));
	    	
	    	
	    	$query = $this->db->get();
		     $result=$query->result_array();
		     	$i=0;	     
		    foreach ($query->result() as $fila)
			{
			
			 	$aux[$i]=array('id'=> $fila->id,'prev' =>$fila->mensaje,'estatus'=> $fila->estatus,'selected'=>false, 'fecha'=> $fila->fecha_envio);
				$i++;
				
			}
			
			

		
		
			return $aux;
		
	    }





	    public function get_barra_sucursal(){
	    	$aux=array();$i=0;	    	
	    	$this->db->select('SUM(saa_lib.Monto) as Monto ,saa_lib.CodSucu');
	    		
	    	//$this->db->where('sasucu.CodSucu','saa_lib.CodSucu');
	    	$this->db->where("saa_lib.TipoFac = 'A'");
	    	$this->db->where("saa_lib.CodEmp", $this->session->userdata('empresa'));
	    	$this->db->group_by("saa_lib.CodSucu");
	    	
	    	$query = $this->db->get("saa_lib");
		     $result=$query->result_array();
		     		     
		    foreach ($query->result() as $fila){
		    	$this->db->select('sasucu.Descrip');
		    	$this->db->where('sasucu.CodSucu',$fila->CodSucu);
		    	$query2 = $this->db->get("sasucu");
		    		foreach ($query2->result() as $fila2){
		    	$aux[$i]=array('name' =>$fila2->Descrip,'y'=> $fila->Monto*1,'drilldown'=>$fila2->Descrip);
					
				}$i++;
			}

		
		
			return $aux;
		
	    }

	    public function get_barra_sucursal_mes(){
	    	$r=array();
	    	$this->db->select('sasucu.Descrip, sasucu.CodSucu');
		    $this->db->where("sasucu.CodEmp", $this->session->userdata('empresa'));
		    $query = $this->db->get("sasucu");
		    foreach ($query->result() as $fila){
		    	
		    	$qry='
  (select SUM(saa_lib.Monto) As Ene from saa_lib WHERE saa_lib.Fecha>20160100 and saa_lib.Fecha<=20160131 and saa_lib.CodEmp='.$this->session->userdata('empresa').' and saa_lib.CodSucu='.$fila->CodSucu.') AS Ene
, (select SUM(saa_lib.Monto) As Feb from saa_lib WHERE saa_lib.Fecha>20160200 and saa_lib.Fecha<=20160231 and saa_lib.CodEmp='.$this->session->userdata('empresa').' and saa_lib.CodSucu='.$fila->CodSucu.') AS Feb
, (select SUM(saa_lib.Monto) As Mar from saa_lib WHERE saa_lib.Fecha>20160300 and saa_lib.Fecha<=20160331 and saa_lib.CodEmp='.$this->session->userdata('empresa').' and saa_lib.CodSucu='.$fila->CodSucu.') AS Mar
, (select SUM(saa_lib.Monto) As Abr from saa_lib WHERE saa_lib.Fecha>20160400 and saa_lib.Fecha<=20160431 and saa_lib.CodEmp='.$this->session->userdata('empresa').' and saa_lib.CodSucu='.$fila->CodSucu.') AS Abr
, (select SUM(saa_lib.Monto) As May from saa_lib WHERE saa_lib.Fecha>20160500 and saa_lib.Fecha<=20160531 and saa_lib.CodEmp='.$this->session->userdata('empresa').' and saa_lib.CodSucu='.$fila->CodSucu.') AS May
, (select SUM(saa_lib.Monto) As Jun from saa_lib WHERE saa_lib.Fecha>20160600 and saa_lib.Fecha<=20160631 and saa_lib.CodEmp='.$this->session->userdata('empresa').' and saa_lib.CodSucu='.$fila->CodSucu.') AS Jun
, (select SUM(saa_lib.Monto) As Jul from saa_lib WHERE saa_lib.Fecha>20160700 and saa_lib.Fecha<=20160731 and saa_lib.CodEmp='.$this->session->userdata('empresa').' and saa_lib.CodSucu='.$fila->CodSucu.') AS Jul
, (select SUM(saa_lib.Monto) As Ago from saa_lib WHERE saa_lib.Fecha>20160800 and saa_lib.Fecha<=20160831 and saa_lib.CodEmp='.$this->session->userdata('empresa').' and saa_lib.CodSucu='.$fila->CodSucu.') AS Ago
, (select SUM(saa_lib.Monto) As Sep from saa_lib WHERE saa_lib.Fecha>20160900 and saa_lib.Fecha<=20160931 and saa_lib.CodEmp='.$this->session->userdata('empresa').' and saa_lib.CodSucu='.$fila->CodSucu.') AS Sep
, (select SUM(saa_lib.Monto) As Oct from saa_lib WHERE saa_lib.Fecha>20161000 and saa_lib.Fecha<=20161031 and saa_lib.CodEmp='.$this->session->userdata('empresa').' and saa_lib.CodSucu='.$fila->CodSucu.') AS Oct
, (select SUM(saa_lib.Monto) As Nov from saa_lib WHERE saa_lib.Fecha>20161100 and saa_lib.Fecha<=20161131 and saa_lib.CodEmp='.$this->session->userdata('empresa').' and saa_lib.CodSucu='.$fila->CodSucu.') AS Nov
, (select SUM(saa_lib.Monto) As Dic from saa_lib WHERE saa_lib.Fecha>20161200 and saa_lib.Fecha<=20161231 and saa_lib.CodEmp='.$this->session->userdata('empresa').' and saa_lib.CodSucu='.$fila->CodSucu.') AS Dic';
	    	
		    	$this->db->select($qry);
		    	//$this->db->where("saa_lib.CodEmp", $this->session->userdata('empresa'));
		    	//$this->db->where("saa_lib.CodSucu", $fila->CodSucu);
		    	//$this->db->limit("12");
		    	$query2 = $this->db->get();
		    	foreach ($query2->result() as $fila2){
		    		$mes2=[['Ene',$fila2->Ene*1],['Feb',$fila2->Feb*1],['Mar',$fila2->Mar*1],['Abr',$fila2->Abr*1],['May',$fila2->May*1],['Jun',$fila2->Jun*1],['Jul',$fila2->Jul*1],['Ago',$fila2->Ago*1],['Sep',$fila2->Sep*1],['Oct',$fila2->Oct*1],['Nov',$fila2->Nov*1],['Dic',$fila2->Dic*1]];
  		
		    	}
		    	
		    	$r[]=array('Name' =>$fila->Descrip , 'id'=>$fila->Descrip, 'data'=>$mes2 );//,array('Name' => '', 'id'=>'', 'data'=>'' ));
		    }
			return $r;
		
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


        $query1 = $this->db->get('safact');
        $respuesta['cantidad'] = $query1->result_array();

        $this->db->select('Descrip,TipoFac, CodClie,NroCtrol,Monto,MtoTax, FechaE,  NroCtrol AS Opciones');
       
        if (!empty($likes))
            $this->db->where($likes);


        $this->db->limit($cantidad, $offset);
        $this->db->order_by($order, $type);

        $query = $this->db->get('safact');
        $respuesta['resultado'] = $query->result_array();
        $respuesta['meta'] = $query->list_fields();
        

        return $respuesta;
    }
		
	}

 ?>