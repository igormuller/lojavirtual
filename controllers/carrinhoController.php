<?php

class carrinhoController extends controller {
    
    public function index() {
        $dados = array(
            'produtos' => ''
        );
        if (isset($_SESSION['carrinho'])){
            $produtos = $_SESSION['carrinho'];
            if (count($produtos) > 0){
                $p = new Produto();
                $dados['produtos'] = $p->getProdutosArray($produtos);
            }
        }
        
        $this->loadTemplate('carrinho', $dados);
        
    }
    
    public function add($id) {
        
        if (!empty($id)){
            if (!isset($_SESSION['carrinho'])){
                $_SESSION['carrinho'] = array();
            }
            $_SESSION['carrinho'][] = $id;
        }
        
        header("Location: ".BASE_URL."/carrinho");
    }
    
    public function del($id) {
        
        if (!empty($id)){
            foreach ($_SESSION['carrinho'] as $cchave => $cvalor){
                if ($id == $cvalor){
                    unset($_SESSION['carrinho'][$cchave]);
                }
            }
        }
        
        header("Location: ".BASE_URL."/carrinho");
        
    }
    
    public function finalizar() {
        $dados = array(
            'pagamentos' => array(),
            'total' => 0
        );
        $pagamento = new Pagamento();
        $dados['pagamentos'] = $pagamento->getPagamantos();
        if (isset($_SESSION['carrinho'])){
            $produtos = $_SESSION['carrinho'];
            if (count($produtos) > 0){
                $p = new Produto();
                $dados['produtos'] = $p->getProdutosArray($produtos);
                foreach ($dados['produtos'] as $prod){
                    $dados['total'] += $prod['preco'];
                }
            }
        }
        $this->loadTemplate('finalizarcompra', $dados);
    }
}
