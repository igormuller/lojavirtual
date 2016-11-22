<?php

class categoriaController extends controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function ver($id) {
        if (!empty($id)){
            $dados = array(
                'categoria' => '',
                'produtos' => array()
            );
            $p = new Produto();
            $c = new Categoria();
            $dados['produtos'] = $p->getProdutoCategoria($id);
            $dados['categoria'] = $c->getNome($id);
            $this->loadTemplate('categoria', $dados);
        } else {
            echo "ID não informado";
        }
        
    }
    
}

