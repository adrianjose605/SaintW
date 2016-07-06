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
	    public function get_serie_sucursal($id=false){
	    	$aux=array();$qry="";
	    	for($i=1; $i<=12; $i++){
	    	$this->db->select('SUM(dbo.SAA_LIB.Monto) as Monto ');
	    		if($i<10){
	    			$qry=('dbo.SAA_LIB.Fecha BETWEEN 20160'.$i.'01 AND 20160'.$i.'31');
	    		}else{
	    			$qry=(' dbo.SAA_LIB.Fecha BETWEEN 2016'.$i.'01 AND 2016'.$i.'31');
	    		}
	    		if($id){
	    		$this->db->where('CodSucu',$id);		
	    		}
	    	$this->db->where($qry);

	    	$this->db->where("TipoFac = 'A'");
	    	//$this->db->where("Fecha BETWEEN 20160201 AND 20160231");
	    	$this->db->where("CodEmp", $this->session->userdata('empresa'));
	    	//$this->db->limit('12');
	    	$query = $this->db->get('dbo.SAA_LIB');
		     $result=$query->result_array();
		     		     
		    foreach ($query->result() as $fila)
			{$aux[$i-1]=array('name' =>'Ventas ' ,'y'=> $fila->Monto*1);
			switch ($i) {
				case 1:
					$aux1[$i-1]='Ene';
					break;				
				case 2:
					$aux1[$i-1]='Feb';
					break;
				case 3:
					$aux1[$i-1]='Marz';
					break;
				case 4:
					$aux1[$i-1]='Abr';
					break;
				case 5:
					$aux1[$i-1]='May';
					break;
				case 6:
					$aux1[$i-1]='Jun';
					break;
				case 7:
					$aux1[$i-1]='Jul';
					break;
				case 8:
					$aux1[$i-1]='Ago';
					break;
				case 9:
					$aux1[$i-1]='Sep';
					break;
				case 10:
					$aux1[$i-1]='Oct';
					break;
				case 11:
					$aux1[$i-1]='Nov';
					break;
				case 12:
					$aux1[$i-1]='Dic';
					break;
			}
			 
			}

		}
		$r[0]=$aux;
		$r[1]=$aux1;
			return $r;
		
	    }






	    public function get_barra_sucursal(){
	    	$aux=array();$i=0;	    	
	    	$this->db->select('SUM(dbo.SAA_LIB.Monto) as Monto ,dbo.SAA_LIB.CodSucu');
	    		
	    	//$this->db->where('dbo.SASUCU.CodSucu','dbo.SAA_LIB.CodSucu');
	    	$this->db->where("dbo.SAA_LIB.TipoFac = 'A'");
	    	$this->db->where("dbo.SAA_LIB.CodEmp", $this->session->userdata('empresa'));
	    	$this->db->group_by("dbo.SAA_LIB.CodSucu");
	    	
	    	$query = $this->db->get("dbo.SAA_LIB");
		     $result=$query->result_array();
		     		     
		    foreach ($query->result() as $fila){
		    	$this->db->select('SASUCU.Descrip');
		    	$this->db->where('SASUCU.CodSucu',$fila->CodSucu);
		    	$query2 = $this->db->get("dbo.SASUCU");
		    		foreach ($query2->result() as $fila2){
		    	$aux[$i]=array('name' =>$fila2->Descrip,'y'=> $fila->Monto*1,'drilldown'=>$fila2->Descrip);
					
				}$i++;
			}

		
		
			return $aux;
		
	    }

	    public function get_barra_sucursal_mes(){
	    	$r=array();
	    	$this->db->select('SASUCU.Descrip, SASUCU.CodSucu');
		    $this->db->where("dbo.SASUCU.CodEmp", $this->session->userdata('empresa'));
		    $query = $this->db->get("dbo.SASUCU");
		    foreach ($query->result() as $fila){
		    	
		    	$qry='
  (select SUM(SAA_LIB.Monto) As Ene from SAA_LIB WHERE SAA_LIB.Fecha>20160100 and SAA_LIB.Fecha<=20160131 and SAA_LIB.CodEmp='.$this->session->userdata('empresa').' and SAA_LIB.CodSucu='.$fila->CodSucu.') AS Ene
, (select SUM(SAA_LIB.Monto) As Feb from SAA_LIB WHERE SAA_LIB.Fecha>20160200 and SAA_LIB.Fecha<=20160231 and SAA_LIB.CodEmp='.$this->session->userdata('empresa').' and SAA_LIB.CodSucu='.$fila->CodSucu.') AS Feb
, (select SUM(SAA_LIB.Monto) As Mar from SAA_LIB WHERE SAA_LIB.Fecha>20160300 and SAA_LIB.Fecha<=20160331 and SAA_LIB.CodEmp='.$this->session->userdata('empresa').' and SAA_LIB.CodSucu='.$fila->CodSucu.') AS Mar
, (select SUM(SAA_LIB.Monto) As Abr from SAA_LIB WHERE SAA_LIB.Fecha>20160400 and SAA_LIB.Fecha<=20160431 and SAA_LIB.CodEmp='.$this->session->userdata('empresa').' and SAA_LIB.CodSucu='.$fila->CodSucu.') AS Abr
, (select SUM(SAA_LIB.Monto) As May from SAA_LIB WHERE SAA_LIB.Fecha>20160500 and SAA_LIB.Fecha<=20160531 and SAA_LIB.CodEmp='.$this->session->userdata('empresa').' and SAA_LIB.CodSucu='.$fila->CodSucu.') AS May
, (select SUM(SAA_LIB.Monto) As Jun from SAA_LIB WHERE SAA_LIB.Fecha>20160600 and SAA_LIB.Fecha<=20160631 and SAA_LIB.CodEmp='.$this->session->userdata('empresa').' and SAA_LIB.CodSucu='.$fila->CodSucu.') AS Jun
, (select SUM(SAA_LIB.Monto) As Jul from SAA_LIB WHERE SAA_LIB.Fecha>20160700 and SAA_LIB.Fecha<=20160731 and SAA_LIB.CodEmp='.$this->session->userdata('empresa').' and SAA_LIB.CodSucu='.$fila->CodSucu.') AS Jul
, (select SUM(SAA_LIB.Monto) As Ago from SAA_LIB WHERE SAA_LIB.Fecha>20160800 and SAA_LIB.Fecha<=20160831 and SAA_LIB.CodEmp='.$this->session->userdata('empresa').' and SAA_LIB.CodSucu='.$fila->CodSucu.') AS Ago
, (select SUM(SAA_LIB.Monto) As Sep from SAA_LIB WHERE SAA_LIB.Fecha>20160900 and SAA_LIB.Fecha<=20160931 and SAA_LIB.CodEmp='.$this->session->userdata('empresa').' and SAA_LIB.CodSucu='.$fila->CodSucu.') AS Sep
, (select SUM(SAA_LIB.Monto) As Oct from SAA_LIB WHERE SAA_LIB.Fecha>20161000 and SAA_LIB.Fecha<=20161031 and SAA_LIB.CodEmp='.$this->session->userdata('empresa').' and SAA_LIB.CodSucu='.$fila->CodSucu.') AS Oct
, (select SUM(SAA_LIB.Monto) As Nov from SAA_LIB WHERE SAA_LIB.Fecha>20161100 and SAA_LIB.Fecha<=20161131 and SAA_LIB.CodEmp='.$this->session->userdata('empresa').' and SAA_LIB.CodSucu='.$fila->CodSucu.') AS Nov
, (select SUM(SAA_LIB.Monto) As Dic from SAA_LIB WHERE SAA_LIB.Fecha>20161200 and SAA_LIB.Fecha<=20161231 and SAA_LIB.CodEmp='.$this->session->userdata('empresa').' and SAA_LIB.CodSucu='.$fila->CodSucu.') AS Dic';
	    	
		    	$this->db->select($qry);
		    	//$this->db->where("dbo.SAA_LIB.CodEmp", $this->session->userdata('empresa'));
		    	//$this->db->where("dbo.SAA_LIB.CodSucu", $fila->CodSucu);
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