<?php
	include '../config/conecta.php';
	$id = base64_decode($_GET['date']);
	//Executa consulta
	$sql="SELECT atv.Id, atv.Datacriacao, cli.Razaosocial, p.Descricao, atp.Chave, CASE atv.Status WHEN 1 THEN 'Contato com o cliente realizado' WHEN 2 THEN 'Implantação Agendada' WHEN 3 THEN 'Implantação Finalizada' WHEN 4 THEN 'Solicitação Cancelada' else 'Solicitação Recebida' END AS StatusDescricao, usu.Nome as Vendedor, dis.Distribuidor,
               atv.Status 
        FROM mi_ativacao atv
        JOIN mi_ativacao_produto atp ON (atp.Idativacao = atv.Id)
        JOIN mi_produto p ON (p.Id = atp.Idproduto)
        JOIN mi_produto_modalidade pm ON (pm.Id = atp.Idmodalidade)
        JOIN cd_cliente cli ON (cli.Id = atv.Idcliente)
        JOIN cd_usuario usu ON (usu.Id = atv.Idusuario)
        JOIN cd_distribuidor dis ON (dis.Id = usu.DistribuidorId) 
        WHERE atv.Id = $id";
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
      <div class="card-header">Ativação de Produto</div>	
      <div class="card-body">
		<form action="../processa/proc_edit_ativacoes.php" method="post" enctype="multipart/form-data">
		<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-4 col-md-4 col-lg-4">
                <div class="form-label-group">
                  <input name="datacriacao" type="text" id="datacriacao" class="form-control" placeholder="Nome" required="required" value="<?php echo date('d/m/Y',strtotime($resultado['Datacriacao']))?>" readonly>
                  <label for="datacriacao">Data de Solicitação</label>
                </div>
              </div> 
              <div class="col-xs-4 col-md-4 col-lg-4">
                <div class="form-label-group">
                  <input name="dataatualizacao" type="text" id="dataatualizacao" class="form-control" placeholder="Nome" required="required" value="<?php echo date('d/m/Y')?>" readonly>
                  <label for="dataatualizacao">Data de Atualização</label>
                </div>
              </div>  
            </div>
          </div> 
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="form-label-group">
                  <input name="cliente" type="text" id="cliente" class="form-control" placeholder="Nome" required="required" value="<?php echo $resultado['Razaosocial'];?>" readonly>
                  <label for="cliente">Cliente</label>
                </div>
              </div>  
            </div>
          </div> 
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="produto" type="text" id="produto" class="form-control" placeholder="Nome" required="required" value="<?php echo $resultado['Descricao'];?>" readonly>
                  <label for="produto">Produto</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="chave" type="text" id="chave" class="form-control" placeholder="Nome" required="required" value="<?php echo $resultado['Chave'];?>" readonly>
                  <label for="chave">Chave</label>
                </div>
              </div>  
            </div>
          </div> 
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                    <select name="status" id="status" class="form-control form-control-lg">
                      <option value="<?php echo $resultado['Status'];?>"><?php echo $resultado['StatusDescricao'];?></option>
                      <?php if ($resultado['Status'] == 0) { ?>
                        <option value="1">Contato com o cliente realizado</option>
                        <option value="2">Implantação Agendada</option>
                        <option value="3">Implantação Finalizada</option>                      
                        <option value="4">Solicitação Cancelada</option>
                      <?php } ?>  
                      <?php if ($resultado['Status'] == 1) { ?>
                        <option value="0">Solicitação Recebida</option>
                        <option value="2">Implantação Agendada</option>
                        <option value="3">Implantação Finalizada</option>                      
                        <option value="4">Solicitação Cancelada</option>
                      <?php } ?>
                      <?php if ($resultado['Status'] == 2) { ?>
                        <option value="0">Solicitação Recebida</option>
                        <option value="1">Contato com o cliente realizado</option>
                        <option value="3">Implantação Finalizada</option>                      
                        <option value="4">Solicitação Cancelada</option>
                      <?php } ?> 
                      <?php if ($resultado['Status'] == 3) { ?>
                        <option value="0">Solicitação Recebida</option>
                        <option value="1">Contato com o cliente realizado</option>
                        <option value="2">Implantação Agendada</option>
                        <option value="4">Solicitação Cancelada</option>
                      <?php } ?> 
                      <?php if ($resultado['Status'] == 4) { ?>
                        <option value="0">Solicitação Recebida</option>
                        <option value="1">Contato com o cliente realizado</option>
                        <option value="2">Implantação Agendada</option>
                        <option value="3">Implantação Finalizada</option>                      
                        <option value="4">Solicitação Cancelada</option>
                      <?php } ?> 
                      
                    </select>                    
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
