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
		$dataatualizacao = date('d/m/Y', strtotime($ativacao['Dataatualizacao']));
		$solicitacao = $ativacao['Id'];
		$status = $ativacao['Status'];
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

	switch ($status) {
		case 0:
			$atual = "Solicitação Recebida";
			break;
		case 1:
			$atual = "Contato com o cliente realizado";
			break;
		case 2:
			$atual = "Implantação Agendada";
			break;
		case 3:
			$atual = "Implantação Finalizada";
			break;	
	}
	
	//$body = file_get_contents('contents.php');
	$body = '
		<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			
		</head>	
		<body style="margin: 10px;">
			<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">				
				<br>
				<br>
				<br>Olá '.$usuario.',
				<br>
				<br>Informamos que a solicitação de ativação de produto nº '.$solicitacao.' teve seu Status alterado para <strong>'.$atual.'</strong> em '.$dataatualizacao.'
				<br>
				<br>Chave: <strong>' . $chave . '</strong>
				<br>Produto: <strong>' . $produto. '</strong>
				<br><strong>' . utf8_encode($modalidade) . '</strong>
				<br>Cliente: <strong>'.$cliente.'</strong>
				<br>
				<br>***Não é necessário responder a esta mensagem***
				<br>				
				<br>Atenciosamente,
				<br>
				<table>
					<tr>
						<th><img src="../../public/svgs/rodape-email.png"></th>
						<th>Movel In, Inmes Industrial</th>
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
	$mail->FromName   = utf8_decode("Alteração de Status");
	$mail->Subject    = utf8_decode("A solicitação de ativação de produto nº ".$solicitacao." foi alterada");
	//$mail->AltBody    = utf8_decode($Mensagem); //Text Body
	$mail->WordWrap   = 50; // set word wrap

	$mail->MsgHTML(utf8_decode($body));	

	$mail->AddAddress($emailusu, $usuario);

	$mail->IsHTML(true); // send as HTML

	if (!$mail->Send()) {
		echo "Erro no envio: " . $mail->ErrorInfo;
	} else {	
		echo "<script>location.href='../../gerenciar/listas/ativacoes.php'</script>";
	}