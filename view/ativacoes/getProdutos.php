<?php
require_once("../../model/init.php");


// Include database config file
$db = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);
        
// Get search term
$searchTerm = $_GET['term'];
session_start();

// Get matched data from the database
$query = "SELECT al_produto.id as id, al_produto.descricao as produto, al_prodmodelo.descricao as modelo, al_prodlinha.descricao as linha, al_produto.idproduto as cod, nome_imagem 
            FROM al_produto 
		    LEFT OUTER JOIN al_prodmodelo ON (al_produto.Idmodelo = al_prodmodelo.Id)
		    LEFT OUTER JOIN al_prodlinha  ON (al_produto.Idlinha = al_prodlinha.Id)            
           WHERE al_produto.Descricao LIKE '%$searchTerm%'
		   ORDER BY al_produto.id";
$result = $db->query($query);

// Generate users data array
$userData = array();
if($result->num_rows > 0){
    
    
    while($row = $result->fetch_assoc()){
        $caminho = "../../../produto/listagem/thumbs/";
        $foto = $caminho . $row['nome_imagem'];                                       
                                        
        $name = utf8_encode($row['produto']).' '.utf8_encode($row['modelo']);
        //$data['id']    = $row['linha'];
        $data['value'] = $name;		
        $data['codigo'] = $row['id']; 
        $data['label'] = '        
		<table class="table table-striped">
				<tr>
					<td><img src="'.$foto.'" width="90" height="90"/></td>
					<td><span>'.$name.'</span></td>
				</td>
			</table>';
        array_push($userData, $data);		
    }
}

// Return results as json encoded array
echo json_encode($userData);
//print_r($userData);
?>