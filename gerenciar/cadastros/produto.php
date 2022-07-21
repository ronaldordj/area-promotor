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

  <title>Painel Admin - Área do Distribuidor</title>

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
      <div class="card-header">Cadastro de Produto</div>	
      <div class="card-body">
		<form action="../processa/proc_cad_produto.php" method="post" enctype="multipart/form-data">		
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-4 col-md-4 col-lg-4">
                <div class="form-label-group">
                  <input name="referencia" type="text" id="referencia" class="form-control" placeholder="Referência" >
                  <label for="referencia">Referência</label>
                </div>
              </div>  
            </div>
          </div>  
          <div class="form-group">  
            <div class="form-row">  
              <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="form-label-group">
                  <input name="descricao" type="text" id="descricao" class="form-control" placeholder="Descrição" required="required" >
                  <label for="descricao">Descrição</label>
                </div>
              </div>			                
            </div>
          </div>            
          <div class="form-group" >
            <div class="form-row">
              <div class="col-xs-12 col-md6 col-lg-6">
                <div class="form-label-group">
                  <input name="arquivo" type="file" id="arquivo" class="form-control" placeholder="Imagem" >
                  <label for="arquivo">Imagem</label>
                </div>
              </div>  
              <div class="col-xs-12 col-md6 col-lg-6">
                <div class="form-label-group">
                  <input name="pdf" type="file" id="pdf" class="form-control" placeholder="PDF Pré-Requisitos" accept=".pdf" >
                  <label for="pdf">PDF Pré-Requisitos</label>
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

</body>

</html>
