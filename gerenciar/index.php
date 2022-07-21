<?php

    /*session_start();
    if( isset( $_SESSION['dftRedir'] ) && !empty( $_SESSION['dftRedir'] ) ){

        // include '/config/conecta.php';
      
        $id         = base64_decode( $_SESSION['dftRedir'] );
        $conexao    = mysqli_connect("184.171.248.66:3306", "inmescom_wp", "%&)ckJDYyVxI");
        $baseWP     = mysqli_select_db($conexao,"inmescom_wp");
        $sql        = "
        SELECT * FROM dft_usermeta where user_id = '$id'";
        $sql_result = mysqli_query( $conexao, $sql );
        // $row        = mysqli_fetch_array($sql_result);
        while( $row = $sql_result->fetch_array() ){
            // $rows[] = $row;
            if( $row['meta_key'] == 'dft_capabilities' ){
                $jooj = $row['meta_value'];
            }
        }
        $sql_result->close();
        $adm        = unserialize( $jooj );
        
        if( isset( $adm['administrator'] ) && !empty( $adm['administrator'] ) && $adm['administrator'] == 1 ){
          
            // $sql        = "SELECT user_email FROM dft_users where ID = '$id'";
            // $sql_result = mysqli_query( $conexao, $sql );
            // $row        = mysqli_fetch_array($sql_result);
            // $email      = $row['user_email'];
            // print_r( $email );
            // $baseSelecionada = mysqli_select_db($conexao,"inmescom_distribuidor");
            // print_r( $baseSelecionada );
            // $sql          = "SELECT Id FROM cd_usuariopainel where email = '$email'";
            // $sql_result2  = mysqli_query( $conexao, $sql );
            // $newRow       = mysqli_fetch_array( $sql_result2 );
            // $id         = $newRow[0];
            if( isset( $id ) && !empty( $id ) ){

                // $baseSelecionada = mysqli_select_db($conexao,"inmescom_distribuidor");
                // $sql          = "SELECT Senha FROM cd_usuariopainel where Id = '$id'";
                // $sql_result2  = mysqli_query( $conexao, $sql );
                // $newRow       = mysqli_fetch_array( $sql_result2 );
                // $senha        = $newRow['Senha'];
                $key          = md5($id);
                $_SESSION['inmesuser_ison'] = 1;
                // setcookie("chave",$senha);
                header("Location:".$_SERVER['SCRIPT_URI']."inicio.php?ukey=$key", false);

            }

        }
        
      
    }*/

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

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="processa/valida.php" method="post">
          <div class="form-group">
			<div class="form-row">
				<div class="col-xs-12 col-md-12 col-lg-12">	
					<div class="form-label-group">
					  <input name="email" type="email" id="email" class="form-control" placeholder="E-mail" required="required" autofocus="autofocus">
					  <label for="email">Email</label>
					</div>
				</div>	
			</div>	
          </div>
          <div class="form-group">
			<div class="form-row">
				<div class="col-xs-12 col-md-12 col-lg-12">	
					<div class="form-label-group">
					  <input name="senha" type="password" id="senha" class="form-control" placeholder="Senha" required="required">
					  <label for="senha">Senha</label>
					</div>
				</div>
			</div>		
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="lembrar-me">
                Lembrar Senha
              </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Acessar</button>
        </form>        
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
