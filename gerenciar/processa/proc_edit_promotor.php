<?php	
	include '../config/conecta.php';
	
	$idpromotor         = $_POST['id'];
	$nome     		    = $_POST['nome'];	
	$email              = $_POST['email'];	
	$telefone		    = $_POST['telefone'];	
	$ativo              = $_POST['ativo'];	

	$queryInsercao = "UPDATE mi_promotor SET 
						Nome        = '$nome', 						
						Email       = '$email', 						
						Telefone    = '$telefone',												
						Ativo       =  $ativo 
					WHERE 
						Id = $idpromotor";
	@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
	echo "<script>alert('Promotor atualizado com sucesso!'),location.href='../listas/promotor.php'</script>";
	
	
 ?>