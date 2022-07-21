<?php 
 require_once("../../model/init.php");


// Include database config file
$db = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);
        
// Get search term
$idPais = $_GET['pais'];


// Get matched data from the database
	if ($idPais == 4) {
		$query = "SELECT Id, Nome
					FROM cd_estado            
				   WHERE idpais = $idPais";
		$result = $db->query($query);
		}
	else {
		$query = "SELECT Id, Nome
					FROM cd_estado            
				   WHERE idpais = 99";
		$result = $db->query($query);
	}

	while($row = $result->fetch_assoc()){	
		echo "<option value=".$row['Id'].">".utf8_encode($row['Nome'])."</option>";
	}	
?>