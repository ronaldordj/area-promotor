<?php
require_once("../model/bancoOrcamento.php");
class enviar {
    private $enviar;

    public function __construct($id){        
        $this->enviar = new BancoOrcamento();
        $this->enviar->updateStatusEmailOrcamento($id, 1);
}

new enviar($_GET['id']);
?>