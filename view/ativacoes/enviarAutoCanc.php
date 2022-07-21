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
				<br>
				<br><strong>***O USUÁRIO CANCELOU A SOLICITAÇÃO DE ATIVAÇÃO DO PRODUTO***</strong>
				<br>
				<br>Solicitação de Implantação - Chave: <strong>' . $chave . '</strong>
				<br>Produto: <strong>' . $produto . '</strong>
				<br>Modalidade: <strong>' . utf8_encode($modalidade) . '</strong>
				<br>Data: <strong>' . $datacriacao . '</strong>
				<br>			
				<br><strong>Dados do Cliente</strong>
				<br>
				<br>Nome Fantasia: '.$fantasia.'
				<br>Razao Social: '.$cliente.'
				<br>CNPJ/CPF: '.$documento.'
				<br>E-mail: '.$Destinatario.'
				<br>Telefone Fixo: '.$telefone.'
				<br>Celular: '.$celular.'
				<br>Contato: '.$contato.'
				<br>Endereço: '.$endereco.'
				<br>Bairro: '.$bairro.'
				<br>Complemento: '.$complemento.'
				<br>CEP: '.$cep.'
				<br>Cidade: '.$cidade.'
				<br>Estado: '.$estado.'
				<br>País: '.$pais.'
				<br>
				<br>Distribuidor: '.$distribuidor.'
				<br>Cidade: '.utf8_encode($distcidade).'
				<br>Estado: '.$distestado.'
				<br>Usuário: '.$usuario.'			
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
	$mail->FromName   = utf8_decode("Solicitação CANCELADA InOptimus");
	$mail->Subject    = utf8_decode("Solicitação CANCELADA InOptimus chave ".$chave." - Movel IN");
	//$mail->AltBody    = utf8_decode($Mensagem); //Text Body
	$mail->WordWrap   = 50; // set word wrap

	$mail->MsgHTML(utf8_decode($body));	

	$mail->AddReplyTo($emailusu, utf8_decode("Solicitação CANCELADA InOptimus chave ".$chave." - Movel IN"));

	//$mail->AddAddress($Destinatario, $cliente);

	//Destinatário
	$copias = $banco->getEmailRecebe("A");
	foreach ($copias as $copia) {		
		$mail->AddAddress($copia['Email'], utf8_decode("Movel In"));
	}
	
	$mail->IsHTML(true); // send as HTML

	if (!$mail->Send()) {
		echo "Erro no envio: " . $mail->ErrorInfo;
	} else {
		$atv = base64_encode($codigo);
		echo "<script>location.href='enviarClienteCanc.php?id=$atv'</script>";
	}