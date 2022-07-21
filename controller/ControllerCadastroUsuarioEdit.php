<?php
require_once("../model/cadastroUsuario.php");
class cadastrousuarioController
{

    private $cadastroUsuario;

    public function __construct()
    {
        $this->cadastro = new Cadastrousuario();
        $this->incluir();
    }

    private function incluir()
    {
        $this->cadastro->setId($_POST['id']);
        $this->cadastro->setNome($_POST['nome']);
        $this->cadastro->setEmail($_POST['email']);
        $this->cadastro->setFuncao($_POST['funcao']);
        $this->cadastro->setTelefone($_POST['telefone']);
        $this->cadastro->setSenha(md5($_POST['senha']));
        $this->cadastro->setSenhaValida(md5($_POST['repitaSenha']));
        $this->cadastro->setAtivo($_POST['status']);

        $result = $this->cadastro->editar();
        if ($result >= 1) {
            if ($_POST['meusdados'] == 1) {
                echo "<script>alert('Registro alterado com sucesso!');document.location='../index.php'</script>";
            }else {
                echo "<script>alert('Registro alterado com sucesso!');document.location='../view/usuarios/index.php'</script>";
            }            
        } else {
            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";
        }
    }
}
new cadastrousuarioController();
