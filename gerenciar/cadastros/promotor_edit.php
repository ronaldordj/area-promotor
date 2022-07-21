<?php
	include '../config/conecta.php';
	
	$id = base64_decode($_GET['id']);
	//Executa consulta	
	$sql="SELECT * FROM mi_promotor WHERE Id = $id";
	$sql_result=mysqli_query($conexao,$sql)or die("Erro:".mysqli_error($conexao)); 		 	 		 		
	$resultado=mysqli_fetch_array($sql_result);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

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
      <div class="card-header">Cadastro de Cliente - Id nº. <?php echo $id;?></div>
      <div class="card-body">
        <form action="../processa/proc_edit_promotor.php" method="post">
        <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
          <div class="form-group">
            <div class="form-row">			        
              <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="form-label-group">
                  <input name="nome" type="text" id="nome" class="form-control" placeholder="Nome" required="required" value="<?php echo $resultado['Nome'];?>" maxlength="60" />
                  <label for="nome">Nome Fantasia</label>
                </div>
              </div>              
            </div> 
          </div>  		      
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="email" type="email" id="email" class="form-control" placeholder="E-mail" required="required" value="<?php echo $resultado['Email'];?>" maxlength="50" />
                  <label for="email">E-mail</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="telefone" type="text" id="telefone" class="form-control" placeholder="Telefone" required="required" value="<?php echo $resultado['Telefone'];?>" maxlength="11" />
                  <label for="telefone">Telefone</label>
                </div>
              </div>
            </div>
          </div>	
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-2 col-md-2 col-lg-2">
                <div class="form-check">					  
                  <input name="ativo" class="form-check-input" type="radio" id="ativo" value="1" <?php if ($resultado['Ativo'] == 1) {echo 'checked';} ?>>
                  <label class="form-check-label" for="ativo">
                  Ativo
                  </label>
                </div>
              </div>
              <div class="col-xs-2 col-md-2 col-lg-2">
                <div class="form-check">					  
                  <input name="ativo" class="form-check-input" type="radio" id="ativo" value="0" <?php if ($resultado['Ativo'] == 0) {echo 'checked';} ?>>
                  <label class="form-check-label" for="ativo">
                  Inativo
                  </label>
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
  
  <script>
		var vemail = document.getElementById("email"), vconfirma = document.getElementById("repitaEmail");

		function validateEmail(){
		  if(vemail.value != vconfirma.value) {
			vconfirma.setCustomValidity("Os e-mail's estão diferentes!");
		  } else {
			vconfirma.setCustomValidity('');
		  }
		}

		vemail.onchange = validateEmail;
		vconfirma.onkeyup = validateEmail;
	</script>

</body>

</html>
