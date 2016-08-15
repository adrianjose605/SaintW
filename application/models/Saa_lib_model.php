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
	    	$qry="Fecha>= ".date("Y")."0101"." and Fecha<= ".date("Y")."1231";
	    	$this->db->where($qry);
	    	$this->db->where("CodEmp",$this->session->userdata('empresa'));
	    	$this->db->group_by('TipoFac');
	    	$query = $this->db->get('saa_lib');
		    return $query->result_array();
	    } 
	     //Total Credito por sucursal
	    public function get_dispersion_ventas($sucu,$fecha){
	    	//return $fecha;

	    	$this->db->select('saa_lib.Monto, saa_lib.Fecha, saa_lib.Hora');
	    	//$this->db->where("TipoFac = 'B'");
	    	$this->db->where('saa_lib.Fecha',$fecha);
	    	$this->db->where('saa_lib.CodSucu',$sucu);
	    	$this->db->where("saa_lib.CodEmp", $this->session->userdata('empresa'));
	    	$query = $this->db->get('saa_lib');
	    	$aux=array();
	    	 foreach ($query->result() as $fila){
	    	 	$date = new DateTime($fila->Hora);
				$h= $date->format('G:ia');
				if($fila->Hora<100000)
					$hora=substr($fila->Hora,-6,2);
				else
					$hora=substr($fila->Hora,-5,1);
				$min=substr($fila->Hora,-4,2);
				$h1=$hora.'.'.$min;
	    	 	$aux[]=array($h1*1 ,$fila->Monto*1);
	    	 }

	    	 $this->db->select('sasucu.Descrip');
	    	 $this->db->where('sasucu.CodSucu',$sucu);
	    	 $query = $this->db->get('sasucu');
	    	  foreach ($query->result() as $fila){
	    	  	$r[0]="Sucursal ".$fila->Descrip;}
	    	$r[1]=$aux;
	    	return $r;
		    //return $query->result_array();
	    } 



	      public function get_serie_sucursal($id=false,$annio=false){
	      	$aux2=null;
	    	$aux=array();$qry="";
	    	   
	    	for($i=1; $i<=12; $i++){
	    	$this->db->select('SUM(saa_lib.Monto) as Monto ');
	    		if($i<10){
	    			$qry=('saa_lib.Fecha BETWEEN '.$annio.'0'.$i.'01 AND '.$annio.'0'.$i.'31');
	    		}else{
	    			$qry=(' saa_lib.Fecha BETWEEN '.$annio.$i.'01 AND '.$annio.$i.'31');
	    		}
	    		if($id){
	    		$this->db->where('CodSucu',$id);		
	    		}
	    	$this->db->where($qry);

	    	$this->db->where("TipoFac = 'A'");
	    	//$this->db->where("Fecha BETWEEN 20160201 AND 20160231");
	    	$this->db->where("CodEmp", $this->session->userdata('empresa'));
	    	//$this->db->limit('12');
	    	$query = $this->db->get('saa_lib');
		     //$result=$query->result_array();
		     		     
		    foreach ($query->result() as $fila)
			{$aux2[]=$fila->Monto*1;
			
			 
			}
		

		}

		$this->db->select('Descrip');
		$this->db->where('CodSucu',$id);
		$query=$this->db->get('sasucu');
		 foreach ($query->result() as $fila)
			$aux=array('name' =>$fila->Descrip,'data'=>$aux2);

			//echo json_encode($aux);
			//$aux=json_encode($aux);
		//$r[0]=$aux;
		//$r[1]=$aux1;
			return $aux;
		
	    }
	    public function get_lineas_sucursales($annio){
	    		$r=null;$serie=null;
	    		$this->db->where("CodEmp", $this->session->userdata('empresa'));
	    	   	$query1=$this->db->get("sasucu");
	    	   foreach ($query1->result() as $fila1){

	    	   	$serie[]=$this->get_serie_sucursal(''.$fila1->CodSucu,$annio);
	    	   	//echo $serie;
	    	   	//print_r($serie);
	    	   }


	    	   for($i=1; $i<=12;$i++)
	    	   switch ($i) {
				case 1:
					$mes[$i-1]='Ene';
					break;				
				case 2:
					$mes[$i-1]='Feb';
					break;
				case 3:
					$mes[$i-1]='Marz';
					break;
				case 4:
					$mes[$i-1]='Abr';
					break;
				case 5:
					$mes[$i-1]='May';
					break;
				case 6:
					$mes[$i-1]='Jun';
					break;
				case 7:
					$mes[$i-1]='Jul';
					break;
				case 8:
					$mes[$i-1]='Ago';
					break;
				case 9:
					$mes[$i-1]='Sep';
					break;
				case 10:
					$mes[$i-1]='Oct';
					break;
				case 11:
					$mes[$i-1]='Nov';
					break;
				case 12:
					$mes[$i-1]='Dic';
					break;
			}
			//echo json_encode($serie);
			//echo json_encode($mes);
			$r[]=($serie);
			$r[]=($mes);

			return $r;
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
	    	$qry="Fecha>= ".date("Y")."0101"." and Fecha<= ".date("Y")."1231";
	    	$this->db->where($qry);
	    	$this->db->where("CodEmp",$this->session->userdata('empresa'));
	    	$this->db->group_by('TipoFac');
	    	$query = $this->db->get('saa_lib');
		    return $query->result_array();
	    }

	    //Total facturas realizadas
	    public function get_facturas_sucursal(){
	    	$this->db->select('COUNT(*) as total');
	    	$this->db->where("TipoFac = 'A'");
	    	$qry="Fecha>= ".date("Y")."0101"." and Fecha<= ".date("Y")."1231";
	    	$this->db->where($qry);
	    	$this->db->where("CodEmp",$this->session->userdata('empresa'));
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