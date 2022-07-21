<?php	
	include '../config/conecta.php';
	
	$id             = $_POST['id'];	

	if($_FILES['arquivo']['name'] != "")
	{

		$arquivo_tmp = $_FILES['arquivo']['tmp_name'];		
		$nomearq     = $_FILES['arquivo']['name'];
		
	
		$extensao = strrchr($nomearq, '.');
	
		$extensao = strtolower($extensao);
		

		//strstr('.jpg;.jpeg;.png', $extensao);
		
		$novoNome = md5(microtime()) . $extensao;
						
		$destino  = '../../public/banner/' . $novoNome;		
		
		@move_uploaded_file($arquivo_tmp, $destino);		

		$queryInsercao = "UPDATE mi_banner SET 						
						Imagem        = '$novoNome'						
					WHERE 
						Id = $id";
		@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
		echo "<script>alert('Imagem atualizada com sucesso!!'),location.href='../listas/paginainicial.php'</script>";	
	}	
 ?>