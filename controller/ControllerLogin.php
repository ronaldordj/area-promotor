<?php
require_once("../model/login.php");
include("../mobile_device_detect.php");
class loginController
{
    private $login;

    public function __construct()
    {
        $this->login = new Login();
        $this->logar();
    }

    private function logar()
    {
        $this->login->setEmail($_POST['email']);
        $this->login->setSenha($_POST['senha']);

        $result = $this->login->logar();
        if ($result != '0') {            
            $mobile = mobile_device_detect();
            if ($mobile == TRUE) {
                echo "<script>alert('Login efetuado com sucesso!');document.location='../mobile/index.php?mascara=" . $result . "'</script>";
            }
            else {
                echo "<script>alert('Login efetuado com sucesso!');document.location='../index.php?mascara=" . $result . "'</script>";
            }
        } else {
            echo "<script>alert('E-mail e/ou senha inválido(s)');history.back()</script>";
        }
    }
}

new loginController();
