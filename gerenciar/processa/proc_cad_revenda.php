<?php	
	include '../config/conecta.php';	
	
	$nome        = $_POST['nome'];	
	$email       = $_POST['email'];	
	$site        = $_POST['site'];	
	$telefone    = $_POST['telefone'];	
	$celular     = $_POST['celular'];	
	$endereco    = $_POST['endereco'];	
	$numero      = $_POST['numero'];	
	$complemento = $_POST['complemento'];	
	$bairro      = $_POST['bairro'];	
	$cep         = $_POST['cep'];	
	$cidade      = $_POST['cidade'];	
	$uf          = $_POST['uf'];
		
	$queryInsercao = "INSERT INTO mi_revenda (Nome, Email, Site, Telefone, Celular, Endereco, Numero, Complemento, Bairro, Cep, Cidade, Uf, Ativo) 
	                                  VALUES ('$nome', '$email', '$site', '$telefone', '$celular', '$endereco', '$numero', '$complemento', '$bairro', '$cep', '$cidade', '$uf', 1)";
	@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao inserir o registro. Tente novamente." .mysqli_error($conexao));
	echo "<script>alert('Revenda cadastrada com sucesso!'),location.href='../listas/revenda.php'</script>";
	
 ?>