<?php
include '../config/conecta.php';

// Get search term
$searchTerm = $_GET['term'];

// Get matched data from the database
$query = "SELECT Id, Distribuidor
            FROM cd_distribuidor            
            WHERE Distribuidor LIKE '%$searchTerm%'";
$result = $conexao->query($query);

// Generate users data array
$userData = array();
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $name = utf8_encode($row['Distribuidor']);
        $data['codigo']  = $row['Id'];		
        $data['value']   = $name;		
        $data['label']  = '<table class="table table-striped">
				<tr>					
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