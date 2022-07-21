<?php	
	include '../config/conecta.php';
	
	$iddistrib    = $_POST['id'];
	$nome         = $_POST['nome'];	
	$email        = $_POST['email'];
	$site         = $_POST['site'];
	$telefone     = $_POST['telefone'];
	$celular      = $_POST['celular'];	
	$endereco     = $_POST['endereco'];	
	$numero       = $_POST['numero'];
	$bairro       = $_POST['bairro'];
	$complemento  = $_POST['complemento'];
	$cidade       = $_POST['cidade'];
	$cep          = $_POST['cep'];
	$UF           = $_POST['estado'];	
	$pais         = $_POST['pais'];
	$idioma       = $_POST['idioma'];	
	$ativo        = $_POST['ativo'];

	if($_FILES['arquivo']['name'] != "")
	{

		$arquivo_tmp = $_FILES['arquivo']['tmp_name'];		
		$nomearq     = $_FILES['arquivo']['name'];
		
	
		$extensao = strrchr($nomearq, '.');
	
		$extensao = strtolower($extensao);
		

		//strstr('.jpg;.jpeg;.png', $extensao);
		
		$novoNome = md5(microtime()) . $extensao;
						
		$destino  = '../logos/thumbs/' . $novoNome;		
		
		@move_uploaded_file($arquivo_tmp, $destino);

		$queryInsercao = "UPDATE cd_distribuidor SET 
						Ididioma      =  $idioma,
						Distribuidor  = '$nome',
						Email         = '$email', 
						Site          = '$site', 
						Telefone      = '$telefone',						
						Celular       = '$celular', 
						Endereco      = '$endereco', 
						Numero        = '$numero',
						Complemento   = '$complemento', 
						Bairro        = '$bairro',
						CEP           = '$cep', 
						Cidade        = '$cidade', 
						UF            = '$UF', 
						Idpais        =  $pais,
						imglogo       = '$novoNome',						
						Ativo         =  $ativo
					WHERE 
						Id = $iddistrib";
		@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	


		$queryAtualiza = "UPDATE inmes_inmes.distribuidor SET 						
						    nm_foto_logo = '$novoNome'										
						WHERE 
							id_distribuidor = $iddistrib";
		@mysqli_query($conexao,$queryAtualiza) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
		echo "<script>alert('Distibuidor atualizado com sucesso!!'),location.href='../listas/distribuidor.php'</script>";	
	}
	else {

		$queryInsercao = "UPDATE cd_distribuidor SET 
						Ididioma      =  $idioma,
						Distribuidor  = '$nome',
						Email         = '$email', 
						Site          = '$site', 
						Telefone      = '$telefone',						
						Celular       = '$celular', 
						Endereco      = '$endereco', 
						Numero        = '$numero',
						Complemento   = '$complemento', 
						Bairro        = '$bairro',
						CEP           = '$cep', 
						Cidade        = '$cidade', 
						UF            = '$UF', 
						Idpais        =  $pais,						
						Ativo         = $ativo
					WHERE 
						Id = $iddistrib";
		@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
		echo "<script>alert('Distibuidor atualizado com sucesso!'),location.href='../listas/distribuidor.php'</script>";	
	}
 ?>