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
    
}

