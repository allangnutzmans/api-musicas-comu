<?php
namespace api\methodsControllers;
use api\mainController\mainController;
class GetMethod extends mainController {

     public function ReadAll(){
             $data = $this->db->QUERY_EXE('SELECT * FROM songs');
             $this->response($data);
     }

     public function ReadById($id){
             $data = $this->db->QUERY_EXE("SELECT * FROM songs WHERE id =" . $id);
             $this->response($data);
     }

 }