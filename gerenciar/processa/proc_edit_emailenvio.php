<?php	
	include '../config/conecta.php';
	
	$id           = $_POST['id'];
	$email        = $_POST['email'];
	$senha        = base64_encode( $_POST['senha'] );
	$smtp         = $_POST['smtp'];
	$porta        = $_POST['porta'];
	$seguranca    = $_POST['seguranca'];
	$tipo         = $_POST['tipo'];
	$ativo        = $_POST['ativo']; 

	$queryInsercao = "UPDATE mi_emailenvio SET 
						Email = '$email',
						Smtp  = '$smtp', 
						Porta = '$porta',
						Seguranca = '$seguranca',
						Senha = '$senha',
						Tipo  = '$tipo',
						Ativo = '$ativo'
					WHERE 
						Id = $id";
	@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
	echo "<script>alert('E-mail atualizado com sucesso!'),location.href='../listas/emailenvio.php'</script>";
	
	
 ?>