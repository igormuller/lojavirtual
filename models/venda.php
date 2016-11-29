<?php

class Venda extends model {
    
    public function __construct() {
        parent::__construct();
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
            $status = '2'; //compra aprovada
            $link = BASE_URL."/carrinho/obrigado";
            $this->db->query("UPDATE venda SET status_pg = '$status' WHERE id_venda = '$id_venda'");
            
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
