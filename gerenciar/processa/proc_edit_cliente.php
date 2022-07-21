<?php	
	include '../config/conecta.php';
	
	$idcliente          = $_POST['id'];
	$fantasia     		= $_POST['fantasia'];
	$razao        		= $_POST['razao'];	
	$cnpj		  		= $_POST['cnpjcpf'];
	$ie  		        = $_POST['ie'];
	$email              = $_POST['email'];
	$repitaemail        = $_POST['repitaEmail'];
	$telefone		    = $_POST['telefone'];
	$celular            = $_POST['celular'];	
	$endereco     		= $_POST['endereco'];
	$bairro       		= $_POST['bairro'];
	$complemento	    = $_POST['complemento'];
	$cidade       		= $_POST['cidade'];
	$cep          		= $_POST['cep'];
	$estado        		= $_POST['estado'];
	$pais               = $_POST['pais'];	
	$ativo              = $_POST['ativo'];
	$contato            = $_POST['contato'];

	$queryInsercao = "UPDATE cd_cliente SET 
						nomefantasia = '$fantasia', 
						razaosocial = '$razao', 
						cnpjcpf = '$cnpj', 
						inscestadual = '$ie', 
						email = '$email', 
						emailvalida = '$repitaemail', 
						telefone = '$telefone',						
						celular = '$celular', 
						nomecontato = '$contato',
						endereco = '$endereco', 
						bairro = '$bairro', 
						complemento = '$complemento', 
						cidade = '$cidade', 
						cep = '$cep', 
						idestado = $estado, 
						idpais = $pais,						
						ativo = $ativo 
					WHERE 
						id = $idcliente";
	@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
	echo "<script>alert('Cliente atualizado com sucesso!'),location.href='../listas/cliente.php'</script>";
	
	
 ?>