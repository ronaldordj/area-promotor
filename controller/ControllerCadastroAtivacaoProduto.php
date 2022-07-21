<?php

require_once("../model/cadastroAtivacaoProduto.php");

class cadastroativacaoprodutoController

{



    private $cadastroAtivacaoProduto;



    public function __construct()

    {

        $this->cadastro = new Cadastroativacaoproduto();

        $this->incluir();

    }



    private function incluir()

    {

        $this->cadastro->setIdAtivacao($_GET['ativacao']);

        $this->cadastro->setIdProduto($_GET['produto']);        

        $this->cadastro->setIdModalidade($_GET['modalidade']);       

        $this->cadastro->setChave($_GET['chave']);

        $ativacao = base64_encode($_GET['ativacao']);


        $result = $this->cadastro->incluir();

        if ($result >= 1) {

            echo "<script>document.location='../view/ativacoes/enviarAuto.php?id=$ativacao'</script>";

        } else {

            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";

        }

    }

}

new cadastroativacaoprodutoController();

