<?php
include '../config/conecta.php';

$email        = $_POST['email'];
$tipo         = $_POST['tipo'];

$queryInsercao = "INSERT INTO mi_emailrecebe (Email, Tipo, Ativo) VALUES ('$email', '$tipo', 1)";
@mysqli_query( $conexao, $queryInsercao ) or die( 'Algo deu errado ao inserir o registro. Tente novamente.' .mysqli_error( $conexao ) );

echo "<script>alert('E-mail cadastrado com sucesso!'),location.href='../listas/emailrecebe.php'</script>";

?>