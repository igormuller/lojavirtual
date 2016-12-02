<?php
class homeController extends controller {
    
    public function __construct() {
        parent::__construct();
        
        $adm = new Admin();
        if (!$adm->isLogged()){
            header("Location: /painel/login");
        }
    }
    
    public function index() {
        $dados = array(
            'aviso' => "Logado;"
        );
        
        
        
        $this->loadTemplate('home', $dados);
    }
    
}
?>