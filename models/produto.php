<?php

class Produto extends model {
    
    public function listProdutos($limit = 0) {
        $sql = "SELECT * FROM produto";
        
        if ($limit > 0){
            $sql .= " LIMIT ".$limit;
        }
        $sql = $this->db->query($sql);
        
        $produtos = array();
        
        if ($sql->rowCount() > 0){
            $produtos = $sql->fetchAll();
        }
        return $produtos;
    }
    
    public function getProdutoCategoria($cat) {
        $cat = addslashes($cat);
        $produtos = array();
        $sql = "SELECT * FROM produto WHERE id_categoria = '$cat'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0){
            $produtos = $sql->fetchAll();
        }
        
        return $produtos;
    }
    
}