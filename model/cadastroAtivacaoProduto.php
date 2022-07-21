<?php

require_once("bancoAtivacao.php");



class Cadastroativacaoproduto extends BancoAtivacao {



    private $idativacao;

    private $idproduto;

    private $idmodalidade;    

    private $chave;   



    //Metodos Set

    public function setId($integer){

        $this->id = $integer;

    }
    

    public function setIdAtivacao($integer){

        $this->idativacao = $integer;

    }

    public function setIdProduto($integer){

        $this->idproduto = $integer;

    } 

    public function setIdModalidade($integer){

        $this->idmodalidade = $integer;

    }    

    public function setChave($string){

        $this->chave = $string;

    }

    //Metodos Get

    public function getId(){

        return $this->id;

    }

    public function getIdAtivacao(){

        return $this->idativacao;

    }

    public function getIdProduto(){

        return $this->idproduto;

    } 

    public function getIdModalidade(){

        return $this->idmodalidade;

    }

    public function getChave(){

        return $this->chave;

    }


    public function incluir(){

        return $this->setAtivacaoProduto($this->getIdAtivacao(), $this->getIdProduto(), $this->getIdModalidade(), $this->getChave());

    }



    public function editar(){

        return $this->updtAtivacaoProduto($this->getId(), $this->getIdAtivacao(), $this->getIdProduto(), $this->getIdModalidade(), $this->getChave());

    }

}

?>

