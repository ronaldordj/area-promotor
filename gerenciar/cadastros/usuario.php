<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Painel Admin - Área do Distribuidor</title>

  <!-- Favicon -->
	<link rel="icon" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-32x32.png" sizes="32x32">
  <link rel="icon" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-192x192.png" sizes="192x192">
  <link rel="apple-touch-icon-precomposed" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-180x180.png">

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link href="../css/jquery-ui.css" rel="stylesheet">
 

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
      <div class="card-header">Cadastro de Usuário</div>
      <div class="card-body">
        <form action="../processa/proc_cad_usuario.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="nome" type="text" id="nome" class="form-control" placeholder="Nome" required="required" autofocus="autofocus" maxlength="60">
                  <label for="nome">Nome</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="email" type="email" id="email" class="form-control" placeholder="E-mail" required="required" maxlength="60">
                  <label for="email">E-mail</label>
                </div>
              </div>
            </div>
          </div> 
          
		      <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="senha" type="password" id="senha" class="form-control" placeholder="Senha" required="required" maxlength="8">
                  <label for="senha">Senha</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="confsenha" type="password" id="confsenha" class="form-control" placeholder="Repita a senha" required="required" maxlength="8">
                  <label for="confsenha">Repita a senha</label>
                </div>
              </div>
            </div>
          </div>

          <input class="form-control" type="hidden" id="iddistribuidor" name="iddistribuidor">
          
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="funcao" type="text" id="funcao" class="form-control" placeholder="Função" required="required" maxlength="50">
                  <label for="funcao">Função</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="buscaDistribuidor" type="text" id="buscaDistribuidor" class="form-control" placeholder="Distribuidor" required="required" autocomplete="off" >
                  <label for="buscaDistribuidor">Distribuidor</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <select class="custom-select custom-select-lg" id="inlineFormCustomSelectPref" required="required" name="papel" id="papel" >
                  <option selected>Papel...</option>
                  <option value="0">Master</option>
                  <option value="1">Distribuidor</option>
                  <option value="2">Vendedor</option>                
                </select>                
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="telefone" type="text" id="telefone" class="form-control" placeholder="Telefone" required="required" maxlength="11" >
                  <label for="telefone">Telefone</label>
                </div>
              </div>
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
  <script src="../vendor/jquery/jquery-ui.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <script>
      $(document).ready(function() {
          $("#buscaDistribuidor").autocomplete({
              source: "getDistribuidor.php",
              minLength: 1,
              select: function(event, ui) {
                  $("#iddistribuidor").val(ui.item.codigo);                  
              }
          }).data("ui-autocomplete")._renderItem = function(ul, item) {
              return $("<li class='ui-autocomplete-row'></li>")
                  .data("item.autocomplete", item)
                  .append(item.label)
                  .appendTo(ul);
          };
      });
  </script>
  
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
