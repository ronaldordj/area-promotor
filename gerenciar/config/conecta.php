<?php	 
  $conexao = mysqli_connect("187.102.40.34:3306", "inmes_bd2020dist", ";cL+Zu;0Nn[F");   
  if($conexao)
  {
  $baseSelecionada = mysqli_select_db($conexao,"inmes_bd2020dist");
  
  if (!$baseSelecionada) {
      die ('Não foi possível conectar a base de dados: ' . mysqli_error());
  } } else {
      die('Não conectado : ' . mysqli_error());
  }
?>