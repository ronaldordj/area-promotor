<?php
require_once("../model/cadastroCliente.php");
class cadastroclienteController
{

    private $cadastroCliente;

    public function __construct()
    {
        $this->cadastro = new Cadastrocliente();
        $this->incluir();
    }

    private function incluir()
    {
        $this->cadastro->setFantasia($_POST['fantasia']);
        $this->cadastro->setRazao($_POST['razao']);
        $this->cadastro->setDocumento($_POST['documento']);
        $this->cadastro->setIe($_POST['ie']);
        $this->cadastro->setEmail($_POST['email']);
        $this->cadastro->setRepitaemail($_POST['repitaEmail']);
        $this->cadastro->setTelefone($_POST['telefone']);
        $this->cadastro->setCelular($_POST['celular']);
        $this->cadastro->setEndereco($_POST['endereco']);
        $this->cadastro->setCEP($_POST['cep']);
        $this->cadastro->setBairro($_POST['bairro']);
        $this->cadastro->setComplemento($_POST['complemento']);
        $this->cadastro->setCidade($_POST['cidade']);
        $this->cadastro->setEstado($_POST['estado']);
        $this->cadastro->setPais($_POST['pais']);
        $this->cadastro->setContato($_POST['contato']);

        $result = $this->cadastro->incluir();
        if ($result >= 1) {
            echo "<script>alert('Registro incluído com sucesso!');document.location='../view/clientes/index.php'</script>";
        } else {
            echo "<script>alert('Erro ao gravar registro! verifique se o cliente não está duplicado');history.back()</script>";
        }
    }
}
new cadastroclienteController();
