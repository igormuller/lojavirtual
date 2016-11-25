<?php

class Pagamento extends model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getPagamantos() {
        $array = array();
        
        $sql = "SELECT * FROM pagamento";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }
}