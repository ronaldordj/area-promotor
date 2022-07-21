<?php	
	include '../config/conecta.php';	
	
	$fantasia        = $_POST['fantasia'];
	$razao           = $_POST['razao'];	
	$cnpjcpf	     = $_POST['cnpjcpf'];
	$inscestadual    = $_POST['ie'];
	$email           = $_POST['email'];
	$emailvalida     = $_POST['repitaEmail'];
	$telefone        = $_POST['telefone'];
	$celular         = $_POST['celular'];
	$contato         = $_POST['contato'];	
	$endereco        = $_POST['endereco'];
	$cep             = $_POST['cep'];
	$bairro          = $_POST['bairro'];
	$complemento     = $_POST['complemento'];
	$cidade          = $_POST['cidade'];
	$idestado        = $_POST['estado'];	
	$idpais          = $_POST['pais'];
	$iddistribuidor  = $_POST['distribuidor'];	
	
	$sql="select max(id) as maior from cd_cliente";
	$sql_result=mysqli_query($conexao,$sql)or die("Erro:".mysqli_error($conexao));
	$row=mysqli_fetch_array($sql_result);			
	$id = $row['maior']+1;	
	
	$queryInsercao = "INSERT INTO cd_cliente (Id, Nomefantasia, Razaosocial, Cnpjcpf, Inscestadual, Email, Emailvalida, Telefone,  Celular, Endereco, Cep, Bairro, Complemento, Cidade, idEstado, idPais, idDistribuidor, Ativo, NomeContato, Distrib) 
	VALUES ($id, '$fantasia', '$razao', '$cnpjcpf', '$inscestadual', '$email', '$emailvalida', '$telefone', '$celular', '$endereco', '$cep', '$bairro', '$complemento', '$cidade', $idestado, $idpais, $iddistribuidor, 1, $contato, $iddistribuidor)";
	@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao inserir o registro. Tente novamente." .mysqli_error($conexao));	
	echo "<script>alert('Cliente cadastrado com sucesso!'),location.href='../listas/cliente.php'</script>";
	
 ?>