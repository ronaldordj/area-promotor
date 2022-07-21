<?php



require_once("init.php");



class BancoProdModalidade

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



    public function getModalidade()

    {

        $result = $this->mysqli->query("SELECT Id, Descricao from mi_produto_modalidade order by Descricao");

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

            $array[] = $row;

        }

        return $array;

    }    

}

?>