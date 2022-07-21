<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Área do Distribuidor</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <link href="../css/jquery-ui.css" rel="stylesheet"> 

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Redefinir Senha de Acesso</div>
      <div class="card-body">
        <form action="proc_cad_novasenha.php" method="post">                    
          <input name="idusuario" type="hidden" id="idusuario" class="form-control" value=<?php echo base64_decode($_GET['id']);?>>
		      <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="senha" type="password" id="senha" class="form-control" placeholder="Nova Senha" required="required" maxlength="10">
                  <label for="senha">Senha</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="confsenha" type="password" id="confsenha" class="form-control" placeholder="Repita a senha" required="required" maxlength="10">
                  <label for="confsenha">Repita a senha</label>
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
