<?php

class pedidosController extends controller {
    
    public function index() {
        $dados = array(
            'pedidos' => array()
        );
        
        if (isset($_SESSION['cliente']) && !empty($_SESSION['cliente'])){
            
            $v = new Venda();
            $dados['pedidos'] = $v->getPedidoUsuario($_SESSION['cliente']);
            
            $this->loadTemplate('pedidos', $dados);
        } else {
            header("Location:".BASE_URL."/login");
        }
        
    }
    
    public function ver($id) {
        if (!empty($id)) {
            $dados = array();
            $id = addslashes($id);
            $v = new Venda();
            $dados['pedido'] = $v->getPedido($id, $_SESSION['cliente']);
            if (count($dados['pedido']) > 0) {
                $this->loadTemplate("pedidos_ver", $dados);
            } else {
                header("Location: /pedidos");
            }            
        } else {
            header("Location: /pedidos");
        }
        
        
    }
}

?>