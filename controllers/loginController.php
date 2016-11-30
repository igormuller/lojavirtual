<?php

class loginController extends controller {
    
    public function index() {
        
        $dados = array(
            'cliente' => ''
        );
        
        if (isset($_POST['email']) && !empty($_POST['email'])){
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);
            
            $u = new Usuario();
            if ($u->isExiste($email, $senha)){
                $_SESSION['cliente'] = $u->getId($email);
                $_SESSION['clinome']= $u->getNome($u->getId($email));
                header("Location:".BASE_URL."/pedidos");
            } else {
                $dados['aviso'] = "E-mail e/ou Senha não estão corretos!!";
            }
        }
        
        $this->loadTemplate("login", $dados);
        
    }
    
    public function logout() {
        
        unset($_SESSION['cliente']);
        header("Location:".BASE_URL."/login");
        
    }
}

