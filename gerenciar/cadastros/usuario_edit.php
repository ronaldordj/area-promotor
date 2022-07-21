<?php
	include '../config/conecta.php';
	
	$id = $_GET['id'];
	//Executa consulta	
	$sql="SELECT u.*, d.Distribuidor 
        FROM cd_usuario u
        LEFT OUTER JOIN cd_distribuidor d ON (d.Id = u.DistribuidorId)
			  WHERE u.id = $id";
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
      <div class="card-header">Cadastro de Usuário - Id nº. <?php echo $id;?></div>
      <div class="card-body">
        <form action="../processa/proc_edit_usuario.php" method="post">
          <div class="form-group">
            <div class="form-row">
			        <input type="hidden" id="idusuario" name="idusuario" value="<?php echo $id;?>">	
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="nome" type="text" id="nome" class="form-control" placeholder="Nome" required="required" value="<?php echo $resultado['Nome'];?>" maxlength="60" />
                  <label for="nome">Nome</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="email" type="email" id="email" class="form-control" placeholder="E-mail" required="required" value="<?php echo $resultado['Email'];?>" maxlength="60" />
                  <label for="email">E-mail</label>
                </div>
              </div>
            </div>
          </div> 	
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                  <div class="form-label-group">
                    <input name="funcao" type="text" id="funcao" class="form-control" placeholder="Função" required="required" value="<?php echo $resultado['Funcao'];?>" maxlength="50" />
                    <label for="funcao">Função</label>
                  </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input type="hidden" id="iddistrib" name="iddistrib" value="<?php echo $resultado['DistribuidorId'];?>">
                  <input name="buscaDistribuidor" type="text" id="buscaDistribuidor" class="form-control" placeholder="Distribuidor" required="required" autocomplete="off" value="<?php echo utf8_encode($resultado['Distribuidor']);?>">
                  <label for="buscaDistribuidor">Distribuidor</label>
                </div>
              </div>    
            </div>            
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <select class="custom-select custom-select-lg" id="inlineFormCustomSelectPref" required="required" name="papel" id="papel" >
                  <option selected value="<?php echo $resultado['Tipo']?>"><?php if($resultado['Tipo'] == 0) {echo 'Master';} elseif($resultado['Tipo'] == 1) {echo 'Distribuidor';} else {echo 'Vendedor';} ?></option>
                  <?php if ($resultado['Tipo'] == 0) {?>
                    <option value="0">Master</option>
                  <?php } else if ($resultado['Tipo'] == 1) { ?>  
                    <option value="1">Distribuidor</option>
                  <?php } else {?>
                    <option value="2">Vendedor</option>
                  <?php }?>  
                </select>                
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="telefone" type="text" id="telefone" class="form-control" placeholder="Telefone" required="required" maxlength="11" value="<?php echo $resultado['Telefone'];?>">
                  <label for="telefone">Telefone</label>
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
          </div>    
          <button type="submit" class="btn btn-success btn-block">Salvar</button>
        </form>
		    <p class="primary"><a href="redefinir.php?key=<?php echo base64_encode($resultado['Email']);?>&token=<?php echo base64_encode($id);?>">Redefinir Senha</a></p>
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
