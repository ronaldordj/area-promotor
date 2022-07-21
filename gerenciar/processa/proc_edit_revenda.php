<?php	
	include '../config/conecta.php';
	
	$idrevenda          = $_POST['id'];
	$nome       		= $_POST['nome'];	
	$email              = $_POST['email'];
	$site               = $_POST['site'];
	$telefone		    = $_POST['telefone'];
	$celular            = $_POST['celular'];	
	$endereco     		= $_POST['endereco'];
	$numero     		= $_POST['numero'];
	$complemento	    = $_POST['complemento'];
	$bairro       		= $_POST['bairro'];	
	$cep          		= $_POST['cep'];
	$cidade       		= $_POST['cidade'];	
	$uf          		= $_POST['uf'];	
	$ativo              = $_POST['ativo'];	

	$queryInsercao = "UPDATE mi_revenda SET 
						nome        = '$nome', 						
						email       = '$email', 						
						site        = '$site',
						telefone    = '$telefone',						
						celular     = '$celular', 						
						endereco    = '$endereco', 
						numero      = '$numero', 						
						complemento = '$complemento', 
						bairro      = '$bairro', 
						cep         = '$cep', 
						cidade      = '$cidade', 
						uf          = '$uf',				
						ativo       = $ativo 
					WHERE 
						id = $idrevenda";
	@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
	echo "<script>alert('Revenda atualizada com sucesso!'),location.href='../listas/revenda.php'</script>";
	
	
 ?>