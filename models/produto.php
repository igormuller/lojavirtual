<?php

class Produto extends model {
    
    public function __construct() {
        parent::__construct();
    }
    
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
    
    public function getProdutoId($id) {
        $prod = array();
        $sql = "SELECT * FROM produto WHERE id = '$id'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0){
            $prod = $sql->fetch();
        }
        return $prod;
    }
    
    public function getProdutosArray($produtos) {
        $dados = array();
        $sql = "SELECT * FROM produto WHERE id IN (".implode(",", $produtos).")";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0){
            $dados = $sql->fetchAll();
        }
        return $dados;
        
    }
    
}