<?php

require_once("../model/cadastroAtivacao.php");

class cadastroativacaoControllerEdit

{



    private $cadastroAtivacao;



    public function __construct()

    {

        $this->cadastro = new Cadastroativacao();

        $this->editar();

    }



    private function editar()

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

        $result = $this->cadastro->editar();        

        if ($result >= 1) {

            echo "<script>document.location='ControllerCadastroAtivacaoProdutoEdit.php?ativacao=$ativacao&produto=$produto&modalidade=$modalidade&chave=$chave'</script>";

        } else {

            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";

        }

    }

}

new cadastroativacaoControllerEdit();

