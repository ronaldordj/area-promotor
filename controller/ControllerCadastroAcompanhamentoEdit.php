<?php

require_once("../model/cadastroAcompanhamento.php");

class cadastroacompanhamentoControllerEdit

{



    private $cadastroAcompanhamento;



    public function __construct()

    {

        $this->cadastro = new Cadastroacompanhamento();

        $this->editar();

    }



    private function editar()

    {        

        $this->cadastro->setIdindicacao($_POST['idindicacao']);      
        
        $this->cadastro->setDatacontato($_POST['datacontato']);
        
        
        $this->cadastro->setFlfechado($_POST['fechado']);
        if ($_POST['fechado'] == "S") {
            $this->cadastro->setMotivofechado("");
        }
        else {
            $this->cadastro->setMotivofechado($_POST['feed']);
        }
        
            
        $this->cadastro->setFlapresentacao($_POST['apresentacao']);   
        if ($_POST['apresentacao'] == "S") {
            $this->cadastro->setFlinteresse("");                  
            $this->cadastro->setMotivointeresse("");  
        }
        else {
            $this->cadastro->setFlinteresse($_POST['interesse']);              
            $this->cadastro->setMotivointeresse($_POST['motivo']);  
        }        

        $this->cadastro->setDataapresentacao($_POST['dataagendamento']);
        $this->cadastro->setFlinteresseapr($_POST['interesseA']);   
        if ($_POST['interesseA'] == "S") {            
            $this->cadastro->setMotivoapresentacao("");
            $this->cadastro->setDataproposta($_POST['dataagendamento']);               
        }
        else {            
            $this->cadastro->setMotivoapresentacao($_POST['motivo2']);   
            $this->cadastro->setDataproposta("");               
        }

        $indicacao    = base64_encode($_POST['idindicacao']);
        $datacontato  = $_POST['datacontato'];
        $apresentacao = $_POST['apresentacao'];
        $interesse    = $_POST['interesse'];
        $interesseapr = $_POST['interesseA'];
        $dataproposta = $_POST['dataagendamento'];
        $fechado      = $_POST['fechado'];

        

        $result = $this->cadastro->editar();        

        if ($result >= 1) {

            if ($datacontato !="" && $apresentacao =="N" && $interesse == "SI") {
                echo "<script>document.location='../view/indicacoes/enviarStatus1.php?ind=$indicacao'</script>";
            }
            elseif ($datacontato !="" && $apresentacao =="N" && $interesse == "OU") {
                echo "<script>document.location='../view/indicacoes/enviarStatus2.php?ind=$indicacao'</script>";
            }
            elseif ($datacontato !="" && $apresentacao =="S" && $interesseapr == "N") {
                echo "<script>document.location='../view/indicacoes/enviarStatus3.php?ind=$indicacao'</script>";
            }
            elseif ($datacontato !="" && $apresentacao =="S" && $dataproposta != "" && $fechado == "N") {
                echo "<script>document.location='../view/indicacoes/enviarStatus4.php?ind=$indicacao'</script>";
            }
            else {
                echo "<script>alert('Indicação atualizada com sucesso!');document.location='../view/indicacoes/index.php'</script>";
            }           
            

        } else {

            echo "<script>alert('Erro ao gravar registro!');history.back()</script>";

        }

    }

}

new cadastroacompanhamentoControllerEdit();

