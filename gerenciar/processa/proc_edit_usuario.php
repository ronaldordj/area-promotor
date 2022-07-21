<?php	
	include '../config/conecta.php';
	
	$nome         = $_POST['nome'];
	$email        = $_POST['email'];	
	$idusuario    = $_POST['idusuario'];
	$funcao       = $_POST['funcao'];
	$papel        = $_POST['papel'];
	$telefone     = $_POST['telefone'];
	$ativo        = $_POST['ativo'];
	$distrib      = $_POST['iddistrib'];

	//echo $nome.'<br>'.$email.'<br>'.$idusuario.'<br>'.$funcao.'<br>'.$papel.'<br>'.$telefone.'<br>'.$ativo.'<br>'.$distrib

	$queryInsercao = "UPDATE cd_usuario SET 
						Nome           = '$nome', 						
						Email          = '$email', 						
						Funcao         = '$funcao',
						Telefone       = '$telefone',
						Ativo          =  $ativo,
						DistribuidorId =  $distrib,
						Tipo           =  $papel
					WHERE 
						Id = $idusuario";
	@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
	echo "<script>alert('Usuário atualizado com sucesso!'),location.href='../listas/usuario.php'</script>";
 ?>