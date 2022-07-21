<?php
require_once("bancoCliente.php");

class Cadastrocliente extends BancoCliente {

    private $id;
    private $fantasia;
    private $razao;
    private $documento;
    private $ie;
    private $email;
    private $repitaEmail;    
    private $telefone;
    private $celular;
    private $endereco;
    private $CEP;
    private $bairro;
    private $complemento;
    private $cidade;
    private $estado;
    private $pais;
    private $contato;

    //Metodos Set
    public function setId($integer){
        $this->id = $integer;
    }
    public function setFantasia($string){
        $this->fantasia = $string;
    }
    public function setRazao($string){
        $this->razao = $string;
    }
    public function setDocumento($string){
        $this->documento = $string;
    }
    public function setIe($integer){
        $this->ie = $integer;
    }
    public function setEmail($string){
        $this->email = $string;
    }
    public function setRepitaemail($string){
        $this->repitaEmail = $string;
    }
    
    public function setTelefone($integer){
        $this->telefone = $integer;
    }
    public function setCelular($integer){
        $this->celular = $integer;
    }
    public function setEndereco($string){
        $this->endereco = $string;
    }
    public function setCEP($string){
        $this->CEP = $string;
    }
    public function setBairro($string){
        $this->bairro = $string;
    }
    public function setComplemento($string){
        $this->complemento = $string;
    }
    public function setCidade($string){
        $this->cidade = $string;
    }
    public function setEstado($integer){
        $this->estado = $integer;
    }
    public function setPais($integer){
        $this->pais = $integer;
    }
    public function setContato($string){
        $this->contato = $string;
    }
    
    //Metodos Get
     public function getId(){
        return $this->id;
    }
    public function getFantasia(){
        return $this->fantasia;
    }
    public function getRazao(){
        return $this->razao;
    }
    public function getDocumento(){
        return $this->documento;
    }
    public function getIe(){
        return $this->ie;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getRepitaemail(){
        return $this->repitaEmail;
    }
    public function getTelefone(){
        return $this->telefone;
    }
    public function getCelular(){
        return $this->celular;
    }
    public function getEndereco(){
        return $this->endereco;
    }
    public function getCEP(){
        return $this->CEP;
    }
    public function getBairro(){
        return $this->bairro;
    }
    public function getComplemento(){
        return $this->complemento;
    }
    public function getCidade(){
        return $this->cidade;
    }
    public function getEstado(){
        return $this->estado;
    }
    public function getPais(){
        return $this->pais;
    }
    public function getContato(){
        return $this->contato;
    }
    

    public function incluir(){
        return $this->setCliente($this->getId(),$this->getFantasia(),$this->getRazao(),$this->getDocumento(),$this->getIe(),$this->getEmail(),$this->getRepitaemail(),$this->getTelefone(),$this->getCelular(), $this->getEndereco(), $this->getCEP(),$this->getBairro(), $this->getComplemento(), $this->getCidade(), $this->getEstado(), $this->getPais(), $this->getContato());
    }

    public function editar(){
        return $this->updateCliente($this->getId(),$this->getFantasia(),$this->getRazao(),$this->getDocumento(),$this->getIe(),$this->getEmail(),$this->getRepitaemail(),$this->getTelefone(),$this->getCelular(), $this->getEndereco(), $this->getCEP(),$this->getBairro(), $this->getComplemento(), $this->getCidade(), $this->getEstado(), $this->getPais(), $this->getContato());
    }
}
?>
