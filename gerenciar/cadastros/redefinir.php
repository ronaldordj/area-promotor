<?php
include '../config/conecta.php';

$Destinatario = base64_decode($_GET['key']);
$id           = base64_decode($_GET['token']);

$sql = "SELECT * FROM mi_emailenvio WHERE Ativo = 1 AND Tipo = 'R'";
$sql_result=mysqli_query($conexao,$sql)or die("Erro:".mysqli_error($conexao));
$row=mysqli_fetch_array($sql_result);		

$Remetente  = $row['Email'];
$smtp       = $row['Smtp'];
$porta      = $row['Porta'];
$seguranca  = $row['Seguranca'];
$senha      = $row['Senha'];

include("../phpmailer/class.phpmailer.php");
include("../phpmailer/class.smtp.php");

$mail  = new PHPMailer();

$body = '
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>		
	<body style="margin: 10px;">
		<div>
			<img src="../../public/svgs/logo-azul.PNG" style="height: 75px; width: 276px">
		</div>
		<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
		<br>
		Caro usuário, conforme solicitado à nossa equipe, segue o link para que possa redefinir sua senha de acesso a Área do Distribuidor Movel In. <br><br><br />
		
		Clique <a href="https://movelin.com.br/painel-admin/processa/proc_redefinirSenha.php?id='.base64_encode($id).'&visu=2"  target="_blank"><b>aqui</b></a> para redefinir sua senha.<br>
		<br><br><br>
		<table>
			<tr>
				<th><img src="../../public/svgs/rodape-email.PNG"></th>
				<th>Equipe Movel In</th>
			</tr>
		</table>		
		</div>		
	</body>		
	';	

$mail->IsSMTP();
$mail->SMTPAuth   = true;            // enable SMTP authentication
$mail->SMTPSecure = $seguranca;      // sets the prefix to the servier
$mail->Host       = $smtp;           // sets GMAIL as the SMTP server
$mail->Port       = $porta;          // set the SMTP port

$mail->Username   = $Remetente;  // GMAIL username
$mail->Password   = base64_decode($senha);// GMAIL password

$mail->From       = $Remetente;
$mail->FromName   = utf8_decode("Movel IN");
$mail->Subject    = utf8_decode("Redefinir Senha - Área Distribuidor Movel IN");
$mail->WordWrap   = 50; // set word wrap

$mail->MsgHTML(utf8_decode($body));

$mail->AddReplyTo($row['Email'],"Movel In");

$mail->AddAddress($Destinatario,$usuario);

$mail->IsHTML(true); // send as HTML

if(!$mail->Send()) {
  echo "Erro no envio: " . $mail->ErrorInfo;
} else {	
 	 echo"<script language='javascript' type='text/javascript'>alert('Foi enviado um e-mail ao usuário!');window.location.href='../listas/usuario.php';</script>";
}

?>