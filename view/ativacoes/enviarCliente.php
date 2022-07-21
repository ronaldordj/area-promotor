<?php

$codigo       = base64_decode($_GET['id']);

include("../../phpmailer/class.phpmailer.php");
include("../../phpmailer/class.smtp.php"); 
include("../../model/bancoAtivacao.php");

$banco = new BancoAtivacao();
$mail  = new PHPMailer();

$ativacoes = $banco->getAtivacao($codigo);
	foreach ($ativacoes as $ativacao) {
		$datacriacao = date('d/m/Y', strtotime($ativacao['Datacriacao']));
		$statusemail = $ativacao['Statusemail'];
	}

$array = $banco->getClienteAtivacao($codigo);
	foreach ($array as $linha) {		
		$Destinatario = $linha['Email'];	
		$contato      = $linha['NomeContato'];

		$fantasia     = $linha['Nomefantasia'];
		$cliente      = $linha['Razaosocial'];
		$documento    = $linha['Cnpjcpf'];
		$telefone     = $linha['Telefone'];
		$celular      = $linha['Celular'];
		$endereco     = $linha['Endereco'];
		$cep          = $linha['Cep'];
		$bairro       = $linha['Bairro'];
		$complemento  = $linha['Complemento'];       
		$cidade       = $linha['Cidade'];
		$estado       = $linha['Estado'];
		$pais         = $linha['Pais'];
	}

$produtos = $banco->getAtivacaoProduto($codigo);
	foreach ($produtos as $dados) {
		$produto    = $dados['produto'];
		$modalidade = $dados['modalidade'];
		$chave      = $dados['Chave'];
		$pdf        = $dados['PDF'];
	}

$usuarios = $banco->getUsuario($codigo);
	foreach ($usuarios as $info) {				
		$usuario      = $info['Usuario'];
		$distribuidor = $info['Distribuidor'];
		$distcidade   = $info['Cidade'];
		$distestado   = $info['UF'];
		$emailusu     = $info['Email'];
	}

$resultado = $banco->getEmail("A");
	$Remetente    = $resultado['Email'];
	$smtp         = $resultado['Smtp'];
	$porta        = $resultado['Porta'];
	$seguranca    = $resultado['Seguranca'];
	$senha        = base64_decode($resultado['Senha']);
	
	//$body = file_get_contents('contents.php');
	$body = '
		<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			
		</head>	
		<body style="margin: 10px;">
			<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
				<div>
					<img src="../../public/svgs/logo-azul.PNG" style="height: 75px; width: 276px">
				</div>			
				<br>Olá, '.$contato.'
				<br>
				<br>Agradecemos por ter escolhido o Otimizador de cortes Movel IN
				<br>
				<br>Nº da chave: <strong>' . $chave . '</strong>
				<br>Cliente: <strong>' . $cliente .' - '.$datacriacao. '</strong>
				<br>							
				<br><p>Para obter o melhor desempenho de nosso software, o departamento de pós-vendas da Movel IN desenvolveu um sistema de agendamento de implantação rápido e eficiente.</p>
				<br>
				<br><p>Para agilizar o processo, é necessário que alguns procedimnetos sejam seguidos. Em anexo segue arquivo PDF com todos os pré-requisitos 
				necessários para que seja possível implantar o seu Otimizador</p>
				<br>
				<br><strong>Em 24 horas a equipe de suporte da Movel IN entrará em contato para realizar o agendamento da implantação. Pedimos que os requisitos solicitados estejam, de acordo.</strong>
				<br>
				<br>Atenciosamente,
				<br>
				<table>
					<tr>
						<th><img src="../../public/svgs/rodape-email.png"></th>
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

	//$mail->SMTPDebug = 2;

	$mail->Username   = $Remetente;  // GMAIL username
	$mail->Password   = $senha; // GMAIL password

	$mail->From       = $Remetente;
	if ($statusemail == 0) {
		$mail->FromName   = utf8_decode("Liberação de Chave");
		$mail->Subject    = utf8_decode("Liberação de chave ".$chave." - InOptimus Movel IN");
	}
	else {
		$mail->FromName   = utf8_decode("REENVIO - Liberação de Chave");
		$mail->Subject    = utf8_decode("REENVIO Liberação de chave ".$chave." - InOptimus Movel IN");
	}
	
	//$mail->AltBody    = utf8_decode($Mensagem); //Text Body
	$mail->WordWrap   = 50; // set word wrap

	$mail->MsgHTML(utf8_decode($body));	

	$mail->AddReplyTo($emailusu, utf8_decode("Liberação de chave ".$chave." - InOptimus Movel IN"));

	$mail->AddAddress($Destinatario, $cliente);
	
	if ($pdf != "") {
		
		$mail->AddAttachment("../../public/requisitos/".$pdf);
	}

	$mail->IsHTML(true); // send as HTML

	if (!$mail->Send()) {
		echo "Erro no envio: " . $mail->ErrorInfo;
	} else {	
		$atv = base64_encode($codigo);
		echo "<script>location.href='enviarFornecedor.php?id=$atv'</script>";
	}