<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Driftweb">

  <title>Painel Admin - Área do Distribuidor</title>

  <!-- Favicon -->
	<link rel="icon" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-32x32.png" sizes="32x32">
  <link rel="icon" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-192x192.png" sizes="192x192">
  <link rel="apple-touch-icon-precomposed" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-180x180.png">

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

  <?php

      session_start();
      if( isset( $_SESSION['inmesuser_ison'] ) && !empty( $_SESSION['inmesuser_ison'] ) && $_SESSION['inmesuser_ison'] == 1 ){} else {

          header("Location:index.php");
        
      }

  ?>

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Cadastro de E-mail de Envio</div>
      <div class="card-body">
        <form action="../processa/proc_cad_emailenvio.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="email" type="email" id="email" class="form-control" placeholder="E-mail" required="required" maxlength="60">
                  <label for="email">E-mail</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="senha" type="password" id="senha" class="form-control" placeholder="Senha" required="required" maxlength="80">
                  <label for="senha">Senha</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">  
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="smtp" type="text" id="smtp" class="form-control" placeholder="SMTP" required="required" maxlength="80">
                  <label for="smtp">SMTP</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="porta" type="text" id="porta" class="form-control" placeholder="Porta" required="required" maxlength="6">
                  <label for="porta">Porta</label>
                </div>
              </div>
            </div>
          </div>  
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <select name="seguranca" id="seguranca" class="form-control form-control-lg" required="required">
                  <option value="nao">Segurança</option>
                  <option value="ssl">SSL</option>
                  <option value="tls">TLS</option>
                </select>                
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <select name="tipo" id="tipo" class="form-control form-control-lg" required="required">
                  <option>Dispara?</option>
                  <option value="A">Ativação de Produtos</option>
                  <option value="I">Indicação de Clientes</option>
                  <option value="R">Recuperação de Senha</option>                  
                </select>                
              </div>
            </div>				
          </div> 		  		  
          <button type="submit" class="btn btn-success btn-block">Salvar</button>
        </form>        
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  
  <script>
		var password = document.getElementById("senha"), confirm_password = document.getElementById("confsenha");

		function validatePassword(){
		  if(password.value != confirm_password.value) {
			confirm_password.setCustomValidity("As senhas estão diferentes");
		  } else {
			confirm_password.setCustomValidity('');
		  }
		}

		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;
	</script>

</body>

</html>
