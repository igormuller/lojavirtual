<?php

class Categoria extends model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getCategorias() {
        $dados = array();
        
        $sql = "SELECT * FROM categoria";
        $sql = $this->db->query($sql);
        
        if ($sql->rowCount() > 0){
            $dados = $sql->fetchAll();
        }
        return $dados;
    }
    
    public function getNome($id) {
        $sql = "SELECT titulo FROM categoria WHERE id = '$id'";
        $sql = $this->db->query($sql);
        
        $nome = '';
        if ($sql->rowCount() > 0){
            $sql = $sql->fetch();
            $nome = $sql['titulo'];
        }
        return $nome;
        
    }
    
}
