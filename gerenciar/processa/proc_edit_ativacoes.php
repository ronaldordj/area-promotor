<?php	
	include '../config/conecta.php';
	
	$id                 = $_POST['id'];	
	$status	            = $_POST['status'];
	$data = date('Y-m-d');

	$atv = base64_encode($id);

	$queryInsercao = "UPDATE mi_ativacao SET Status = $status, Dataatualizacao = '$data' WHERE Id = $id";
	@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
	echo "<script>alert('Registro atualizado com sucesso!'),location.href='../../view/ativacoes/enviarUsuario.php?id=$atv'</script>";
	
	
 ?>