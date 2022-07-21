<?php

require_once("init.php");

class BancoEstado
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

    public function getEstado()
    {
        $result = $this->mysqli->query("SELECT Id, Codigouf, Nome, Sigla from cd_estado order by Nome");
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $array[] = $row;
        }
        return $array;
    }    		public function pesquisaEstado($pais){        			$result = $this->mysqli->query("SELECT * FROM cd_estado WHERE Idpais = $pais");            			while($row = $result->fetch_array(MYSQLI_ASSOC)){				$array[] = $row;			}			return $array;	}
}
?>