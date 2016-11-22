<?php
class homeController extends controller {
    
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $dados = array();
        
        
        
        $p = new Produto();
        $dados['produtos'] = $p->listProdutos(8);
        
        $this->loadTemplate('home', $dados);
    }
    
}
?>