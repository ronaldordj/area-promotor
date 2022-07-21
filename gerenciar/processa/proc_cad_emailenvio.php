<?php
include '../config/conecta.php';

$email        = $_POST['email'];
$senha        = base64_encode( $_POST['senha'] );
$smtp         = $_POST['smtp'];
$porta        = $_POST['porta'];
$seguranca    = $_POST['seguranca'];
$tipo         = $_POST['tipo'];

$queryInsercao = "INSERT INTO mi_emailenvio (Email, Smtp, Porta, Seguranca, Senha, Tipo, Ativo) VALUES ('$email', '$smtp', '$porta', '$seguranca', '$senha', '$tipo', 1)";
@mysqli_query( $conexao, $queryInsercao ) or die( 'Algo deu errado ao inserir o registro. Tente novamente.' .mysqli_error( $conexao ) );

echo "<script>alert('E-mail cadastrado com sucesso!'),location.href='../listas/emailenvio.php'</script>";

?>