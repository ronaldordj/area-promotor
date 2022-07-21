<!DOCTYPE html>
  <html lang="pt-br">
  <head>
  <title>Movel In - Área do Distribuidor</title>
    <meta name="description" content="Movel In - Área do Distribuidor">
    <meta name="author" content="DriftWeb">
    <meta name="viewport" content="width=device-width, initial-scale=1">	
	

		<link rel="icon" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-32x32.png" sizes="32x32">
		<link rel="icon" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-192x192.png" sizes="192x192">
		<link rel="apple-touch-icon-precomposed" href="https://movelin.com.br/wp-content/uploads/2019/12/cropped-favicon-movel-in-180x180.png">
		
		<link href="../public/css/style.css" rel="stylesheet" type="text/css" media="all" />
		<link href="../public/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
		
		<style>
		body {
		  background-color: #233364;
		}
	</style>
		
  </head>
  <body>
	  <br>
	  <br>
  <div class="container">
		<div class="text-center">
		  <img src="https://movelin.com.br/wp-content/uploads/2019/09/logo-movel-in.png" class="rounded" alt="Movel IN">
		</div>
	</div>
	<br>
	<br>
	<div class="container">
		<div class="paragrafo">
			<center><h2>Área do Distribuidor</h2></center>
		</div>
        <br><br>		
		<form action="../controller/ControllerLogin.php" method="post" id="fmLogin" enctype='application/json' class="box">
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-4">
					<label for="usuario">E-mail</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="E-mail" maxlength="50" autocomplete="on">
				</div>	
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-4">
					<label for="senha">Senha</label>
					<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" maxlength="50">
				</div>	
			</div>						
			<br></br>
			<div class="row">	
				<div class="col-sm-12 col-md-6 col-lg-4">
					
					<button class="botaoPadrao200 float-right" type="submit" value="submit">
						Efetuar Login
						<div class="circuloPadrao200">
							<img src="../public/svgs/add_laranjado.png" width="15px"></img>
						</div>
					</button>					
				</div>
			</div>						
		</form>		
	</div>
	
	
	
</html>		