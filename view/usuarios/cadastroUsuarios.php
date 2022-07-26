<?php
  session_start();
?>
<!doctype html>

<html lang="pt" xmlns="http://www.w3.org/1999/html">

<?php include("headusuario.php"); ?>

<body>
    <?php include("../../header.php"); ?>
	<div class="breadcrumb-container">
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb-title">
                <h2>Área do Distribuidor</h2>
            </div>
            <div class="breadcrumb-navigation"><a class="bread-home" href="https://movelin.com.br/area-distribuidor"><span>Início</span></a><span class="divisor-breadcrumb">|</span><span class="pagina-atual-breadcrumb">Usuários</span></div>
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
								<a class="nav-link aLista" href="../ativacoes">
									<img src="../../public/svgs/key-cinza.png" class="icone20"></img>
									<img class="imgHover icone20" src="../../public/svgs/key-branco.png">
									Ativar Produtos
								</a>
							</li>

                            <?php if  ($_SESSION['usuarioMascara'] == '') {?>
                                <li class="nav-item">
                                    <a class="nav-link aLista active" href="../usuarios">
                                    <img src="../../public/svgs/user-cinza.png" class="icone20"></img>
                                    <img class="imgHover icone20" src="../../public/svgs/user-branco.png">
                                    Usuários
                                    </a>
                                </li>
                            <?php }?>

                            <li class="nav-item">
                                <a class="nav-link aLista" href="../meusdados">
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
				<div class="titulo">
					<div class="row">
						<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
							<img src="../../public/svgs/user-azul.png" class="icone56"></img>
						</div>
						<div class="col-xs-11 col-sm-11 col-md-8 col-lg-9">
							<h3>Ver todos os Usuários</h3>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
							<div class="float-right">
								<form method="get" action="./index.php">
									<button class="botaoSecundario" type="submit" value="submit">
										Ver Todos
										<div class="circuloSecundario">
											<img src="../../public/svgs/user-branco.png" width="15px"></img>
										</div>
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>

                    <br>
                    <br>

                    <h3 class="cinza">
                        Cadastrar Novo Usuário
                    </h3>
                    <br>
                    <form title="Dados do Usuário" action="../../controller/ControllerCadastroUsuario.php" method="post" id="fmUser" enctype='application/json' class="box">
                        <div class="bloco">

                            <h5>Dados do Usuário</h5>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                    <input class="form-control" type="text" placeholder="Nome" name="nome" maxlength="60" autofocus />
                                    <label class="label">Nome</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                    <input class="form-control" type="email" placeholder="E-mail" name="email" maxlength="50" />
                                    <label>E-mail</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                    <input class="form-control" type="text" placeholder="Função" id="funcao" name="funcao" maxlength="50" />
                                    <label>Função</label>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                    <input class="form-control" type="number" placeholder="Telefone" id="telefone" name="telefone" maxlength="11" />
                                    <label>Telefone</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                    <input class="form-control" type="password" placeholder="Senha" id="senha" name="senha" maxlength="8" />
                                    <label>Senha</label>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                    <input class="form-control" type="password" placeholder="Repita a Senha" id="repitaSenha" name="repitaSenha" maxlength="8" />
                                    <label>Repita a Senha</label>
                                </div>
                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <label>Status</label>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="statusAtivo" name="status" value="1" checked />
                                            <label class="custom-control-label label3" for="statusAtivo">Ativo</label>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="statusInativo" name="status" value="0" />
                                            <label class="custom-control-label label3" for="statusInativo">Inativo</label>
                                        </div>
                                    </div>
                                </div>
                            </div>						
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <br>
                                <button class="botaoPadrao200 float-right" type="submit" value="submit">
                                    Cadastrar Usuário
                                    <div class="circuloPadrao200">
                                        <img src="../../public/svgs/add_laranjado.png" width="15px"></img>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
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