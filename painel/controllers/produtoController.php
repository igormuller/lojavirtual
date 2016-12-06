<?php

class produtoController extends controller {
    
    public function index() {
        $dados = array();
        $offset = 0;
        $limit = 10;
        if (isset($_GET['p']) && !empty($_GET['p'])){
            $p = addslashes($_GET['p']);
            $offset = ($limit * $p) - $limit;
        }        
        $p = new Produto();
        $dados['limit_produtos'] = $limit;
        $dados['total_produtos'] = $p->getTotalProdutos();
        $dados['produtos'] = $p->getProdutos($offset, $limit);
        $this->loadTemplate('produto', $dados);
    }
    
    public function add() {
        $dados = array(
            'categorias' => array()
        );
        $c = new Categoria();
        $dados['categorias'] = $c->getCategorias();
        
        if (isset($_POST['nome']) && !empty($_POST['nome']) && isset($_FILES['imagem']) && !empty($_FILES['imagem']['tmp_name'])) {
            $nome = addslashes($_POST['nome']);
            $descricao = addslashes($_POST['descricao']);
            $categoria = addslashes($_POST['categoria']);
            $preco = addslashes($_POST['preco']);
            $quantidade = addslashes($_POST['quantidade']);
            $imagem = $_FILES['imagem'];
            $permitidos = array(
                'image/jpeg',
                'image/jpg',
                'image/png'
            );
            $ext = '';
            if (in_array($imagem['type'], $permitidos)) {
                if ($imagem['type'] == 'image/jpeg' || $imagem['type'] == 'image/jpg'){
                    $ext = '.jpg';                  
                } else if ($imagem['type'] == 'image/png') {
                    $ext = '.png';
                }
                $nomeFinal = md5(time().rand(0, 999)).$ext;
                move_uploaded_file($imagem['tmp_name'], '../assets/images/produto/'.$nomeFinal);
                $p = new Produto();
                $p->add($nome, $descricao, $categoria, $preco, $quantidade, $nomeFinal);
                
                header("Location: /painel/produto");
            } else {
                $dados['aviso'] = "Arquivo não permitido";
            }
        }
        $this->loadTemplate('produtoAdd', $dados);
    }
    
    public function remove($id) {
        if (!empty($id)){
            $p = new Produto();
            $p->delete($id);
            header("Location: /painel/produto");
        }
    }
    
    public function edit($id) {
        $dados = array(
            'categorias' => array(),
            'produto' => array()
        );
        $c = new Categoria();
        $dados['categorias'] = $c->getCategorias();
        $p = new Produto();
        $id = addslashes($id);
        $dados['produto'] = $p->getProduto($id);
        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            $nome = addslashes($_POST['nome']);
            $descricao = addslashes($_POST['descricao']);
            $categoria = addslashes($_POST['categoria']);
            $preco = addslashes($_POST['preco']);
            $quantidade = addslashes($_POST['quantidade']);
            
            $p->updateProduto($id, $nome, $descricao, $categoria, $quantidade, $preco);
            
            if (isset($_FILES['imagem']) && !empty($_FILES['imagem']['tmp_name'])){
                $imagem = $_FILES['imagem'];
                $permitidos = array(
                    'image/jpeg',
                    'image/jpg',
                    'image/png'
                );
                $ext = '';
                if (in_array($imagem['type'], $permitidos)) {
                    if ($imagem['type'] == 'image/jpeg' || $imagem['type'] == 'image/jpg') {
                        $ext = '.jpg';
                    } else if ($imagem['type'] == 'image/png') {
                        $ext = '.png';
                    }
                    $nomeFinal = md5(time() . rand(0, 999)) . $ext;
                    move_uploaded_file($imagem['tmp_name'], '../assets/images/produto/' . $nomeFinal);

                    $p->updateImagem($id, $nomeFinal);
                } else {
                    $dados['aviso'] = "Arquivo não permitido";
                }
            }
            header("Location: /painel/produto");
        }
        $this->loadTemplate('produtoEdit', $dados);
    }
    
}

