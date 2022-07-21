<?php

require_once("../model/cadastroAtivacaoProduto.php");

class cadastroativacaoprodutoControllerEdit

{



    private $cadastroAtivacaoProduto;



    public function __construct()

    {

        $this->cadastro = new Cadastroativacaoproduto();

        $this->editar();

    }



    private function editar()

    {

        $this->cadastro->setIdAtivacao($_GET['ativacao']);

        $this->cadastro->setIdProduto($_GET['produto']);        

        $this->cadastro->setIdModalidade($_GET['modalidade']);       

        $this->cadastro->setChave($_GET['chave']);

        $ativacao = base64_encode($_GET['ativacao']);


        $result = $this->cadastro->editar();

        if ($result >= 1) {

            echo "<script>document.location='../view/ativacoes/enviarAutoRen.php?id=$ativacao'</script>";

        } else {

            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";

        }

    }

}

new cadastroativacaoprodutoControllerEdit();

