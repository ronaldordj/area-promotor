<?php
require_once("../model/bancoOrcamento.php");
class adicionar {
    private $orcamento;

    public function __construct($id){        
        $this->orcamento = new BancoOrcamento();
        $result = $this->orcamento->addOrcamentoEntrega($id);
        if($result > 0){
            echo "<script>document.location='../view/entregas/cadastroEntregas-edit.php?id=" . $result . "'</script>";
        }else{
            echo "<script>alert('Erro ao adicionar entrega!');history.back()</script>";
        }
    }
}

new adicionar($_GET['id']);
?>
