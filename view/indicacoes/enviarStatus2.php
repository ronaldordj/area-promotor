<?php

$indicacao       = base64_decode($_GET['ind']);

include("../../phpmailer/class.phpmailer.php");
include("../../phpmailer/class.smtp.php"); 
include("../../model/bancoIndicacao.php");

$banco = new BancoIndicacao();
$mail  = new PHPMailer();

$indicacoes = $banco->getAcompanhamento($indicacao);
	foreach ($indicacoes as $linha) {
		$datacriacao      = $linha['Datacontato'];
		$razaosocial      = $linha['Razaosocial'];		
		$idpromotor       = $linha['Idpromotor'];
		$motivointeresse  = $linha['Motivointeresse'];		
	}

$promotores = $banco->getPromotor($idpromotor);
	foreach ($promotores as $dados) {						
		$promotor           = $dados['Nome'];		
		$emailpromotor      = $dados['Email'];
		$telefonepromotor   = $dados['Telefone'];

	}

$resultado = $banco->getEmailEnvia("A");
	$Remetente    = $resultado['Email'];
	$smtp         = $resultado['Smtp'];
	$porta        = $resultado['Porta'];
	$seguranca    = $resultado['Seguranca'];
	$senha        = base64_decode($resultado['Senha']);
	
	//$body = file_get_contents('contents.php');
	$body = '
		<head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
			
		</head>	
		<body style="margin: 10px;">
			<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
				<div>
					<img src="../../public/svgs/logo-azul.PNG" style="height: 75px; width: 276px">
				</div>			
				<br>
				<br><strong>Número da Indicação: </strong>'.$indicacao.'				
				<br><strong>Cliente: </strong>'.$razaosocial.'
				<br><strong>Agendado apresentação: </strong>Não
				<br><strong>Motivo: </strong><p>'.$motivointeresse.'</p>
				<br>
				<br>Revenda: 				
				<br>Promotor: '.$promotor.'
				<br>
				<br>
				<br>
				<br><strong>Atenciosamente,</strong>
				<br>
				<br>'.$promotor.'
				<br>'.$telefonepromotor.'
				<br>'.$emailpromotor.'
				
			</div>		
		</body>
	';
			

	//$mail->charSet = "UTF-8";
	$mail->IsSMTP();
	$mail->SMTPAuth   = true;            // enable SMTP authentication
	$mail->SMTPSecure = $seguranca;      // sets the prefix to the servier
	$mail->Host       = $smtp;           // sets GMAIL as the SMTP server
	$mail->Port       = $porta;          // set the SMTP port

	//$mail->SMTPDebug = 2;

	$mail->Username   = $Remetente;  // GMAIL username
	$mail->Password   = $senha; // GMAIL password

	$mail->From       = $Remetente;
	// if ($statusemail == 0) {
	// 	$mail->FromName   = utf8_decode("Nova Indicação");
	// 	$mail->Subject    = utf8_decode("Indicação de Cliente - Movel IN");	
	// }
	// else {
	// 	$mail->FromName   = utf8_decode("REENVIO - Venda InOptimus");
	// 	$mail->Subject    = utf8_decode("REENVIO Venda InOptimus chave ".$chave." - Movel IN");	
	// }		

	$mail->FromName   = utf8_decode("Área do Promotor - Movel IN");
	$mail->Subject    = utf8_decode("Indicação - Cliente $razaosocial");	

	$mail->WordWrap   = 50; // set word wrap

	$mail->MsgHTML(utf8_decode($body));

	$mail->AddReplyTo($emailpromotor, $promotor);

	$mail->AddCC($emailpromotor, $promotor);

	//Destinatário
	$copias = $banco->getEmailRecebe("I");
	foreach ($copias as $copia) {		
		$mail->AddAddress($copia['Email'], "Área do Promotor - Movel IN");
	}
	
	$mail->IsHTML(true); // send as HTML

	if (!$mail->Send()) {
		echo "Erro no envio: " . $mail->ErrorInfo;
	} else {
		// $atv = base64_encode($codigo);
		// echo "<script>location.href='enviarCliente.php?id=$atv'</script>";
		echo "<script>alert('Indicação alterada com sucesso!');document.location='index.php'</script>";
	}