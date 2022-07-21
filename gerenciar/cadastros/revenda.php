<?php
	include '../config/conecta.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Driftweb">

  <title>Painel Admin - Área do Promotor</title>

  <!-- Favicon -->
	<link rel="icon" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-32x32.png" sizes="32x32">
  <link rel="icon" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-192x192.png" sizes="192x192">
  <link rel="apple-touch-icon-precomposed" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-180x180.png">

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Cadastro de Revenda</div>
      <div class="card-body">
        <form action="../processa/proc_cad_revenda.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="form-label-group">
                  <input name="nome" type="text" id="nome" class="form-control" placeholder="Nome" required="required" autofocus="autofocus" maxlength="100">
                  <label for="nome">Revenda</label>
                </div>
              </div>              
            </div>
          </div> 	

          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="email" type="email" id="email" class="form-control" placeholder="E-mail" required="required" maxlength="80">
                  <label for="email">E-mail</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="site" type="text" id="site" class="form-control" placeholder="Site" maxlength="80">
                  <label for="site">Site</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="telefone" type="text" id="telefone" class="form-control" placeholder="Telefone" required="required" maxlength="15">
                  <label for="telefone">Telefone</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="celular" type="text" id="celular" class="form-control" placeholder="Celular" required="required" maxlength="15">
                  <label for="celular">Celular</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-10 col-lg-10">
                <div class="form-label-group">
                  <input name="endereco" type="text" id="endereco" class="form-control" placeholder="Endereço" required="required" maxlength="100">
                  <label for="endereco">Endereço</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-2 col-lg-2">
                <div class="form-label-group">
                  <input name="numero" type="text" id="numero" class="form-control" placeholder="Número" required="required" maxlength="10">
                  <label for="numero">Número</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="form-label-group">
                  <input name="complemento" type="text" id="complemento" class="form-control" placeholder="Complemento" required="required" maxlength="100">
                  <label for="complemento">Complemento</label>
                </div>
              </div>
            </div>  
          </div>    

          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-8 col-lg-8">
                <div class="form-label-group">
                  <input name="bairro" type="text" id="bairro" class="form-control" placeholder="Bairro" required="required" maxlength="60">
                  <label for="bairro">Bairro</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-4 col-lg-4">
                <div class="form-label-group">
                  <input name="cep" type="text" id="cep" class="form-control" placeholder="CEP" required="required" maxlength="8">
                  <label for="cep">CEP</label>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-8 col-lg-8">
                <div class="form-label-group">
                  <input name="cidade" type="text" id="cidade" class="form-control" placeholder="Cidade" required="required" maxlength="80">
                  <label for="cidade">Cidade</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-4 col-lg-4">
                <div class="form-label-group">
                  <input name="uf" type="text" id="uf" class="form-control" placeholder="UF" required="required" maxlength="2">
                  <label for="uf">UF</label>
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

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="../vendor/jquery/jquery.mask.min.js"></script>
  
  <script>
		$(document).ready(function(){
			var SPMaskBehavior = function (val) {
				return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
			},
			spOptions = {
				onKeyPress: function(val, e, field, options) {
					field.mask(SPMaskBehavior.apply({}, arguments), options);
				}
			};

			$('#telefone').mask(SPMaskBehavior, spOptions);
      $('#celular').mask(SPMaskBehavior, spOptions);
		});
	</script>

</body>

</html>
