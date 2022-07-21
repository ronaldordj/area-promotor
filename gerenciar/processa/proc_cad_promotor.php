<?php	
	include '../config/conecta.php';	
	
	$nome        	 = $_POST['nome'];	
	$email           = $_POST['email'];	
	$telefone        = $_POST['telefone'];	
	
	$sql="select max(Id) as maior from mi_promotor";
	$sql_result=mysqli_query($conexao,$sql)or die("Erro:".mysqli_error($conexao));
	$row=mysqli_fetch_array($sql_result);			
	$id = $row['maior']+1;	
	
	$queryInsercao = "INSERT INTO mi_promotor (Id, Nome, Email, Telefone, Ativo) 
	VALUES ($id, '$nome', '$email', '$telefone', 1)";
	@mysqli_query($conexao,$queryInsercao) or die("Algo deu errado ao inserir o registro. Tente novamente." .mysqli_error($conexao));
	
	include("../../phpmailer/class.phpmailer.php");
	include("../../phpmailer/class.smtp.php"); 

	$mail  = new PHPMailer();

	$body = '
		<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			
		</head>	
		<body style="margin: 10px;">
			<div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 16px;">
				<div>
					<img src="../../public/svgs/logo-azul.PNG" style="height: 75px; width: 276px">
				</div>				
				<br>
				<br>
				<br>Olá '.$nome.',
				<br>
				<br>Você foi cadastrado na Área do Promotor Móvel IN.
				<br>Para cadastrar sua senha, clique <a href="https://movelin.com.br/area-promotor/credencial.php?cript=' . base64_encode(base64_encode($id)) . '"  target="_blank"><strong>AQUI</strong></a>
				<br>
				<br>				
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
	$mail->SMTPAuth   = true;     // enable SMTP authentication
	$mail->SMTPSecure = "";      // sets the prefix to the servier
	$mail->Host       = "smtp.movelin.com.br";           // sets GMAIL as the SMTP server
	$mail->Port       = "587";          // set the SMTP port

	//$mail->SMTPDebug = 2;
	$senha = base64_decode("S3hdfXZ3Z3ttZGRlLA==");

	$mail->Username   = "sistema@movelin.com.br";  // GMAIL username
	$mail->Password   = $senha; // GMAIL password

	$mail->From       = "sistema@movelin.com.br";
	$mail->FromName   = utf8_decode("Área do Promotor");
	$mail->Subject    = utf8_decode("Cadastrar senha para acesso a área do promotor Móvel In");
	//$mail->AltBody    = utf8_decode($Mensagem); //Text Body
	$mail->WordWrap   = 50; // set word wrap

	$mail->MsgHTML(utf8_decode($body));	

	$mail->AddAddress($email, $usuario);

	$mail->IsHTML(true); // send as HTML

	if (!$mail->Send()) {
		echo "Erro no envio: " . $mail->ErrorInfo;
	} else {	
		echo "<script>alert('Promotor cadastrado com sucesso!'),location.href='../listas/promotor.php'</script>";
	}
	
 ?>