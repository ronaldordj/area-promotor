<?php
require_once("../model/bancoAtivacao.php");
class reenvia {
    private $reenvia;

    public function __construct($id){        
        $this->reenvia = new BancoAtivacao();
        if($this->reenvia->reenviaEmail($id) == TRUE){
            $atv = base64_encode($id);
            echo "<script>document.location='../view/ativacoes/enviarAuto.php?id=" . $atv . "'</script>";
        }else{
            echo "<script>alert('Erro ao Reenviar o e-mail!');history.back()</script>";
        }
    }
}

new reenvia($_GET['id']);
?>
