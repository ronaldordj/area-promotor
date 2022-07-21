<?php



require_once("init.php");



class BancoLogin{



    protected $mysqli;    



    public function __construct(){

        $this->conexao();

    }



    private function conexao(){

        $this->mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO , BD_SENHA, BD_BANCO);

        

        if ($this->mysqli->connect_error) {

            die("Connection failed: " . $this->mysqli->connect_error);

        }



    }    

    

    public function setLogin($email, $senha){

        

        $sql = $this->mysqli->query("SELECT pr.Id, pr.Nome 

                                       from mi_promotor pr                                       

                                       where pr.Ativo = 1

                                        and pr.Email = '$email'

                                        and pr.Senha = MD5('$senha')");

		$row = mysqli_fetch_array($sql);		
        
        $id = $row['Id'];
        $nome = $row['Nome'];
        
        if ( $id > 0) {

            session_start();

            $_SESSION['usuarioId'] = $id;

            $_SESSION['usuarioNome'] = $nome;

            return base64_encode($id);

        } else {

            return '0';            

        }



    }

}

?>