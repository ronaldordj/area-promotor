<?php
require_once("../model/bancoUsuario.php");
class deleta {
    private $deleta;

    public function __construct($id){        
        $this->deleta = new bancoUsuario();
        if($this->deleta->deleteUsuario($id)== TRUE){
            echo "<script>alert('Registro deletado com sucesso!');document.location='../view/usuarios/index.php'</script>";
        }else{
            echo "<script>alert('Erro ao deletar registro!');history.back()</script>";
        }
    }
}

new deleta($_GET['id']);
?>
