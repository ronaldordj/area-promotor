<?php	
	include '../config/conecta.php';	
	
	$idioma       = $_POST['idioma'];
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

	$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
	$nomearq = $_FILES['arquivo']['name'];
	

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
		$destino = '../logos/thumbs/' . $novoNome;
		$caminho = $diretorio.$novoNome;
		
		// tenta mover o arquivo para o destino
		@move_uploaded_file($arquivo_tmp, $destino);
	
	
	$sql="select max(id) as maior from cd_distribuidor";
	$sql_result=mysqli_query($conexao,$sql)or die("Erro:".mysqli_error($conexao));
	$row=mysqli_fetch_array($sql_result);		
	$id = $row['maior']+1;	
	
	$queryInsercao = "INSERT INTO cd_distribuidor (Id, Ididioma, Distribuidor, Email, Site, Telefone,  Celular, Endereco, Numero, Complemento, Bairro, Cep, Cidade, UF, Idpais, imglogo, usalogoinmes, Ativo) 
	VALUES ($id, $idioma, '$nome', '$email', '$site', '$telefone', '$celular', '$endereco', '$numero', '$complemento', '$bairro', '$cep', '$cidade', '$UF', $pais, '$novoNome', 0, 1)";
	@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao inserir o registro. Tente novamente." .mysqli_error($conexao));	
	echo "<script>alert('Distribuidor cadastrado com sucesso!'),location.href='../listas/distribuidor.php'</script>";
	
 ?>