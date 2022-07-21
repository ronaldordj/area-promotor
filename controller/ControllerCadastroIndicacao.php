<?php

require_once("../model/cadastroIndicacao.php");

class cadastroindicacaoController

{



    private $cadastroIndicacao;



    public function __construct()

    {

        $this->cadastro = new Cadastroindicacao();

        $this->incluir();

    }



    private function incluir()

    {      
        $this->cadastro->setId($_POST['idindicacao']);

        $this->cadastro->setData($_POST['dataindicacao']);

        $this->cadastro->setRazao($_POST['razao']);

        $this->cadastro->setFantasia($_POST['fantasia']);

        $this->cadastro->setContato($_POST['contato']);

        $this->cadastro->setDocumento($_POST['documento']);

        $this->cadastro->setTelefone($_POST['telefone']);

        $this->cadastro->setCelular($_POST['celular']);

        $this->cadastro->setEmail($_POST['email']);

        $this->cadastro->setSite($_POST['site']);

        $this->cadastro->setTipo($_POST['tipo']);

        $this->cadastro->setModalidade($_POST['modalidade']);

        $this->cadastro->setIntegracao($_POST['integracao']);

        $this->cadastro->setIdRevenda($_POST['revenda']);

        $this->cadastro->setStatus(0);          

        $this->cadastro->setIdPromotor($_POST['idpromotor']);
        
        $indicacao = $_POST['idindicacao'];
        
        $result = $this->cadastro->incluir();        

        if ($result >= 1) {
            
            echo "<script>document.location='ControllerCadastroAcompanhamento.php?indicacao=$indicacao'</script>";

        } else {

            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";

        }

    }

}

new cadastroindicacaoController();

