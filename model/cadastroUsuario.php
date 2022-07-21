<?php
require_once("bancoUsuario.php");

class Cadastrousuario extends BancoUsuario {

    private $id;
    private $nome;
    private $email;
    private $funcao;
    private $telefone;
    private $senha;
    private $senhaValida;    
    private $ativo;

    //Metodos Set
    public function setId($integer){
        $this->id = $integer;
    }
    public function setNome($string){
        $this->nome = $string;
    }
    public function setEmail($string){
        $this->email = $string;
    }
    public function setFuncao($string){
        $this->funcao = $string;
    }
    public function setTelefone($integer){
        $this->telefone = $integer;
    }
    public function setSenha($string){
        $this->senha = $string;
    }
    public function setSenhaValida($string){
        $this->senhaValida = $string;
    }    
    public function setAtivo($integer){
        $this->ativo = $integer;
    }
    
    //Metodos Get
     public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getFuncao(){
        return $this->funcao;
    }
    public function getTelefone(){
        return $this->telefone;
    }
    public function getSenha(){
        return $this->senha;
    }
    public function getSenhaValida(){
        return $this->senhaValida;
    }
    public function getAtivo(){
        return $this->ativo;
    }    

    public function incluir(){
        return $this->setUsuario($this->getId(),$this->getNome(),$this->getEmail(),$this->getFuncao(),$this->getTelefone(),$this->getSenha(),$this->getSenhaValida(),$this->getAtivo());
    }

    public function editar(){
        return $this->updateUsuario($this->getId(),$this->getNome(),$this->getEmail(),$this->getFuncao(),$this->getTelefone(),$this->getSenha(),$this->getSenhaValida(),$this->getAtivo());
    }
}
?>
