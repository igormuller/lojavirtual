<?php

class categoriaController extends controller {
    
    public function index() {
        $dados = array();
        $c = new Categoria();
        $dados['categorias'] = $c->getCategorias();
        $this->loadTemplate('categoria', $dados);   
    }
    
    public function remove($id) {
        if (!empty($id)) {
            $cat = new Categoria();
            $cat->removeCategori($id);
            header("Location: /painel/categoria");
        }
    }
    
    public function add() {
        $dados = array();
        if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
            $cat = new Categoria();
            $cat->addCategoria($_POST['titulo']);
            
            header("Location: /painel/categoria");
        }
        $this->loadTemplate('categoriaAdd', $dados);
    }
    
    public function edit($id) {
        $dados = array();
        $cat = new Categoria();
        if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
            $cat->editCategoria($_POST['titulo'], $id);
            header("Location: /painel/categoria");
        }
        $dados['categoria'] = $cat->getCategoria($id);
        
        $this->loadTemplate('categoriaEdit', $dados);
    }
    
}

