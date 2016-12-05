<?php

class Categoria extends model {
    
    public function getCategorias() {
        $array = array ();
        
        $sql = "SELECT * FROM categoria";
        $sql = $this->db->query($sql);
        
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
        
    }
    
    public function removeCategori($id) {
        
        $id = addslashes($id);
        $sql = "DELETE FROM categoria WHERE id = '$id'";
        $this->db->query($sql);
        
        $sql = "DELETE FROM produto WHERE id_categoria = '$id'";
        $this->db->query($sql);
    }
    
    public function addCategoria($titulo) {
        if (!empty($titulo)) {
            $titulo = addslashes($titulo);
            $sql = "INSERT INTO categoria SET titulo = '$titulo'";
            $this->db->query($sql);
        }
    }
    
    public function editCategoria($titulo, $id) {
        if (!empty($titulo) && !empty($id)) {
            $titulo = addslashes($titulo);
            $id = addslashes($id);
            
            $sql = "UPDATE categoria SET titulo = '$titulo' WHERE id = '$id'";
            $this->db->query($sql);
        }
    }
    
    public function getCategoria($id) {
        $array = array();
        $id = addslashes($id);
        $sql = "SELECT * FROM categoria WHERE id = '$id'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0){
            $array = $sql->fetch();
        }        
        return $array;
    }
}
