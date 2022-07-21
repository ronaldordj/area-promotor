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
  <meta name="author" content="Drift Web">

  <!-- Favicon -->
	<link rel="icon" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-32x32.png" sizes="32x32">
  <link rel="icon" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-192x192.png" sizes="192x192">
  <link rel="apple-touch-icon-precomposed" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-180x180.png">

  <title>Painel Admin - Área do Distribuidor</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">
				<?php
				function mask($val, $mask)
				{
				 $maskared = '';
				 $k = 0;
				 for($i = 0; $i<=strlen($mask)-1; $i++)
				 {
				 if($mask[$i] == '#')
				 {
				 if(isset($val[$k]))
				 $maskared .= $val[$k++];
				 }
				 else
				 {
				 if(isset($mask[$i]))
				 $maskared .= $mask[$i];
				 }
				 }
				 return $maskared;
				}			
				?>

  <?php include '../header.php'; ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'menulista.php'; ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Lista</li>
          <li class="breadcrumb-item active">Ativações de Produtos</li>
        </ol>	
		
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Ativações</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  <th>#</th>
					          <th>Id</th>
                    <th>Data Solicitação</th>
                    <th>Razão Social</th>
                    <th>Produto</th>
                    <th>Chave</th>
                    <th>Status</th>
                    <th>Data Atualização</th>
                    <th>Vendedor</th>                    
                    <th>Distribuidor</th>	
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>#</th>
					          <th>Id</th>
                    <th>Data Solicitação</th>
                    <th>Razão Social</th>
                    <th>Produto</th>
                    <th>Chave</th>
                    <th>Status</th>
                    <th>Data Atualização</th>
                    <th>Vendedor</th>                    
                    <th>Distribuidor</th>					
                  </tr>
                </tfoot>
                <tbody>
					<?php
						$sql="SELECT atv.Id, atv.Datacriacao, cli.Razaosocial, p.Descricao, atp.Chave, CASE atv.Status WHEN 1 THEN 'Contato com o cliente realizado' WHEN 2 THEN 'Implantação Agendada' WHEN 3 THEN 'Implantação Finalizada' WHEN 4 THEN 'Solicitação Cancelada' else 'Solicitação Recebida' END AS StatusDescricao, usu.Nome as Vendedor, dis.Distribuidor, atv.Dataatualizacao
                  FROM mi_ativacao atv
                  JOIN mi_ativacao_produto atp ON (atp.Idativacao = atv.Id)
                  JOIN mi_produto p ON (p.Id = atp.Idproduto)
                  JOIN mi_produto_modalidade pm ON (pm.Id = atp.Idmodalidade)
                  JOIN cd_cliente cli ON (cli.Id = atv.Idcliente)
                  JOIN cd_usuario usu ON (usu.Id = atv.Idusuario)
                  JOIN cd_distribuidor dis ON (dis.Id = usu.DistribuidorId)";
            
						$sql_result=mysqli_query($conexao,$sql)or die("Erro:".mysqli_error($conexao));
						while($row=mysqli_fetch_array($sql_result)){
					?>
                  
            <tr>
                <td><a href='../cadastros/ativacoes_edit.php?date=<?php echo base64_encode($row['Id']); ?>'><i class="far fa-edit"></i></a></td>
                <td><?php echo $row['Id'];?></td>
                <td><?php echo date('d/m/Y',strtotime($row['Datacriacao']))?></td>                    
                <td><?php echo $row['Razaosocial'];?></td>
                <td><?php echo $row['Descricao'];?></td>
                <td><?php echo $row['Chave'];?></td>
                <td><b><?php echo $row['StatusDescricao'];?></b></td>                
                <td><?php if (empty($row['Dataatualizacao'])) { echo "--/--/----"; } else { echo date('d/m/Y',strtotime($row['Dataatualizacao'])); }?></td>                    
                <td><?php echo $row['Vendedor'];?></td>
                <td><?php echo  utf8_encode($row['Distribuidor']);?></td>                
            </tr>
					<?php
						}
					?>                  
                </tbody>
              </table>
            </div>
          </div>          
        </div>				
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <?php include '../footer.php'; ?>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php include 'modallista.php'; ?>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../js/demo/datatables-demo.js"></script>

</body>

</html>
