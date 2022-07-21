<?php
require_once("../model/cadastroConfigEmail.php");
class cadastroconfigemailController
{

    private $cadastroConfigEmail;

    public function __construct()
    {
        $this->cadastro = new Cadastroconfigemail();
        $this->incluir();
    }

    private function incluir()
    {
        $this->cadastro->setSmtp($_POST['smtp']);
        $this->cadastro->setPorta($_POST['porta']);
        $this->cadastro->setUsuario($_POST['usuario']);        
        $this->cadastro->setSenha(base64_encode($_POST['senha']));
        $this->cadastro->setSeguranca($_POST['seguranca']);
		$this->cadastro->setIdusuario($_POST['idusuario']);       
		

        $result = $this->cadastro->editar();
        if ($result >= 1) {            
			echo "<script>alert('Registro incluso com sucesso!');document.location='../view/meusdados"'</script>";
        } else {
            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";
        }
    }
}
new cadastroconfigemailController();
