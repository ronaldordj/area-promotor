<?php
require_once("bancoConfigEmail.php");

class Cadastroconfigemail extends BancoConfigEmail {

    private $smtp;
    private $porta;
    private $usuario;
    private $senha;
    private $seguranca;
	private $idusuario;    

    //Metodos Set    
    public function setSmtp($string){
        $this->smtp = $string;
    }
    public function setPorta($string){
        $this->porta = $string;
    }
    public function setUsuario($string){
        $this->usuario = $string;
    }    
    public function setSenha($string){
        $this->senha = $string;
    }
    public function setSeguranca($string){
        $this->seguranca = $string;
    }    
	public function setIdusuario($integer){
        $this->idusuario = $integer;
    }    
    
    //Metodos Get     
    public function getSmtp(){
        return $this->smtp;
    }
    public function getPorta(){
        return $this->porta;
    }
    public function getUsuario(){
        return $this->usuario;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function getSeguranca(){
        return $this->seguranca;
    }
    public function getIdusuario(){
        return $this->idusuario;
    }      

    public function incluir(){
    return $this->setConfigEmail($this->getSmtp(),$this->getPorta(),$this->getUsuario(),$this->getSenha(),$this->getSeguranca(),$this->getIdusuario());
    }

    public function editar(){
    return $this->updateConfigEmail($this->getSmtp(),$this->getPorta(),$this->getUsuario(),$this->getSenha(),$this->getSeguranca(),$this->getIdusuario());
    }
}
?>
