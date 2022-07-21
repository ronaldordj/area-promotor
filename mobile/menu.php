<?php
session_start();
?>
<!doctype html>

<html lang="pt-br" xmlns="http://www.w3.org/1999/html">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    

    <title>INMES - Área do Distribuidor</title>

    <meta name="description" content="INMES - Área do Distribuidor">
    <meta name="author" content="DriftWeb">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../public/css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="../public/css/bootstrapcustom.css">
    <link rel="stylesheet" href="../public/css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <?php
    include("../mobile_device_detect.php");
    $mobile = mobile_device_detect();

    if (!isset($_SESSION['usuarioId'])) {
        session_unset();
        session_destroy();

        if ($mobile == TRUE) {
            header('location:./mobile/login.php');
        } else {
            header('location:./view/login');
        }
    }
    ?>
	
	<style>
		body {
		  background-color: #ededed;
		}
	</style>
	
</head>

<body>
    <div class="container">		
    <br>
	  <br>
  <div class="container">
		<div class="text-center">
		  <img src="../images/logo.png" class="rounded" alt="inmes">
		</div>
    </div>
    <br>
    <center><h5>Inmes - Área do Distribuidor</h5></center>
		<center><h3>Menu Principal</h3></center>
        <br>
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                <button class="btn btn-primary btn-lg btn-block">
                    <div class="float-left">
                        <a href="../view/orcamentos" style="display:block;width: 100%;" class="btn btn-primary btn-lg btn-block" role="button">
                            <img src="../public/svgs/shopping-cart-3-branco.png" alt="Orçamentos" height="80px" class="img-rounded">
                            Orçamentos
                        </a>
                    </div>
                </button>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                <button class="btn btn-primary btn-lg btn-block">
                    <div class="float-left">
                        <a href="../view/entregas" class="btn btn-primary btn-lg btn-block" role="button">
                            <img src="../public/svgs/delivery-truck_branco.png" alt="Entregas Técnicas" height="80px" class="img-rounded">
                            Entregas Técnicas
                        </a>
                    </div>
                </button>
            </div>
        </div>
		<br>		
		<div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                <button class="btn btn-primary btn-lg btn-block">
                    <div class="float-left">
                        <a href="../view/clientes" class="btn btn-primary btn-lg btn-block" role="button">
                            <img src="../public/svgs/followers-branco.png" alt="Meus Clientes" height="80px" class="img-rounded">
                            Meus Clientes
                        </a>
                    </div>
                </button>
            </div>
        </div>
		<br>
		<?php if  ($_SESSION['usuarioMascara'] == '' || strlen($_SESSION['usuarioMascara'])<4) {?>
			<div class="row">
				<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
					<button class="btn btn-primary btn-lg btn-block">
						<div class="float-left">
							<a href="../view/usuarios" class="btn btn-primary btn-lg btn-block" role="button">
								<img src="../public/svgs/user-branco.png" alt="Usuários" height="80px" class="img-rounded">
								Usuários
							</a>
						</div>
					</button>
				</div>
			</div>
			<br>
		<?php }?>
		<div class="row">
			<div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
				<button class="btn btn-primary btn-lg btn-block">
					<div class="float-left">
						<a href="../view/meusdados" class="btn btn-primary btn-lg btn-block" role="button">
							<img src="../public/svgs/password-branco.png" alt="Meus Dados" height="80px" class="img-rounded">
							Meus Dados
						</a>
					</div>
				</button>
			</div>
		</div>
		<br>
		<div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12">
                <button class="btn btn-primary btn-lg btn-block">
                    <div class="float-left">
                        <a href="../controller/Logout.php" class="btn btn-primary btn-lg btn-block" role="button">
                            <img src="../public/svgs/exit-branco.png" alt="Sair" height="80px" class="img-rounded">
                            Sair
                        </a>
                    </div>
                </button>
            </div>
        </div>
		<br>
    </div>
    <br>

    </div>


    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <?php //include("footer.php"); 
    ?>
</body>

</html>