<?php

class vendaController extends controller {
    
    public function index() {
        $dados = array(
            'vendas' => array()
        );
        $v = new Venda();
        $dados['vendas'] = $v->getVendas();
        
        $this->loadTemplate('venda', $dados);   
    }
    
    
}

