<?php

require_once("init.php");

class BancoPais
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

    public function getPais()
    {
        $result = $this->mysqli->query("SELECT Id, Nome from cd_pais order by Nome");
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $row;
        }
        return $array;
    }    
	
	public function getPaisEdit($codpais)
    {
        $result = $this->mysqli->query("SELECT Id, Nome from cd_pais where Id <> $codpais order by Nome");
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $row;
        }
        return $array;
    }
}
?>