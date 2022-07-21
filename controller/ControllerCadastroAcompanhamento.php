<?php

require_once("../model/cadastroAcompanhamento.php");

class cadastroacompanhamentoController

{



    private $cadastroAcompanhamento;



    public function __construct()

    {

        $this->cadastro = new Cadastroacompanhamento();

        $this->incluir();

    }



    private function incluir()

    {
        $dataindicacao = date('Y-m-d');
        
        $this->cadastro->setIdindicacao($_GET['indicacao']);        

        $this->cadastro->setDataIndicacao($dataindicacao);

        $ind = base64_encode($_GET['indicacao']);


        $result = $this->cadastro->incluir();

        if ($result >= 1) {

            echo "<script>document.location='../view/indicacoes/enviarAuto.php?ind=$ind'</script>";

        } else {

            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";

        }

    }

}

new cadastroacompanhamentoController();

