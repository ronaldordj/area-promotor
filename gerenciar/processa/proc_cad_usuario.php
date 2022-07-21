<?php	
	include '../config/conecta.php';	
	
	$nome         = $_POST['nome'];
	$email        = $_POST['email'];
	$senha        = md5($_POST['senha']);
	$confsenha    = md5($_POST['confsenha']);
	$id           = $_POST['iddistribuidor'];
	$funcao       = $_POST['funcao'];
	$papel        = $_POST['papel'];
	$telefone     = $_POST['telefone'];	
	

	$sql = "SELECT MAX(Id) AS maior FROM cd_usuario";
	$sql_result=mysqli_query($conexao,$sql)or die("Erro:".mysqli_error($conexao));
    $row = mysqli_fetch_array($sql_result);
    $seq = $row['maior'] + 1;
	
	$vendedor = $id.'.'.$seq;

	if ($papel == 0) {
		$queryInsercao = "INSERT INTO cd_usuario (Id, Nome, Email, Funcao, Telefone, Senha, SenhaValida,  Ativo, CriadorId, DistribuidorId, Tipo) 
		                  VALUES ($seq, '$nome', '$email', '$funcao', '$telefone', '$senha', '$confsenha', 1, 1, $id, $papel)";
		@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao inserir o registro. Tente novamente." .mysqli_error($conexao));	
		echo "<script>alert('Usuário cadastrado com sucesso!'),location.href='../listas/usuario.php'</script>";	
	}
	else if ($papel == 1) {
		$queryInsercao = "INSERT INTO cd_usuario (Id, Nome, Email, Funcao, Telefone, Senha, SenhaValida,  Ativo, Mascara, CriadorId, DistribuidorId, Tipo) 
		                  VALUES ($seq, '$nome', '$email', '$funcao', '$telefone', '$senha', '$confsenha', 1, '$id', 1, $id, $papel)";
		@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao inserir o registro. Tente novamente." .mysqli_error($conexao));	
		echo "<script>alert('Usuário cadastrado com sucesso!'),location.href='../listas/usuario.php'</script>";	
	}
	else {
		$queryInsercao = "INSERT INTO cd_usuario (Id, Nome, Email, Funcao, Telefone, Senha, SenhaValida,  Ativo, Mascara, CriadorId, DistribuidorId, Tipo) 
						  VALUES ($seq, '$nome', '$email', '$funcao', '$telefone', '$senha', '$confsenha', 1, '$vendedor', 1, $id, $papel)";
		@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao inserir o registro. Tente novamente." .mysqli_error($conexao));	
		echo "<script>alert('Usuário cadastrado com sucesso!'),location.href='../listas/usuario.php'</script>";	
	}
	
	
 ?>