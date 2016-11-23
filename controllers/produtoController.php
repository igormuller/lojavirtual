<?php

class produtoController extends controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function ver($id = '') {
        $dados = array();
        
        if (!empty($id)){
            $id = addslashes($id);
            $p = new Produto();
            $dados['produto'] = $p->getProdutoId($id);
            if (!empty($dados['produto'])){
                $this->loadTemplate('produto', $dados);
            } else {
                $this->loadTemplate('erro');
            }
        } else {
            $this->loadTemplate('erro');
        }
        
    }
}
