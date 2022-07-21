<?php
require_once("../model/bancoAtivacao.php");
class cancela {
    private $cancela;

    public function __construct($id){        
        $this->cancela = new BancoAtivacao();
        if($this->cancela->cancelaAtivacao($id)== TRUE){
            $atv = base64_encode($id);
            echo "<script>document.location='../view/ativacoes/enviarAutoCanc.php?id=" . $atv . "'</script>";
        }else{
            echo "<script>alert('Erro ao cancelar registro!');history.back()</script>";
        }
    }
}

new cancela($_GET['id']);
?>
