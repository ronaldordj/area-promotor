<?php

require_once("bancoIndicacao.php");



class Cadastroindicacao extends BancoIndicacao {

    private $id;    
    
    private $data;
    
    private $razao;

    private $fantasia;

    private $contato;    

    private $documento;

    private $telefone;  
    
    private $celular;

    private $email;

    private $site;

    private $tipo;

    private $modalidade;

    private $integracao;

    private $idrevenda;

    private $status;

    private $idpromotor;


    //Metodos Set

    public function setId($integer){

        $this->id = $integer;

    }

    public function setData($string){

        $this->data = $string;

    }
    

    public function setRazao($string){

        $this->razao = $string;

    }

    public function setFantasia($string){

        $this->fantasia = $string;

    } 

    public function setContato($string){

        $this->contato = $string;

    }    

    public function setDocumento($string){

        $this->documento = $string;

    }
    
    public function setTelefone($string){

        $this->telefone = $string;

    }

    public function setCelular($string){

        $this->celular = $string;

    }

    public function setEmail($string){

        $this->email = $string;

    }

    public function setSite($string){

        $this->site = $string;

    }

    public function setTipo($string){

        $this->tipo = $string;

    }

    public function setModalidade($string){

        $this->modalidade = $string;

    }

    public function setIntegracao($string){

        $this->integracao = $string;

    }

    public function setIdRevenda($integer){

        $this->idrevenda = $integer;

    }

    public function setStatus($integer){

        $this->status = $integer;

    }

    public function setIdPromotor($integer){

        $this->idpromotor = $integer;

    }

    //Metodos Get

    public function getId(){

        return $this->id;

    }

    
    public function getData(){

        return $this->data;

    }

    public function getRazao(){

        return $this->razao;

    } 

    public function getFantasia(){

        return $this->fantasia;

    }

    public function getContato(){

        return $this->contato;

    }

    public function getDocumento(){

        return $this->documento;

    }    

    public function getTelefone(){

        return $this->telefone;

    }    

    public function getCelular(){

        return $this->celular;

    }    

    public function getEmail(){

        return $this->email;

    }    

    public function getSite(){

        return $this->site;

    }    

    public function getTipo(){

        return $this->tipo;

    }    

    public function getModalidade(){

        return $this->modalidade;

    }    

    public function getIntegracao(){

        return $this->integracao;

    }    

    public function getIdRevenda(){

        return $this->idrevenda;

    }    

    public function getStatus(){

        return $this->status;

    }    

    public function getIdPromotor(){

        return $this->idpromotor;

    } 

    public function incluir(){

        return $this->setIndicacao($this->getId(), $this->getData(), $this->getRazao(), $this->getFantasia(), $this->getContato(), $this->getDocumento(), $this->getTelefone(), $this->getCelular(), $this->getEmail(), $this->getSite(), $this->getTipo(), $this->getModalidade(), $this->getIntegracao(), $this->getIdRevenda(), $this->getStatus(), $this->getIdpromotor());        

    }

    public function editar(){

        return $this->updtIndicacao($this->getId(), $this->getData(), $this->getRazao(), $this->getFantasia(), $this->getContato(), $this->getDocumento(), $this->getTelefone(), $this->getCelular(), $this->getEmail(), $this->getSite(), $this->getTipo(), $this->getModalidade(), $this->getIntegracao(), $this->getIdRevenda(), $this->getStatus(), $this->getIdpromotor());
    

    }

}

?>

