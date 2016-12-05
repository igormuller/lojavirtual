<?php

class Produto extends model {
    
    public function getProdutos($offset, $limit) {
        $array = array();
        $sql = "SELECT *, (SELECT categoria.titulo FROM categoria WHERE categoria.id = produto.id_categoria) as categoria FROM produto LIMIT $offset,$limit";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getTotalProdutos() {
        $total = 0;
        $sql = "SELECT COUNT(*) as c FROM produto";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $total = $sql->fetch();
            $total = $total['c'];
        }
        return $total;
    }
    
    public function inserir($nome, $descricao, $categoria, $preco, $quantidade, $imagem) {
        $sql = "INSERT INTO produto SET "
                . "nome = '$nome',"
                . "id_categoria = '$categoria',"
                . "imagem = '$imagem',"
                . "preco = '$preco',"
                . "quantidade = '$quantidade',"
                . "descricao = '$descricao'";
        
        $this->db->query($sql);
        
    }
}

