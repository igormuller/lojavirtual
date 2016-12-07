<?php

class carrinhoController extends controller {
    
    public function index() {
        $dados = array(
            'produtos' => ''
        );
        if (isset($_SESSION['carrinho'])){
            $produtos = $_SESSION['carrinho'];
            if (count($produtos) > 0){
                $p = new Produto();
                $dados['produtos'] = $p->getProdutosArray($produtos);
            }
        }
        
        $this->loadTemplate('carrinho', $dados);
        
    }
    
    public function add($id) {
        
        if (!empty($id)){
            if (!isset($_SESSION['carrinho'])){
                $_SESSION['carrinho'] = array();
            }
            $_SESSION['carrinho'][] = $id;
        }
        
        header("Location: ".BASE_URL."/carrinho");
    }
    
    public function del($id) {
        
        if (!empty($id)){
            foreach ($_SESSION['carrinho'] as $cchave => $cvalor){
                if ($id == $cvalor){
                    unset($_SESSION['carrinho'][$cchave]);
                }
            }
        }
        
        header("Location: ".BASE_URL."/carrinho");
        
    }
    
    public function finalizar() {
        $dados = array(
            'pagamentos' => array(),
            'total' => 0,
            'erro' => ''
        );
        $pagamento = new Pagamento();
        $dados['pagamentos'] = $pagamento->getPagamantos();
        if (isset($_SESSION['carrinho'])){
            $produtos = $_SESSION['carrinho'];
            if (count($produtos) > 0){
                $p = new Produto();
                $dados['produtos'] = $p->getProdutosArray($produtos);
                foreach ($dados['produtos'] as $prod){
                    $dados['total'] += $prod['preco'];
                }
            }
        }
        
        if (isset($_POST['nome']) && !empty($_POST['nome'])){
            
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            
            $endereco = addslashes($_POST['endereco']);
            
            if (isset($_POST['pg'])){
                $pg = $_POST['pg'];
            } else {
                $pg = '';
            }
            
            
            if (!empty($email) && !empty($senha) && !empty($endereco) && !empty($pg)){
                $uid = 0;
                $u = new Usuario();
                if ($u->isExiste($email)){
                    if ($u->isExiste($email, $senha)){
                        $uid = $u->getId($email);
                    } else {
                        $dados['erro'] = "Usuário e/ou senha errados!";
                    }
                } else {
                    $uid = $u->criarUsuario($nome, $email, $senha);
                }
                
                if ($uid > 0) {
                    $v = new Venda();
                    $link = $v->setVenda($uid,$endereco,$dados['total'],$pg, $dados['produtos']);
                    
                    header("Location: ".$link);
                }
                
            } else {
                $dados['erro'] = "Preencha todos os campos!";
            }
        } 
        
        $this->loadTemplate('finalizarcompra', $dados);
    }
    
    public function obrigado() {
        $dados = array();
        $this->loadTemplate('obrigado', $dados);
        
    }
}
