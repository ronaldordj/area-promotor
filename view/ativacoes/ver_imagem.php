<?php
require_once("../../model/init.php");


// Include database config file
$db = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);

	$idproduto = $_GET['id'];
	$querySelecionaPorCodigo = "SELECT Idproduto,imagem FROM inmesanexo.al_prodimagem WHERE Idproduto = $idproduto";
	$resultado = mysqli_query($db,$querySelecionaPorCodigo);
	$imagem = mysqli_fetch_object($resultado);
	Header( "Content-type: image/gif");
	echo $imagem->imagem;
?>