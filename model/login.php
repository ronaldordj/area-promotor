<?php
require_once("bancoLogin.php");

class Login extends BancoLogin {

    private $email;
    private $senha;
    private $mascara;

    
    public function setEmail($string){
        $this->email = $string;
    }
    public function setSenha($string){
        $this->senha = $string;
    }    
    public function setTelefone($string){
        $this->mascara = $string;
    }
    
    //Metodos Get
     public function getEmail(){
        return $this->email;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function getMascara(){
        return $this->mascara;
    }

    public function logar(){
        return $this->setlogin($this->getEmail(),$this->getSenha());
    }
}
?>
