<?php
    session_start();
    ?>
<!doctype html>
<html lang="pt" xmlns="http://www.w3.org/1999/html">
    <?php include("headmeusdados.php"); ?>	
    <body>
        <?php include("../../header.php"); ?>
		<div class="breadcrumb-container">
			<div class="breadcrumb-wrapper">
				<div class="breadcrumb-title">
					<h2>Área do Distribuidor</h2>
				</div>
				<div class="breadcrumb-navigation"><a class="bread-home" href="https://movelin.com.br/area-distribuidor"><span>Início</span></a><span class="divisor-breadcrumb">|</span><span class="pagina-atual-breadcrumb">Meus Dados</span></div>
			</div>
		</div>
        <div id="content">
            <div class="d-flex" id="wrapper">
                <div class="bg-light border-right" id="sidebar-wrapper">
                    <div class="list-group list-group-flush">
                        <div id="nav_menu">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link aLista" href="../../">
                                    <img src="../../public/svgs/home-cinza.png" class="icone20"></img>
                                    <img class="imgHover icone20" src="../../public/svgs/home-branco.png">
                                    Início
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link aLista" href="../clientes">
                                    <img src="../../public/svgs/followers-cinza.png" class="icone20"></img>
                                    <img class="imgHover icone20" src="../../public/svgs/followers-branco.png">
                                    Meus Clientes
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link aLista" href="">
                                        <img src="../../public/svgs/key-cinza.png" class="icone20"></img>
                                        <img class="imgHover icone20" src="../../public/svgs/key-branco.png">
                                        Ativar Produtos
                                    </a>
							    </li>
                                <?php if  ($_SESSION['usuarioMascara'] == '' || strlen($_SESSION['usuarioMascara'])<4) {?>
                                <li class="nav-item">
                                    <a class="nav-link aLista" href="../usuarios">
                                    <img src="../../public/svgs/user-cinza.png" class="icone20"></img>
                                    <img class="imgHover icone20" src="../../public/svgs/user-branco.png">
                                    Usuários
                                    </a>
                                </li>
                                <?php }?>
                                <li class="nav-item">
                                    <a class="nav-link aLista active" href="../meusdados">
                                    <img src="../../public/svgs/password-cinza.png" class="icone20"></img>
                                    <img class="imgHover icone20" src="../../public/svgs/password-branco.png">
                                    Meus Dados
                                    </a>
                                </li>                                
                                <li class="nav-item">
                                    <a class="nav-link aLista" href="../../controller/Logout.php">
                                    <img src="../../public/svgs/exit-cinza.png" class="icone20"></img>
                                    <img class="imgHover icone20" src="../../public/svgs/exit-branco.png">
                                    Sair
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="page-content-wrapper">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                        <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>        
                    </nav>                    
                    <br><br>
                    <?php
                        include "../../model/bancoUsuario.php";
                        $banco = new bancoUsuario();
                        $param = $_SESSION['usuarioId'];
                        $array = $banco->getUsuarioId($param);
                        foreach ($array as $linha) {
                            ?>
                    <h3 class="cinza">
                        Alterar Senha do Usuário
                    </h3>
                    <br>
                    <form action="enviar.php" method="post">                        
						<input type="hidden" name="usuario" id="usuario" value="<?php echo $linha['Nome'] ?>">
                        <div class="bloco">
                            <h5>Informe seu e-mail</h5>
                            
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                    <input value="<?php echo $linha['Email'] ?>" class="form-control" type="email" placeholder="E-mail" name="destinatario" id="destinatario" maxlength="50" />
                                    <label>E-mail</label>
                                </div>
                            </div>
                        </div>    
						
						<!--Config e-mail de envio -->
						<input type="hidden" name="remetente" id="remetente" value="testeinmes@driftweb.com.br" />						
						<input type="hidden" name="porta" id="porta" value="465" />
						<input type="hidden" name="seguranca" id="seguranca" value="ssl" />						
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <br>
                                <button class="botaoPadrao200 float-right" type="submit" value="submit">
                                    Enviar
                                    <div class="circuloPadrao200">
                                        <img src="../../public/svgs/add_laranjado.png" width="15px"></img>
                                    </div>
                                </button>
                            </div>                            
                        </div>
                    </form>					
                </div>
                <?php } ?>
                </section>
            </div>
        </div>
        </div>
        <?php include("../../footer.php"); ?>
        <script>
            $("#menu-toggle").click(function(e) {
              e.preventDefault();
              $("#wrapper").toggleClass("toggled");
            });
        </script>
        <script>
            var password = document.getElementById("senha"), confirm_password = document.getElementById("repitaSenha");
            
            function validatePassword(){
              if(password.value != confirm_password.value) {
            	confirm_password.setCustomValidity("As senhas estão diferentes");
              } else {
            	confirm_password.setCustomValidity('');
              }
            }
            
            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;
        </script>
    </body>
</html>