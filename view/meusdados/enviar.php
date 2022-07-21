<?php

$Remetente    = $_POST['remetente'];	// Pega o valor do campo Remetente
$Destinatario = $_POST['destinatario'];	// Pega o valor do campo Destinatário

$smtp         = 'server1.infodataweb.com.br';
$porta        = $_POST['porta'];
$seguranca    = $_POST['seguranca'];
$senha        = 'YTFiMmMzZDRmNWc2';

$key          = MD5($senha);
$usuario      = $_POST['usuario'];

//echo $Remetente.'<br>'.$Destinatario.'<br>'.$smtp.'<br>'.$porta.'<br>'.$seguranca.'<br>'.$senha.'<br>'.$usuario.'<br>';

include("../../phpmailer/class.phpmailer.php");
include("../../phpmailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded
include "../../model/bancoUsuario.php";

$mail  = new PHPMailer();

$body = '
		<body style="margin: 10px;">
		<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
			<div align="left"><img src="https://movelin.com.br/wp-content/uploads/2019/09/logo-movel-in.png" style="height: 100px; width: 100px"></div><br>
			<br>
			Caro usuário '.$usuario.'. <br> <br>
			<b>Para alterar sua senha de acesso à Área do Distribuidor, clique no link a seguir:</b> <br>
			Clique <a href="http://inmes.com.br/area-distribuidor/controller/alterarSenhaUsuario.php?key='.$key.'"  target="_blank"><b>aqui</b></a> para alterar sua senha.<br>
		</div>
		</body>
';

/*$body = '	
	<body style="margin: 10px;">
		<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
		<div align="center"><img src="../../images/logo.png" style="height: 100px; width: 100px"></div><br>
		<br>
			Caro Usuário '.$usuario.'. <br>
		<br>
		Para alterar sua senha de acesso à Área do Distribuidor, clique no link a seguir: <br> <br />
		
		Clique <a href="http://server.infodataweb.com.br/~inmescom/area-distribuidor/controller/alterarSenhaUsuario.php?id='.$key'"  target="_blank"><b>aqui</b></a> para alterar sua senha.<br>
		<br>
		
		</div>		
	</body>';*/


$mail->IsSMTP();
$mail->SMTPAuth   = true;            // enable SMTP authentication
$mail->SMTPSecure = $seguranca;      // sets the prefix to the servier
$mail->Host       = $smtp;           // sets GMAIL as the SMTP server
$mail->Port       = $porta;          // set the SMTP port
//$mail->SMTPDebug = 2;
$mail->Username   = $Remetente;  // GMAIL username
$mail->Password   = base64_decode($senha);// GMAIL password

$mail->From       = $Remetente;
$mail->FromName   = "Movel In";
$mail->Subject    = "Area do Cliente - Alterar Senha do Usuario";
//$mail->AltBody    = "Alterar a Senha do Usuário"; //Text Body
$mail->WordWrap   = 50; // set word wrap

$mail->MsgHTML(utf8_decode($body));

//$mail->AddReplyTo($Remetente,utf8_decode("Orçamento Inmes Industrial Ltda"));


$mail->AddAddress($Destinatario,"Usuário");

$mail->IsHTML(true); // send as HTML

if(!$mail->Send()) {
  echo "Erro no envio do e-mail: " . $mail->ErrorInfo;
} else {	
 	 echo"<script language='javascript' type='text/javascript'>alert('Instruções para substituir a senha foram enviadas ao seu e-mail!');window.location.href='index.php';</script>";
}

?>
