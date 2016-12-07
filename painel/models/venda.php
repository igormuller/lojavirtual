<?php

class Venda extends model {
    
    public function getVendas() {
        $array = array();
        $sql = "SELECT "
                . "venda.id, "
                . "usuario.nome as cliente, "
                . "venda.valor, "
                . "pagamento.nome as pgto, "
                . "venda.status_pg "
                . "FROM venda "
                . "LEFT JOIN usuario ON usuario.id = venda.id_usuario "
                . "LEFT JOIN pagamento on pagamento.id = venda.forma_pg";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function getVenda($id) {
        $array = array();
        
        $sql = "SELECT "
                . "venda.id, "
                . "usuario.nome as cliente, "
                . "venda.valor, "
                . "pagamento.nome as pgto, "
                . "venda.status_pg, "
                . "venda.endereco, "
                . "venda.pg_link "
                . "FROM venda "
                . "LEFT JOIN usuario ON usuario.id = venda.id_usuario "
                . "LEFT JOIN pagamento on pagamento.id = venda.forma_pg "
                . "WHERE venda.id = '$id'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        
        return $array;
        
    }
    
    public function getProdutosVenda($id) {
        $array = array();
        $sql = "SELECT id_produto, quantidade FROM venda_produto WHERE id_venda = '$id'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $prods = $sql->fetchAll();
            $p = new Produto();
            foreach ($prods as $prod) {
                $pinfo = $p->getProduto($prod['id_produto']);
                $array[] = array(
                    'id' => $pinfo['id'],
                    'quantidade' => $prod['quantidade'],
                    'nome' => $pinfo['nome'],
                    'imagem' => $pinfo['imagem'],
                    'preco' => $pinfo['preco']
                );
            }
        }
        return $array;
    }
    
}

