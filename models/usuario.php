<?php

class Usuario extends model {
   
    public function __construct() {
        parent::__construct();
    }
    
    public function isExiste($email, $senha='') {
                
        if (!empty($senha)){
            $sql = "SELECT * FROM usuario WHERE email = '$email' AND senha = MD5('$senha')";
        } else {
            $sql = "SELECT * FROM usuario WHERE email = '$email'";
        }
        
        $sql = $this->db->query($sql);
        
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getNome($id) {
        $nome = '';
        $sql = "SELECT nome FROM usuario WHERE id = ".$id;
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $nome = $sql['nome'];
        }
        return $nome;
        
    }
    
    public function criarUsuario($nome, $email, $senha) {
        
        $sql = "INSERT INTO usuario SET nome = '$nome', email = '$email', senha = MD5('$senha')";
        $this->db->query($sql);
        
        return $this->db->lastInsertId();
    }
    
    public function getId($email) {
        $id = 0;
        $sql = "SELECT id FROM usuario WHERE email = '$email'";
        $sql = $this->db->query($sql);
        
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $id = $sql['id'];
        }
        
        return $id;
    }
}
