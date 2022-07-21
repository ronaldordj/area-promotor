<?php	
	include '../config/conecta.php';
	
	$id             = $_POST['id'];
	$referencia     = $_POST['referencia'];
	$descricao  	= $_POST['descricao'];
	$status         = $_POST['ativo'];

	if (isset($_FILES['arquivo']['name']) && isset($_FILES['pdf']['name']))
	{

		//Arquivo Imagem
		$arquivo_tmp = $_FILES['arquivo']['tmp_name'];		
		$nomearq     = $_FILES['arquivo']['name'];	
		$extensao = strrchr($nomearq, '.');	
		$extensao = strtolower($extensao);		
		//strstr('.jpg;.jpeg;.png', $extensao);
		$novoNome = md5(microtime()) . $extensao;						
		$destino  = '../../public/fotosprodutos/' . $novoNome;		
		@move_uploaded_file($arquivo_tmp, $destino);		

		//Arquivo PDF
		$arquivo_temp = $_FILES['pdf']['tmp_name'];
		$nomearqpdf   = $_FILES['pdf']['name'];
		$extensaopdf = strrchr($nomearqpdf, '.');
		$extensaopdf = strtolower($extensaopdf);
		strstr('.pdf', $extensaopdf);
		$novoPDF = md5(microtime()) . $extensaopdf;
		$destinopdf = '../../public/requisitos/' . $novoPDF;		
		@move_uploaded_file($arquivo_temp, $destinopdf);

		$queryInsercao = "UPDATE mi_produto SET 
							Referencia    = '$referencia',
							Descricao     = '$descricao',
							Imagem        = '$novoNome',
							PDF           = '$novoPDF',
							Status        = '$status'
					WHERE 
						Id = $id";
		@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
		echo "<script>alert('Produto atualizado com sucesso!!'),location.href='../listas/produto.php'</script>";	
	}
	else if (isset($_FILES['arquivo']['name']) && !isset($_FILES['pdf']['name'])) {
		//Arquivo Imagem
		$arquivo_tmp = $_FILES['arquivo']['tmp_name'];		
		$nomearq     = $_FILES['arquivo']['name'];	
		$extensao = strrchr($nomearq, '.');	
		$extensao = strtolower($extensao);		
		//strstr('.jpg;.jpeg;.png', $extensao);
		$novoNome = md5(microtime()) . $extensao;						
		$destino  = '../../public/fotosprodutos/' . $novoNome;		
		@move_uploaded_file($arquivo_tmp, $destino);

		$queryInsercao = "UPDATE mi_produto SET 
							Referencia    = '$referencia',
							Descricao     = '$descricao',
							Imagem        = '$novoNome',							
							Status        = '$status'
					WHERE 
						Id = $id";
		@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
		echo "<script>alert('Produto atualizado com sucesso!!'),location.href='../listas/produto.php'</script>";				
	}
	else if (!isset($_FILES['arquivo']['name']) && isset($_FILES['pdf']['name'])) {
		//Arquivo PDF
		$arquivo_temp = $_FILES['pdf']['tmp_name'];
		$nomearqpdf   = $_FILES['pdf']['name'];
		$extensaopdf = strrchr($nomearqpdf, '.');
		$extensaopdf = strtolower($extensaopdf);
		strstr('.pdf', $extensaopdf);
		$novoPDF = md5(microtime()) . $extensaopdf;
		$destinopdf = '../../public/requisitos/' . $novoPDF;		
		@move_uploaded_file($arquivo_temp, $destinopdf);

		$queryInsercao = "UPDATE mi_produto SET 
							Referencia    = '$referencia',
							Descricao     = '$descricao',							
							PDF           = '$novoPDF',
							Status        = '$status'
					WHERE 
						Id = $id";
		@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
		echo "<script>alert('Produto atualizado com sucesso!!'),location.href='../listas/produto.php'</script>";
	}
	else {

		$queryInsercao = "UPDATE mi_produto SET 
							Referencia    = '$referencia',
							Descricao     = '$descricao',							
							Status        = '$status'
					WHERE 
						Id = $id";
		@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
		echo "<script>alert('Produto atualizado com sucesso!!'),location.href='../listas/produto.php'</script>";	
	}
	
	
 ?>