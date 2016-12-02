<?php
class loginController extends controller {
    
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $dados = array(
            'aviso' => ''
        );
        
        if (isset($_POST['usuario']) && !empty($_POST['usuario'])){
            $u = addslashes($_POST['usuario']);
            $s = md5($_POST['senha']);
            $adm = new Admin();
            if ($adm->validaLogin($u,$s)){
                header("Location: /painel");
            } else {
                $dados['aviso'] = "Usuário e/ou senha incorretos!";
            }
        }
        
        $this->loadView('login', $dados);
    }
    
    public function sair() {
        unset($_SESSION['admlogin']);
        header("Location: /painel");
        
    }
    
}
?>