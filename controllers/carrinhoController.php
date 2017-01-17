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
            'total' => 0,
            'sessionId' => '',
            'erro' => '',
            'produtos' => array()
        );
        $prods = array();
        require 'libraries/PagSeguroLibrary/PagseguroLibrary.php';
        if (isset($_SESSION['carrinho'])) {
            $prods = $_SESSION['carrinho'];
        }
        
        if (count($prods) > 0) {
            $produtos = new Produto();
            $dados['produtos'] = $produtos->getProdutosArray($prods);
            foreach ($dados['produtos'] as $prod) {
                $dados['total'] += $prod['preco'];
                
            }
        }
        
        if (isset($_POST['pg_form']) && !empty($_POST['pg_form'])) {
            $nome = addslashes($_POST['nome']);
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            $sessionId = addslashes($_POST['sessionId']);
            
            if (!empty($email) && !empty($senha)) {
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
                    $vendas = new Venda();
                    $venda = $vendas->setVendaCkTransparente($_POST, $uid, $sessionId, $dados['produtos'], $dados['total']);
                    
                }
            } else {
                $dados['erro'] = "Preencha todos os Campos";
            }
        } else {
            try {
                $credentials = PagSeguroConfig::getAccountCredentials();
                $dados['sessionId'] = PagSeguroSessionService::getSession($credentials);
            } catch (PagSeguroServiceException $ex) {
                die($ex->getMessage());
            }
        }
            
        
        $this->loadTemplate('finalizarcompra', $dados);
    }
    
    public function obrigado() {
        $dados = array();
        $this->loadTemplate('obrigado', $dados);
        
    }
}
