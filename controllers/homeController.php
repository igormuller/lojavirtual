<?php
class homeController extends controller {
    
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $mvc = array(
            "nome" => "MVC",
            "modelo" => "Padrão"
        );
        
        $dados['mvc'] = $mvc;
        $this->loadTemplate('home', $dados);
    }
    
}
?>