<?php

require_once("../model/cadastroAtivacao.php");

class cadastroativacaoController

{



    private $cadastroAtivacao;



    public function __construct()

    {

        $this->cadastro = new Cadastroativacao();

        $this->incluir();

    }



    private function incluir()

    {        

        $this->cadastro->setId($_POST['idativacao']);

        $this->cadastro->setIdCliente($_POST['idcliente']);

        $this->cadastro->setUsuario($_POST['idusuario']);        

        $this->cadastro->setStatus(0);       

        $this->cadastro->setStatusEmail(0);  
        
        $ativacao   = $_POST['idativacao'];
        $produto    = $_POST['produto'];
        $modalidade = $_POST['modalidade'];
        $chave      = $_POST['chave'];

        $result = $this->cadastro->incluir();        

        if ($result >= 1) {

            echo "<script>document.location='ControllerCadastroAtivacaoProduto.php?ativacao=$ativacao&produto=$produto&modalidade=$modalidade&chave=$chave'</script>";

        } else {

            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";

        }

    }

}

new cadastroativacaoController();

