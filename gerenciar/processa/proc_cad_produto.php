<?php	
	include '../config/conecta.php';	
	
	$referencia     = $_POST['referencia'];
	$descricao  	= $_POST['descricao'];	

	$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
	$nomearq = $_FILES['arquivo']['name'];
	
	if(isset($_FILES['arquivo']['name']))
	{
		// Pega a extensao
		$extensao = strrchr($nomearq, '.');

		// Converte a extensao para mimusculo
		$extensao = strtolower($extensao);

		// Somente imagens, .jpg;.jpeg;.gif;.png
		// Aqui eu enfilero as extesões permitidas e separo por ';'
		// Isso server apenas para eu poder pesquisar dentro desta String
			strstr('.jpg;.jpeg;.png', $extensao);
		
			// Cria um nome único para esta imagem
			// Evita que duplique as imagens no servidor.
			$novoNome = md5(microtime()) . $extensao;
			
			// Concatena a pasta com o nome
			$destino = '../../public/fotosprodutos/' . $novoNome;		
			
			// tenta mover o arquivo para o destino
			@move_uploaded_file($arquivo_tmp, $destino);		
	}	
	

	if(isset($_FILES['pdf']['name'])) {

		//Arquivo PDF
		$arquivo_temp = $_FILES['pdf']['tmp_name'];
		$nomearqpdf   = $_FILES['pdf']['name'];

		// Pega a extensao
		$extensaopdf = strrchr($nomearqpdf, '.');

		// Converte a extensao para mimusculo
		$extensaopdf = strtolower($extensaopdf);

		// Somente imagens, .jpg;.jpeg;.gif;.png
		// Aqui eu enfilero as extesões permitidas e separo por ';'
		// Isso server apenas para eu poder pesquisar dentro desta String
			strstr('.pdf', $extensaopdf);
		
			// Cria um nome único para esta imagem
			// Evita que duplique as imagens no servidor.
			$novoPDF = md5(microtime()) . $extensaopdf;
			
			// Concatena a pasta com o nome
			$destinopdf = '../../public/requisitos/' . $novoPDF;		
			
			// tenta mover o arquivo para o destino
			@move_uploaded_file($arquivo_temp, $destinopdf);	
	}	
		
	$queryInsercao = "INSERT INTO mi_produto (Referencia, Descricao, Imagem, PDF, Status) 
	VALUES ('$referencia','$descricao','$novoNome','$novoPDF',1)";
	@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao inserir o registro. Tente novamente." .mysqli_error($conexao));	
	echo "<script>alert('Produto cadastrado com sucesso!'),location.href='../listas/produto.php'</script>";
	
 ?>