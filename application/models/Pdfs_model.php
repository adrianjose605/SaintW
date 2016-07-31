<?php
class Pdfs_model extends CI_Model
{
function __construct()
{
parent::__construct();
    $this->load->database();
}
//obtenemos las provincias para cargar en el select
function getProvincias()
{
$query = $this->db->get("provincias_es");
if($query->num_rows()>0)
{
foreach ($query->result() as $fila)
{
$data[] = $fila;
}
return $data;
}
}


    //obtenemos las localidades dependiendo de la provincia escogida
    function getProvinciasSeleccionadas($provincia)
{
     $this->db->select("l.provincia,l.localidad,l.id,p.provincia");
     $this->db->from("localidades_es l, provincias_es p");
     $this->db->where("l.provincia = p.id and p.id = ".$provincia);
      $query=$this->db->get();

        $data["localidades"]=array();
    if($query->num_rows()>0)
    {
foreach ($query->result() as $fila)
{
$data["localidades"][$fila->id]["l.provincia"] = $fila->provincia;
$data["localidades"][$fila->id]["l.localidad"] = $fila->localidad;
$data["localidades"][$fila->id]["l.id"] = $fila->id;
            $data["localidades"][$fila->id]["p.provincia"] = $fila->provincia;
}
return $data["localidades"];
     }
}    
}
/*pdf_model.php
* el modelo
*/