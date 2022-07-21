<?php	
	include '../config/conecta.php';
	
	$id           = $_POST['id'];
	$email        = $_POST['email'];	
	$tipo         = $_POST['tipo'];
	$ativo        = $_POST['ativo']; 

	$queryInsercao = "UPDATE mi_emailrecebe SET 
						Email = '$email',						
						Tipo = '$tipo',
						Ativo = '$ativo'
					WHERE 
						id = $id";
	@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
	echo "<script>alert('E-mail atualizado com sucesso!'),location.href='../listas/emailrecebe.php'</script>";
	
	
 ?>