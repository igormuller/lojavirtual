<?php

class Venda extends model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getPedidoUsuario($id_usuario) {
        $array = array();
        if (!empty($id_usuario)){
            $sql = "SELECT *,(SELECT pagamento.nome FROM pagamento WHERE pagamento.id = venda.forma_pg) as tipo_pg FROM venda WHERE id_usuario = ".$id_usuario;
            $sql = $this->db->query($sql);
            
            if ($sql->rowCount() > 0){
                $array = $sql->fetchAll();
            }
        }
        return $array;
    }
    
    public function getPedido($id_pedido, $id_usuario) {
        $array = array();
        $sql = "SELECT *, (SELECT pagamento.nome FROM pagamento WHERE pagamento.id = venda.forma_pg) as tipo_pg FROM venda WHERE id = '$id_pedido' AND id_usuario = ".$id_usuario;
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
            $array['produtos'] = $this->getProdutosPedido($id_pedido);
        }
        return $array;
    }
    
    public function getProdutosPedido($id_pedido) {
        $array = array();
        $sql = "SELECT "
                . "venda_produto.quantidade,"
                . "venda_produto.id_produto,"
                . "produto.nome,"
                . "produto.imagem,"
                . "produto.preco "
                . "FROM venda_produto"
                . " LEFT JOIN produto ON (venda_produto.id_produto = produto.id)"
                . " WHERE venda_produto.id_venda = '$id_pedido'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }
    
    public function setVenda($uid, $endereco, $valor, $pg, $produtos) {
        
        /*
         * Status da compra
         * 1 - Compra aguardando pagamento
         * 2 - Compra aprovada
         * 3 - Compra cancelada
         */
        $status = '1';
        $link = '';
        
        $sql = "INSERT INTO venda SET "
                . "id_usuario = $uid,"
                . "endereco = '$endereco',"
                . "valor = '$valor',"
                . "forma_pg = $pg,"
                . "status_pg = $status,"
                . "pg_link = '$link'";
        
        $this->db->query($sql);
        $id_venda = $this->db->lastInsertId();
        if ($pg == '1'){ //cortesia 
            $status = 2; //compra aprovada
            $link = BASE_URL."/carrinho/obrigado";
            $this->db->query("UPDATE venda SET status_pg = 2 WHERE id = $id_venda");
            
        } else if ($pg == '2') { //PagSeguro
            require 'libraries/PagSeguroLibrary/PagSeguroLibrary.php';
            
            $paymanetRequest = new PagSeguroPaymentRequest();
            foreach ($produtos as $produto) {
                $paymanetRequest->addItem($produto['id'], $produto['nome'], 1, $produto['preco']);
            }
            $paymanetRequest->setCurrency("BRL");
            $paymanetRequest->setReference($id_venda);
            $paymanetRequest->setRedirectURL("http://lojavirtual.pc/carrinho/obrigado");
            $paymanetRequest->addParameter("notificationURL", "http://lojavirtual.pc/carrinho/notificacao");
            
            try {
                $cred = PagSeguroConfig::getAccountCredentials();
                $link = $paymanetRequest->register($cred);
            } catch (PagSeguroServiceException $e) {
                $e->getMessage();
            }
            
        }
        
        foreach ($produtos as $produto) {
            
            $sql = "INSERT INTO venda_produto SET "
                    . "id_venda = $id_venda,"
                    . "id_produto = ".$produto['id'].","
                    . "quantidade = 1";
            $this->db->query($sql);
            
        }
        
        unset($_SESSION['carrinho']);
        return $link;
    }
}
