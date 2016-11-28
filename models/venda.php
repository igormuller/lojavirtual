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
        
        if ($pg = '1'){ //cortesia 
            $status = '2'; //compra aprovada
            $link = BASE_URL."/carrinho/obrigado";
        } else {
            
        }
        
        $sql = "INSERT INTO venda SET "
                . "id_usuario = $uid,"
                . "endereco = '$endereco',"
                . "valor = '$valor',"
                . "forma_pg = $pg,"
                . "status_pg = $status,"
                . "pg_link = '$link'";
        
        $this->db->query($sql);
        $id_venda = $this->db->lastInsertId();
        
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
