<?php
require_once("../model/bancoCliente.php");
class deleta {
    private $deleta;

    public function __construct($id){        
        $this->deleta = new BancoCliente();
        if($this->deleta->deleteCliente($id)== TRUE){
            echo "<script>alert('Registro deletado com sucesso!');document.location='../view/clientes/index.php'</script>";
        }else{
            echo "<script>alert('Erro ao deletar registro!');history.back()</script>";
        }
    }
}

new deleta($_GET['id']);
?>
