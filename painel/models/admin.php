<?php
class Admin extends model {
    
    public function isLogged() {
        
        if (isset($_SESSION['admlogin']) && !empty($_SESSION['admlogin'])){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function validaLogin($u, $s) {
        $sql = "SELECT * FROM admin WHERE usuario = '$u' AND senha = '$s'";
        $sql = $this->db->query($sql);
        
        if ($sql->rowCount() > 0){
            $sql = $sql->fetch(); 
            $_SESSION['admlogin'] = $sql['id'];
            return TRUE;
        } else {
            return false;
        }        
    }
    
    public function getUsuario($u,$s) {
        $sql = "SELECT * FROM admin WHERE usuario = '$u' AND senha = '$s'";
        $sql = $this->db->query($sql);
        
        if ($sql->rowCount() > 0){
            $sql = $sql->fetch(); 
            return $sql['id'];
        }
    }
}

