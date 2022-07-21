<?php
class regiao
{
    private $regiao;    

    public function __construct()
    {
        $this->setregiao();
    }

    private function setregiao()
    {
        session_start();
        $idregiao = $_POST['idregiao'];
        if ($idregiao > 0) {
            session_start();
            $_SESSION['id-regiao'] = $idregiao;
        }
    }
}

new regiao();
