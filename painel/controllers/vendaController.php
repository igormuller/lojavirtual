<?php

class vendaController extends controller {
    
    public function __construct() {
        parent::__construct();
        $adm = new Admin();
        if (!$adm->isLogged()){
            header("Location: /painel/login");
        }
    }
    
    public function index() {
        $dados = array(
            'vendas' => array()
        );
        $v = new Venda();
        $dados['vendas'] = $v->getVendas();
        
        $this->loadTemplate('venda', $dados);   
    }
    
    public function ver($id) {
        $id = addslashes($id);
        $v = new Venda();
        if (count($v->getVenda($id)) > 0) {
            $dados = array(
                'venda' => array(),
                'produtos' => array()
            );
            if (!empty($id)) {

                $dados['venda'] = $v->getVenda($id);
                $dados['produtos'] = $v->getProdutosVenda($id);
                $this->loadTemplate('vendaVer', $dados);
            }
        } else {
            header("Location: /painel/erro");
        }
        
        
    }
    
    
}

