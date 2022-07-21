<?php

require_once("bancoIndicacao.php");



class Cadastroacompanhamento extends BancoIndicacao {



    private $idindicacao;

    private $dataindicacao;

    private $datacontato;    

    private $flapresentacao; 
    
    private $dataproposta;

    private $flfechado;

    private $flinteresse;

    private $motivointeresse;

    private $dataapresentacao;

    private $flinteresseapr;

    private $motivoapresentacao;

    private $motivofechado;



    //Metodos Set

    
    public function setIdindicacao($integer){

        $this->idindicacao = $integer;

    }

    public function setDataIndicacao($string){

        $this->dataindicacao = $string;

    } 

    public function setDataContato($string){

        $this->datacontato = $string;

    }    

    public function setFlApresentacao($string){

        $this->flapresentacao = $string;

    }

    public function setDataProposta($string){

        $this->dataproposta = $string;

    }
    
    public function setFlFechado($string){

        $this->flfechado = $string;

    }

    public function setMotivoInteresse($string){

        $this->motivointeresse = $string;

    }

    public function setFlInteresse($string){

        $this->flinteresse = $string;

    }

    public function setDataApresentacao($string){

        $this->dataapresentacao = $string;

    }

    public function setFlInteresseApr($string){

        $this->flinteresseapr = $string;

    }

    public function setMotivoApresentacao($string){

        $this->motivoapresentacao = $string;

    }

    public function setMotivoFechado($string){

        $this->motivofechado = $string;

    }

    //Metodos Get
    
    public function getIdindicacao(){

        return $this->idindicacao;

    }

    public function getDataIndicacao(){

        return $this->dataindicacao;

    } 

    public function getDataContato(){

        return $this->datacontato;

    }

    public function getFlApresentacao(){

        return $this->flapresentacao;

    }

    public function getDataProposta(){

        return $this->dataproposta;

    }

    public function getFlFechado(){

        return $this->flfechado;

    }

    public function getFlInteresse(){

        return $this->flinteresse;

    }

    public function getMotivoInteresse(){

        return $this->motivointeresse;

    }

    public function getDataApresentacao(){

        return $this->dataapresentacao;

    }

    public function getFlInteresseApr(){

        return $this->flinteresseapr;

    }

    public function getMotivoApresentacao(){

        return $this->motivoapresentacao;

    }

    public function getMotivoFechado(){

        return $this->motivofechado;

    }


    public function incluir(){

        return $this->setAcompanhamento($this->getIdindicacao(), $this->getDataIndicacao());

    }



    public function editar(){

        return $this->updtAcompanhamento($this->getIdindicacao(), $this->getDataContato(), $this->getFlApresentacao(), $this->getDataProposta(), $this->getFlFechado(), $this->getFlInteresse(), $this->getMotivoInteresse(), $this->getDataApresentacao(), $this->getFlInteresseApr(), $this->getMotivoApresentacao(), $this->getMotivoFechado());

    }

}

?>

