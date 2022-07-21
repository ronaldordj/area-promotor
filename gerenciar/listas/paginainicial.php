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
  <meta name="author" content="">

  <title>Painel Admin - Área do Distribuidor</title>

  <!-- Favicon -->
	<link rel="icon" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-32x32.png" sizes="32x32">
  <link rel="icon" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-192x192.png" sizes="192x192">
  <link rel="apple-touch-icon-precomposed" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-180x180.png">

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <?php include '../header.php'; ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include 'menulista.php'; ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Página Inicial</li>
          <li class="breadcrumb-item active">Banner</li>
        </ol>		
        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Banner</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Id</th>                    
                    <th>Miniatura</th>
					        </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Id</th>
                    <th>Miniatura</th>                    					
                  </tr>
                </tfoot>
                <tbody>
					<?php
						$sql="SELECT * FROM mi_banner";
						$sql_result=mysqli_query($conexao,$sql)or die("Erro:".mysqli_error($conexao));
						while($row=mysqli_fetch_array($sql_result)){								
          ?>                  
          <tr>
            <td><a href='../cadastros/paginainicial_edit.php?key=<?php echo md5(microtime()); ?>&date=<?php echo base64_encode($row['Id']); ?>'><i class="far fa-edit"></i></a></td>
            <td><?php echo $row['Id'];?></td>                        
            <td><img src="../../public/banner/<?php echo $row['Imagem'] ?>" width="150px" height="150px"></td>
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
