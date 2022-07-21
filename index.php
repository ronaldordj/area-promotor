<?php
  session_start();
  include 'gerenciar/config/conecta.php';
  //Executa consulta
	$sql="SELECT Imagem FROM mi_banner_promotor";
	$sql_result=mysqli_query($conexao,$sql)or die("Erro:".mysqli_error($conexao)); 		 	 		 		
	$resultado=mysqli_fetch_array($sql_result);	
?>
<!doctype html>

<html lang="pt-br" xmlns="http://www.w3.org/1999/html">

<?php include("head.php"); ?>

<body>
    <?php include("header.php"); ?>
	<div class="breadcrumb-container">
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb-title">
                <h2>Área do Promotor</h2>
            </div>         
            <div class="breadcrumb-navigation"><a class="bread-home" href="https://movelin.com.br"><span>Home</span></a><span class="divisor-breadcrumb"> | </span><span class="pagina-atual-breadcrumb">Área do Promotor</span></div>
        </div>
    </div>
    <div id="content">
		<div class="d-flex" id="wrapper">				
			<div class="bg-light border-right" id="sidebar-wrapper">				
				<div class="list-group list-group-flush">
					<div style="height: 100px">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link aLista active" href="#">
                                    <img src="./public/svgs/home-cinza.png" class="icone20"></img>
                                    <img class="imgHover icone20" src="./public/svgs/home-branco.png">
                                    Início
                                </a>
                            </li>                                                     

                            <li class="nav-item">
                                <a class="nav-link aLista" href="./view/indicacoes">
                                    <img src="./public/svgs/like.png" class="icone20"></img>
                                    <img class="imgHover icone20" src="./public/svgs/like-branco.png">
                                    Indicações
                                </a>
                            </li>                            
                            
                            <li class="nav-item">
                                <a class="nav-link aLista" href="./controller/Logout.php">
                                    <img src="./public/svgs/exit-cinza.png" class="icone20"></img>
                                    <img class="imgHover icone20" src="./public/svgs/exit-branco.png">
                                    Sair
                                </a>
                            </li>
                        </ul>
                    </div>
				</div>	                
            </div>
			<div id="page-content-wrapper">
				<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" id="navbar">
				  <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>        
				</nav>
				<img class="img-fluid" src="public/banner/<?php echo $resultado['Imagem']; ?>">				
			</div>
        </div>
    </div>
	 <script>
		$("#menu-toggle").click(function(e) {
		  e.preventDefault();
		  $("#wrapper").toggleClass("toggled");
		});
	 </script>
    <?php include("footer.php"); ?>
</body>

</html>