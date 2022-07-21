<?php

require_once("bancoAtivacao.php");



class Cadastroativacao extends BancoAtivacao {



    private $id;    

    private $idcliente;

    private $idusuario;

    private $status;    

    private $statusemail;

    private $datacriacao;      


    //Metodos Set

    public function setId($integer){

        $this->id = $integer;

    }
    

    public function setIdCliente($integer){

        $this->idcliente = $integer;

    }

    public function setUsuario($integer){

        $this->idusuario = $integer;

    } 

    public function setStatus($integer){

        $this->status = $integer;

    }    

    public function setStatusEmail($integer){

        $this->statusemail = $integer;

    }
    
    public function setDataCriacao($date){

        $this->datacriacao = $date;

    }

    //Metodos Get

    public function getId(){

        return $this->id;

    }

    public function getIdCliente(){

        return $this->idcliente;

    }

    public function getUsuario(){

        return $this->idusuario;

    } 

    public function getStatus(){

        return $this->status;

    }

    public function getStatusEmail(){

        return $this->statusemail;

    }

    public function getDataCriacao(){

        return $this->datacriacao;

    }    

    public function incluir(){

        return $this->setAtivacao($this->getId(), $this->getIdCliente(), $this->getUsuario(), $this->getStatus(), $this->getStatusEmail(), $this->getDataCriacao());        

    }

    public function editar(){

        return $this->updtAtivacao($this->getId(), $this->getIdCliente(), $this->getUsuario(), $this->getStatus(), $this->getStatusEmail(), $this->getDataCriacao());
    

    }

}

?>

