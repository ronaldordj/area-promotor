<?php
  session_start();
?>
<!doctype html>

<html lang="pt-br" xmlns="http://www.w3.org/1999/html">

<?php include("head.php"); ?>

<body>
    <?php include("../../header.php"); 
    ?>
    <div class="breadcrumb-container">
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb-title">
                <h2>Área do Promotor</h2>
            </div>
            <div class="breadcrumb-navigation"><a class="bread-home" href="https://movelin.com.br/area-promotor"><span>Home</span></a><span class="divisor-breadcrumb">|</span><span class="pagina-atual-breadcrumb">Área do Promotor</span></div>
    </div>
	
	<div id="content">
        <div class="d-flex" id="wrapper">
            <div id="page-content-wrapper">
                <div class="align-content-center">
                    <br>
                    <br>
                    <form action="../../controller/ControllerLogin.php" method="post" id="fmLogin" enctype='application/json' class="box">
                        <div class="bloco">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                    <input class="form-control" type="text" id="email" name="email" placeholder="E-Mail">
                                    <label>E-mail</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                    <input class="form-control" type="password" id="senha" name="senha" placeholder="Senha">
                                    <label>Senha</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button class="botaoPadrao200 float-right" type="submit" value="submit">
                            Efetuar Login
                            <div class="circuloPadrao200">
                                <img src="../../public/svgs/add_laranjado.png" width="15px"></img>
                            </div>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <?php include("../../footer.php"); 
    ?>
</body>

</html>