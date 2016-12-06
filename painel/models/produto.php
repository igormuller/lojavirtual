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
    
    public function add($nome, $descricao, $categoria, $preco, $quantidade, $imagem) {
        $sql = "INSERT INTO produto SET "
                . "nome = '$nome',"
                . "id_categoria = '$categoria',"
                . "imagem = '$imagem',"
                . "preco = '$preco',"
                . "quantidade = '$quantidade',"
                . "descricao = '$descricao'";
        
        $this->db->query($sql);
    }
    
    public function delete($id) {
        $id = addslashes($id);
        $sql = "SELECT imagem FROM produto WHERE id = '$id'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $img = $sql->fetch();
            $img = $img['imagem'];
            unlink('../assets/images/produto/'.$img);
            
            $this->db->query("DELETE FROM produto WHERE id = '$id'");
        }
    }
    
    public function getProduto($id) {
        $array = array();
        $sql = "SELECT * FROM produto WHERE id = '$id'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }
    
    public function updateProduto($id, $nome, $descricao, $categoria, $quantidade, $preco) {
        $sql = "UPDATE produto SET "
                . "nome = '$nome',"
                . "id_categoria = '$categoria',"
                . "preco = '$preco',"
                . "quantidade = '$quantidade',"
                . "descricao = '$descricao'"
                . " WHERE id = '$id'";
        $this->db->query($sql);
    }
    
    public function updateImagem($id, $imagem) {
        $sql = "UPDATE produto set imagem = '$imagem' WHERE id = '$id'";
        $this->db->query($sql);
    }
}

