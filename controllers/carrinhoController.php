<?php

class carrinhoController extends controller {
    
    public function index() {
        $dados = array();
        if (isset($_SESSION['carrinho'])){
            $produtos = $_SESSION['carrinho'];
        }
        
        $p = new Produto();
        $dados['produtos'] = $p->getProdutosArray($produtos);
        
        $this->loadTemplate('carrinho', $dados);
        
    }
    
    public function add($id) {
        
        if (!empty($id)){
            if (!isset($_SESSION['carrinho'])){
                $_SESSION['carrinho'] = array();
            }
            $_SESSION['carrinho'][] = $id;
        }
        
        header("Location: /carrinho");
    }
}
