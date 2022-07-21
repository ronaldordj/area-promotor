<?php
require_once("../../model/init.php");


// Include database config file
$db = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);
        
// Get search term
$searchTerm = $_GET['term'];

session_start();
$mascara = $_SESSION['usuarioMascara'];

// Get matched data from the database
$query = "SELECT cd_cliente.Id, Nomefantasia, Razaosocial, Cnpjcpf, Inscestadual, cd_cliente.Email, Emailvalida, cd_cliente.Telefone, Celular, 
                 Endereco, Cep, Bairro, Complemento, Cidade, Idestado, cd_estado.Sigla, coalesce(cd_estado.Nome, '') as 'Estado', cd_cliente.Idpais, cd_pais.Nome as Pais 
		  FROM cd_cliente
		  LEFT OUTER join cd_estado on (cd_cliente.Idestado = cd_estado.Id)
		  LEFT OUTER join cd_pais on (cd_cliente.Idpais = cd_pais.Id)
		  LEFT OUTER join cd_usuario on (cd_cliente.Iddistribuidor = cd_usuario.Id)
		  WHERE Nomefantasia LIKE '%$searchTerm%'
		    AND coalesce(cd_usuario.mascara, '') like '$mascara%' ";
$result = $db->query($query);

//print_r($result);

// Generate users data array
$userData = array();
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $name                = $row['Nomefantasia'];
        $data['codigo']      = $row['Id'];
		$data['nome']        = $row['Nomefantasia'];
        $data['razao']       = $row['Razaosocial']; 
		$data['documento']   = $row['Cnpjcpf'];
		$data['ie']          = $row['Inscestadual'];
		$data['email']       = $row['Email'];
		$data['telefone']    = $row['Telefone'];
		$data['celular']     = $row['Celular'];
		$data['endereco']    = $row['Endereco'];
		$data['cep']         = $row['Cep'];
		$data['bairro']      = $row['Bairro'];
		$data['complemento'] = $row['Complemento'];
		$data['cidade']      = $row['Cidade'];
		$data['estado']      = utf8_encode($row['Estado']);
		$data['pais']        = $row['Pais'];
		$data['codestado']   = $row['Idestado'];
		$data['codpais']     = $row['Idpais'];
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