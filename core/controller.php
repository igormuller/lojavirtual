<?php
class controller {
    
    
    
    public function __construct(){
        
    }
    
    public function loadView($viewName, $viewData = array()){
        extract($viewData);
        include 'views/'.$viewName.'.php';
    }

    public function loadTemplate($viewName, $viewData = array()){
        $c = new Categoria();
        $menu = $c->getCategorias();
        include 'views/template.php';
    }

    public function loadViewInTemplate($viewName, $viewData = array()){
        extract($viewData);
        include 'views/'.$viewName.'.php';
    }
}

?>