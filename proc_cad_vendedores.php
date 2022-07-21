<?php	
	include '../config/conecta.php';
	
	$idvendedor         = $_POST['id'];
	$nome        		= $_POST['nome'];
	$cpfcnpj      		= $_POST['cpfcnpj'];
	$email        		= $_POST['email'];
	$seller        		= $_POST['seller_id'];	
	$marketplace   		= $_POST['marketplace'];
	$perc_split    		= $_POST['perc_split'];
	$perc_taxa    		= $_POST['perc_taxa'];
	$ativo              = $_POST['ativo'];		

	$queryInsercao = "UPDATE secundarios SET 
						seller_id_usu 		= '$marketplace',
						nome          		= '$nome', 
						email_sec     		= '$email',
						cpf_cnpj      		= '$cpfcnpj',
						seller_id_sec 		= '$seller',
						percent_split 		= '$perc_split',
						percent_split_taxa 	= '$perc_taxa',
						ativo         		=  $ativo,
						alterado            = now()
					WHERE 
						id_secundarios = $idvendedor";
	@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao atualizar o registro. Tente novamente." .mysqli_error($conexao));	
	echo "<script>alert('Vendedor atualizado com sucesso!'),location.href='../listas/vendedores.php'</script>";
	
	
 ?>