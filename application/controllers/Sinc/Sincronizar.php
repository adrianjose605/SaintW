<?php

class Sincronizar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sincronizar_model');
    }    
    

     public function get_saclie($id = false) {
        $res = array();
        $result = $this->Sincronizar_model->get_saclie($id);
        foreach ($result as $row) {
            $res[] = $row;
        }
        echo json_encode($res);
    }

    public function set_saclie() {
        //$post=json_decode(file_get_contents('php://input'));
        $res = array();
        //print_r($post);
        echo("asdasd");
        $qry="
        INSERT INTO `SACLIE` VALUES ('.', '.', '.', '0', '1', '', '.', '.', '.', '.', '0', '0', '0', '62352648', '.', '.', '.', '.', '.', '2013-11-15 10:56:33.133', null, null, null, null, '0', '3', '.', '0', '0', '.0000', '0', '0', '0', '0', '.0000', '.0000', '.0000', '2016-03-15 09:31:53.000', '-20134.2800', '000497', null, '.0000', null, '20134.2800', '.0000', '.0000', '.0000', '.0000', null, '0','3');




        ";






        $result = $this->Sincronizar_model->insert_saclie($qry);
        echo $result;
        //foreach ($result as $row) {
        //  $res[] = $row;
        //}
        //echo json_encode($res);
    }



    
}
?>