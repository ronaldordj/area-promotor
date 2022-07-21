<?php
//$raiz = dirname(dirname(dirname(dirname(__FILE__))));
//$raiz = dirname(dirname(dirname(__FILE__)));
//print_r($raiz);

$Remetente    = $_POST['remetente'];	// Pega o valor do campo Remetente
$Destinatario = $_POST['destinatario'];	// Pega o valor do campo Destinatário
$Assunto      = $_POST['assunto'];	    // Pega o valor do campo Assunto
$Mensagem	  = $_POST['mensagem'];	    // Pega os valores do campo Mensagem

$smtp         = $_POST['smtp'];
$porta        = $_POST['porta'];
$seguranca    = $_POST['seguranca'];
$senha        = $_POST['senha'];

$codigo       = $_POST['id'];
$contato      = $_POST['contato'];
$pedido       = $_POST['pedido'];
$cliente      = $_POST['cliente'];
$status       = $_POST['statusCanc'];
$responsavel  = $_POST['responsavel'];

include("../../phpmailer/class.phpmailer.php");
include("../../phpmailer/class.smtp.php"); // note, this is optional - gets called from main class if not already loaded
include("../../model/bancoEntrega.php");

$banco = new BancoEntrega();
$mail  = new PHPMailer();

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
		<br>Nº Solicitação de Entrega Técnica: <strong>' . $codigo . '</strong>
		<br>Nº Pedido: <strong>' . $pedido . '</strong>
		<br>Cliente: <strong>' . $cliente . '</strong>
		<br>
		<br>Responsável pela Entrega Técnica: <strong>' . $responsavel . '</strong>
		<br>
		<br>Olá, ' . $contato . '
		<br>
		<br>Obrigado por ter escolhido a Inmes.
		<br>Para obter o melhor desempenho de nossos equipamentos, o Departamento de Pós-vendas da Inmes desenvolveu um sistema de agendamento de entrega técnica, rápido e eficiente, onde seu equipamento será montado por um especialista Inmes.
		<br>Para agilizar o processo de agendamento da visita de nosso técnico, onde este fará a montagem e treinamento de operação do equipamento, é necessário que alguns procedimentos sejam seguidos.
		<br>Em anexo segue um arquivo em PDF com todas as instruções necessárias para preparação do local de instalação, do equipamento.

		<strong>
		<br>
		<br>ATENÇÃO:
		<br>
		<br>É IMPORTANTE QUE QUE TODOS OS REQUISITOS DE INSTALAÇÃO SEJAM CUMPRIDOS CONFORME  ORIENTAÇÃO EM ANEXO.
		<br>
		<br>A INMES RESERVA-SE NO DIREITO DE NÃO FAZER A MONTAGEM E ENTREGA DO EQUIPAMENTO EM CASO DE NÃO CUMPRIMENTO DOS REQUISITOS DE INSTALAÇÃO, FICANDO OS CUSTOS, DE DESLOCAMENTO, MÃO-DE-OBRA E ESTADIA, PARA UM NOVO AGENDAMENTO, DE RESPONSABILIDADE DO CLIENTE.
		<br>
		</strong>

		<br>***Após o cumprimento dos requisitos de instalação, conforme anexo, clique no link abaixo ou entre no site, www.inmes.com.br e preencha o formulário para agendar a entrega técnica.***

		<strong>
		<br>
		<br>Clique <a href="http://inmes.com.br/area-distribuidor/view/formularios/cadastroFormularios.php?entregaid=' . $codigo . '"  target="_blank"><b>aqui</b></a> para preencher o formulário de Entrega Técnica.
		</strong>
		<br>
		<br>Atenciosamente

		<br>Inmes Industrial

		<br>http://www.inmes.com.br/
		<br>
		
		</div>		
	</body>';


	$bodyCancelamento = '
	<head>
		
	</head>	
	<body style="margin: 10px;">
		<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
		<div align="center"><img src="../../images/logo.png" style="height: 100px; width: 100px">
		</div>
		<br>
		<br>
		<br>Nº Solicitação de Entrega Técnica: <strong>' . $codigo . '</strong>
		<br>Nº Pedido: <strong>' . $pedido . '</strong>
		<br>Cliente: <strong>' . $cliente . '</strong>
		<br>
		<br>Responsável pela Entrega Técnica: <strong>Inmes Industrial Ltda</strong>
		<br>
		<br>Olá, ' . $contato . '
		<br>
		<br>
		<br>***A Solicitação de Entrega Técnica Nº <strong>' . $codigo . '</strong> foi cancelada.***
		
		<br>
		<br>Atenciosamente

		<br>Inmes Industrial

		<br>http://www.inmes.com.br/
		<br>
		
		</div>		
	</body>';

$mail->IsSMTP();
$mail->SMTPAuth   = true;            // enable SMTP authentication
$mail->SMTPSecure = $seguranca;      // sets the prefix to the servier
$mail->Host       = $smtp;           // sets GMAIL as the SMTP server
$mail->Port       = $porta;          // set the SMTP port

$mail->Username   = $Remetente;  // GMAIL username
$mail->Password   = base64_decode($senha); // GMAIL password

$mail->From       = $Remetente;
$mail->FromName   = utf8_decode("Entrega Técnica Inmes Industrial Ltda");
$mail->Subject    = utf8_decode($Assunto);
$mail->AltBody    = utf8_decode($Mensagem); //Text Body
$mail->WordWrap   = 50; // set word wrap

$mail->SMTPDebug = 1;

if ($status == 2) {
	$mail->MsgHTML(utf8_decode($bodyCancelamento));
}
else {
	$mail->MsgHTML(utf8_decode($body));
}

$mail->AddReplyTo($Remetente, utf8_decode("Entrega Técnica Inmes Industrial Ltda"));

$mail->AddAddress($Destinatario, "Cliente");

//Destinatário da Cópia
/*$copias = $banco->getEmailRecebe("E");
foreach ($copias as $copia) {	
	$mail->AddCC($copia['Email'], utf8_decode("Inmes"));
}*/


$especificacoes = $banco->getEntregaItensEspecificacao($codigo);
foreach ($especificacoes as $especificacao) {	
	if ($especificacao['Especificacao'] != '') {
		$mail->AddAttachment("../../../produtos_outros/especificacao_tecnica/".$especificacao['Especificacao']);
	}
}

$requisitos = $banco->getEntregaItensRequisitos($codigo);
	foreach ($requisitos as $requisito) {	
		if ($requisito['Requisito'] != '') {
			$arquivo = preg_replace('/[ -]+/' , '-' , $requisito['Requisito']);
			//print_r($arquivo);
			$mail->AddAttachment("../../../produtos_outros/requisitos_instalacao/".$arquivo);
		}	
	}

$mail->IsHTML(true); // send as HTML

if (!$mail->Send()) {
	echo "Erro no envio: " . $mail->ErrorInfo;
} else {
	
	//$array = $banco->updateEntregaEmailEnviado($codigo);
	//echo "<script language='javascript' type='text/javascript'>alert('Entrega Técnica enviado com sucesso!');window.location.href='index.php';</script>";
	echo "<script>document.location='enviarAutoPos.php?id=".$codigo."&email=".$Destinatario."'</script>";
}