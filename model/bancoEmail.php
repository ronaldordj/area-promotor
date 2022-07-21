<?php

require_once("init.php");

class BancoEmail
{

    protected $mysqli;

    public function __construct()
    {
        $this->conexao();
    }

    private function conexao()
    {
        $this->mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function getEmail($tipo)
    {
        $result = $this->mysqli->query("SELECT * FROM cd_emailenvio WHERE Ativo = 1 AND Tipo = '$tipo'");
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $row;
        }
        return $array;
    }    
}
?>