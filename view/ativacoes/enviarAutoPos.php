<?php

$codigo       = $_GET['id'];
$emaild       = $_GET['email'];


include("../../phpmailer/class.phpmailer.php");
include("../../phpmailer/class.smtp.php"); 
include("../../model/bancoEntrega.php");

$banco = new BancoEntrega();
$mail  = new PHPMailer();


function mask($val, $mask)
{
	$maskared = '';
	$k = 0;
	for($i = 0; $i<=strlen($mask)-1; $i++)
	{
	if($mask[$i] == '#')
	{
	if(isset($val[$k]))
	$maskared .= $val[$k++];
	}
	else
	{
	if(isset($mask[$i]))
	$maskared .= $mask[$i];
	}
	}
	return $maskared;
}			
				

$array = $banco->pesquisaClienteDados($codigo);
	foreach ($array as $linha) {
		$idcliente     = $linha['IdCliente'];
		$nomefantasia  = $linha['Nomefantasia'];
		$razaosocial   = $linha['Razaosocial'];
		$cnpjcpf       = $linha['Cnpjcpf'];
		$inscestadual  = $linha['Inscestadual'];
		$email         = $linha['Email'];	
	    $telefone      = $linha['Telefone'];		
		$celular       = mask($linha['Celular'],'(##)#####-####');
		$endereco      = $linha['Endereco'];
		$bairro        = $linha['Bairro'];
		$cep           = mask($linha['Cep'],'##.###-###');
		$complemento   = $linha['Complemento'];
		$cidade        = $linha['Cidade'];
		$estado		   = $linha['estado'];
		$pais          = $linha['pais'];
		$orcamento     = $linha['IdOrcamento'];
		$responsavel   = $linha['ResponsavelEntrega'];
		$observacao    = $linha['Observacao'];
		$usuario       = utf8_encode($linha['usuario']);
		$distribuidor  = utf8_encode($linha['distribuidor']);
		$distcidade    = utf8_encode($linha['distcidade']);
		$distestado    = $linha['distestado'];
	}

	if (strlen($telefone) == 11) {
		$fixo = mask($telefone,'(##)#####-####');
	}
	else {
		$fixo = mask($telefone,'(##)####-####');
	}

	if (strlen($cnpjcpf) > 11) {
		$cgc = mask($linha['Cnpjcpf'],'##.###.###/####-##');		
	}
	else {
		$cgc = mask($linha['Cnpjcpf'],'###.###.###-##');
	}

$resultado = $banco->getEmail("E");
	$Remetente    = $resultado['Email'];
	$smtp         = $resultado['Smtp'];
	$porta        = $resultado['Porta'];
	$seguranca    = $resultado['Seguranca'];
	$senha        = $resultado['Senha'];	

$pessoaContato = $banco->getPessoaContato($idcliente);
	$contato = $pessoaContato['NomeContato'];

if ($emaild == '') {	
	$emailcli = $email;
}
else {
	$emailcli = $emaild;
}

$status = $banco->getStatus($codigo);
	$enviado = $status['StatusEmail'];

//$body = file_get_contents('contents.php');
$body = '
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
	</head>	
	<body style="margin: 10px;">
		<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
		<div align="center"><img src="../../images/logo.png" style="height: 100px; width: 100px">
		</div>
		<br>
		<br>
		<br>Solicitação de Entrega Técnica nº: <strong>' . $codigo . '</strong>
		<br>
		<br>
		<br><h2><b>Dados do Cliente</b></h2>		
		
		<br><b>Razão Social:</b> '.$razaosocial.'
		<br><b>Nome Fantasia:</b> '.$nomefantasia.'
		<br><b>CNPJ/CPF:</b> '.$cgc.'
		<br><b>Insc. Estadual:</b> '.$inscestadual.'		
		<br><b>Email:</b> '.$emailcli.'		
		<br><b>Telefone Fixo:</b> '.$fixo.'		
		<br><b>Celular:</b> '.$celular.'		
		<br><b>Pessoa de Contato:</b> '.$contato.'		
		<br><b>Endereço:</b> '.$endereco.'		
		<br><b>Complemento:</b> '.$complemento.'		
		<br><b>Bairro:</b>'.$bairro.'		
		<br><b>CEP:</b> '.$cep.'		
		<br><b>Cidade:</b> '.$cidade.'		
		<br><b>Estado:</b> '.$estado.'		
		<br><b>Nº do Pedido:</b> '.$orcamento.'		
		<br><b>Nº da Solicitação:</b> '.$codigo.'		
		<br><b>Observação:</b> '.$observacao.'		
		<br><b>Responsável pela Entrega Técnica:</b> '.$responsavel.'		
		<br>
		<br><h2><b>Dados do Distribuidor</b></h2>		
		<br><b>Distibuidora:</b> '.$distribuidor.'		
		<br><b>Cidade</b> '.$distcidade.'		
		<br><b>UF</b> '.$distestado.'		
		<br><b>Usuário</b> '.$usuario.'
		<br>
		<br><h2><b>Produto(s)</b></h2>		
		<br>
		<table border="2px">
			<tr>
				<th>Produto</th>			
				<th>Condição</th>
				<th>Quantidade</th>
			</tr>	
		';
			$produtos = $banco->pesquisaItensEntrega($codigo);
			foreach ($produtos as $produto) {
			$body.='
				<tr>
				 <td>'.$produto['produto'].'</td>
				 <td><center>'.$produto['condicao'].'</center></td>
				 <td><center>'.$produto['Qtde'].'</center></td>
				</tr> 
			';	
			}
	$body.='</table>
		</div>		
	</body>';

$mail -> charSet = "UTF-8";
$mail->IsSMTP();
$mail->SMTPAuth   = true;            // enable SMTP authentication
$mail->SMTPSecure = $seguranca;      // sets the prefix to the servier
$mail->Host       = $smtp;           // sets GMAIL as the SMTP server
$mail->Port       = $porta;          // set the SMTP port

//$mail->SMTPDebug = 1;

$mail->Username   = $Remetente;  // GMAIL username
$mail->Password   = base64_decode($senha); // GMAIL password

$mail->From       = $Remetente;
$mail->FromName   = utf8_decode("Solicitação de Entrega Técnica Inmes Industrial Ltda");
if ($enviado == 1) {
	$mail->Subject = utf8_decode("REENVIO - Solicitação Entrega Técnica - ".$razaosocial);
}
else {
	$mail->Subject = utf8_decode("Solicitação Entrega Técnica - ".$razaosocial);
}

//$mail->AltBody    = utf8_decode($Mensagem); //Text Body
$mail->WordWrap   = 50; // set word wrap

$mail->MsgHTML(utf8_decode($body));

//$mail->AddReplyTo($Remetente, utf8_decode("Entrega Técnica Inmes Industrial Ltda"));

//$mail->AddAddress('ronaldordj@gmail.com', $nomefantasia);

//Destinatário da Cópia
$copias = $banco->getEmailRecebe("E");
foreach ($copias as $copia) {		
	$mail->AddAddress($copia['Email'], utf8_decode("Inmes"));
}


$mail->IsHTML(true); // send as HTML

if (!$mail->Send()) {
	echo "Erro no envio: " . $mail->ErrorInfo;
} else {
		
	$array = $banco->updateEntregaEmailEnviado($codigo);
	echo "<script language='javascript' type='text/javascript'>alert('Entrega Técnica enviada com sucesso!');window.location.href='index.php';</script>";
	//echo "<script>document.location='../view/entregas/cadastroEntregas-edit.php?id=" . $codigo . "'</script>";
}
