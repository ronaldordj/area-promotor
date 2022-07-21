<?php
	include '../config/conecta.php';
	$id = base64_decode($_GET['date']);
	//Executa consulta
	$sql="SELECT * FROM mi_produto WHERE Id = $id";
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

  <title>Painel Admin - Área do Distribuidor</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Produto</div>	
      <div class="card-body">
		<form action="../processa/proc_edit_produto.php" method="post" enctype="multipart/form-data">
		<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="form-label-group">
                  <input name="referencia" type="text" id="referencia" class="form-control" placeholder="Referência" value="<?php echo $resultado['Referencia'];?>" >
                  <label for="referencia">Referência</label>
                </div>
              </div>  
            </div>
          </div>  
          <div class="form-group">  
            <div class="form-row">  
              <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="form-label-group">
                  <input name="descricao" type="text" id="descricao" class="form-control" placeholder="Descrição" required="required" value="<?php echo $resultado['Descricao'];?>">
                  <label for="descricao">Descrição</label>
                </div>
              </div>			                
            </div>
          </div>             
          <div class="form-group" >
            <div class="form-row">
              <div class="col-xs-12 col-md6 col-lg-6">
                <div class="form-label-group">
                  <input name="arquivo" type="file" id="arquivo" class="form-control" placeholder="Imagem"><?php if($resultado['Imagem'] != '') {
                    echo 'Possui imagem cadastrada.'; } else {echo 'Não possui imagem cadastrada.';} ?></input>
                  <label for="arquivo">Imagem</label>
                </div>
              </div>  
					</div>  
          <div class="form-group" >
            <div class="form-row">
              <div class="col-xs-12 col-md6 col-lg-6">
                <div class="form-label-group">
                  <input name="pdf" type="file" id="pdf" class="form-control" placeholder="PDF Pré-Requisitos" accept=".pdf"><?php if($resultado['PDF'] != '') {
                    echo 'Possui PDF cadastrado.'; } else {echo 'Não possui PDF cadastrado.';} ?></input>
                  <label for="pdf">PDF Pré-Requisitos</label>
                </div>
              </div>  
					</div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-2 col-md-2 col-lg-2">
                <div class="form-check">					  
                  <input name="ativo" class="form-check-input" type="radio" id="ativo" value="1" <?php if ($resultado['Status'] == 1) {echo 'checked';} ?>>
                  <label class="form-check-label" for="ativo">
                  Ativo
                  </label>
                </div>
              </div>
              <div class="col-xs-2 col-md-2 col-lg-2">
                <div class="form-check">					  
                  <input name="ativo" class="form-check-input" type="radio" id="ativo" value="0" <?php if ($resultado['Status'] == 0) {echo 'checked';} ?>>
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

</body>

</html>
