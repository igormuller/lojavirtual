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
    
    public function setVendaCkTransparente($params, $uid, $sessionId, $prods, $subtotal) {
        require 'libraries/PagSeguroLibrary/PagSeguroLibrary.php';
        
        /*
         * Status da compra
         * 1 - Compra aguardando pagamento
         * 2 - Compra aprovada
         * 3 - Compra cancelada
         */
        $status = '1';
        $link = '';
        $endereco = implode(', ', $params['endereco']);
        $sql = "INSERT INTO venda SET "
                . "id_usuario = $uid,"
                . "endereco = '$endereco',"
                . "valor = '$subtotal',"
                . "forma_pg = '4',"
                . "status_pg = $status,"
                . "pg_link = '$sessionId'";
        
        $this->db->query($sql);
        $id_venda = $this->db->lastInsertId();
        
        foreach ($prods as $prod) {
            
            $sql = "INSERT INTO venda_produto SET "
                    . "id_venda = $id_venda,"
                    . "id_produto = ".$prod['id'].","
                    . "quantidade = 1";
            $this->db->query($sql);
            
        }
        
        unset($_SESSION['carrinho']);
        
        $directPaymentRequest = new PagSeguroDirectPaymentRequest();
        $directPaymentRequest->setPaymentMode('DEFAULT');
        $directPaymentRequest->setPaymentMethod($params['pg_form']);
        $directPaymentRequest->setReference($id_venda);
        $directPaymentRequest->setCurrency("BRL");
        $directPaymentRequest->addParameter("notificationURL", "http://lojavirtual.pc/carrinho/notificacao");
        
        foreach ($prods as $prod) {
            $directPaymentRequest->addItem($prod['id'], $prod['nome'], 1, $prod['preco']);
        }
        
        $directPaymentRequest->setSender(
                $params['nome'],
                $params['email'],
                $params['ddd'],
                $params['telefone'],
                'CPF',
                $params['cpf']                
                );
        
        $directPaymentRequest->setSenderHash($params['shash']);
        $directPaymentRequest->setShippingType(3);
        $directPaymentRequest->setShippingCost(0);
        $directPaymentRequest->setShippingAddress(
                $params['endereco']['cep'],
                $params['endereco']['rua'],
                $params['endereco']['num'],
                $params['endereco']['comp'],
                $params['endereco']['bairro'],
                $params['endereco']['cidade'],
                $params['endereco']['estado'],
                'BRA'
        );
        $billingAddress = new PagSeguroBilling(
                array(
                    'postalCode' => $params['endereco']['cep'],
                    'street' => $params['endereco']['rua'],
                    'number' => $params['endereco']['num'],
                    'complement' => $params['endereco']['comp'],
                    'district' => $params['endereco']['bairro'],
                    'city' => $params['endereco']['cidade'],
                    'state' => $params['endereco']['estado'],
                    'country' => 'BRA'
                )
        );
        
        if ($params['pg_form'] == 'CREDIT_CARD') {
            $parc = explode(';', $params['parc']);
            $installments = new PagSeguroInstallment(
                    '',
                    $parc[0],
                    $parc[1],
                    '',
                    ''
            );
            $creditCardData = new PagSeguroCreditCardCheckout(
                array(
                    'token' => $params['ctoken'],
                    'installment' => $installments,
                    'billing' => $billingAddress,
                    'holder' => new PagSeguroCreditCardHolder(
                        array(
                            'name' => $params['titular'],
                            'birthDate' => date('01/10/1979'),
                            'areaCode' => $params['ddd'],
                            'number' => $params['telefone'],
                            'documents' => array(
                                'type' => 'CPF',
                                'value' => $params['cpf']
                            )
                        )
                    )
                )
            );
            $directPaymentRequest->setCreditCard($creditCardData);
        }
        try {
            $credentials = PagSeguroConfig::getAccountCredentials();
            $r = $directPaymentRequest->register($credentials);
            return $r;
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }
    
    public function verificarVendas() {
        require 'libraries/PagSeguroLibrary/PagSeguroLibrary.php';

        $code = '';
        $type = '';

        if (isset($_POST['notificationCode']) && isset($_POST['notificationType'])) {
            $code = trim($_POST['notificationCode']);
            $type = trim($_POST['notificationType']);

            $notificationType = new PagSeguroNotificationType($type);
            $strType = $notificationType->getTypeFromValue();

            $credentials = PagseguroConfig::getAccountCredentials();

            try {
                $transaction = PagSeguroNotificationService::checkTransaction($credentials, $code);
                $ref = $transaction->getReference();
                $status = $transaction->getStatus()->getValue();

                $novoStatus = 0;
                switch ($status) {
                    case '1': // Aguardando Pgto.
                    case '2': // Em análise
                        $novoStatus = '1';
                        break;
                    case '3': // Paga
                    case '4': // Disponível
                        $novoStatus = '2';
                    case '6': // Devolvida
                    case '7': // Cancelada
                        $novoStatus = '3';
                        break;
                }

                $this->db->query("UPDATE vendas SET status_pg = '$novoStatus' WHERE id = '$ref'");
            } catch (PagSeguroServiceException $e) {
                echo "FALHA: " . $e->getMessage();
            }
        }
    }

    public function setLinkBySession($link, $sessionId) {
        $this->db->query("UPDATE vendas SET pg_link = '$link' WHERE pg_link = '$sessionId'");
        
    }
}
