<?php
  session_start();
?>
<!DOCTYPE HTML>
<html lang="pt" xmlns="http://www.w3.org/1999/html">

<?php include("headcliente.php"); ?>

<body>

    <?php include("../../header.php"); ?>
	<div class="breadcrumb-container">
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb-title">
                <h2>Área do Distribuidor</h2>
            </div>
            <div class="breadcrumb-navigation"><a class="bread-home" href="https://movelin.com.br/area-distribuidor"><span>Início</span></a><span class="divisor-breadcrumb">|</span><span class="pagina-atual-breadcrumb">Meus Clientes</span></div>
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
                                <a class="nav-link aLista active" href="../clientes">
                                    <img src="../../public/svgs/followers-cinza.png" class="icone20"></img>
                                    <img class="imgHover icone20" src="../../public/svgs/followers-branco.png">
                                    Meus Clientes
                                </a>
                            </li>

                            <li class="nav-item">
								<a class="nav-link aLista active" href="../entregas">
									<img src="../../public/svgs/key-cinza.png" class="icone20"></img>
									<img class="imgHover icone20" src="../../public/svgs/key-branco.png">
									Ativar Produtos
								</a>
							</li>

                            <?php if  ($_SESSION['usuarioMascara'] == '') {?>
                                <li class="nav-item">
                                    <a class="nav-link aLista" href="../usuarios">
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
							<img src="../../public/svgs/followers.png" class="icone56">
						</div>
						<div class="col-xs-11 col-sm-11 col-md-8 col-lg-9">
							<h3>Ver todos os Clientes</h3>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
							<div class="float-right">
								<form method="get" action="./index.php">
									<button class="botaoSecundario" type="submit" value="submit">
										Ver Todos
										<div class="circuloSecundario">
											<img src="../../public/svgs/followers-branco.png" width="15px"></img>
										</div>
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
                <br><br>

                    <?php
                    include "../../model/bancoCliente.php";
                    $banco = new BancoCliente();
                    $param = $_GET['id'];
                    $array = $banco->getClienteId($param);
                    foreach ($array as $linha) {
                        ?>

                        <form method="post" action="../../controller/ControllerCadastroClienteEdit.php" id="fmCliente">
                            <h3 class="cinza">
                                Editar Cliente
                            </h3>
                            <br>
                            <div class="bloco">

                                <h5>Dados do Cliente</h5>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                        <input value="<?php echo $linha['Nomefantasia'] ?>" name="fantasia" class="form-control" type="text" id="fantasia" placeholder="Nome da Empresa" maxlength="60" />
                                        <label>Nome da Empresa</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                        <label>Razão Social</label>
                                        <input value="<?php echo $linha['Razaosocial'] ?>" name="razao" class="form-control" type="text" id="razao" placeholder="Razão Social" maxlength="60" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <input value="<?php echo $linha['Cnpjcpf'] ?>" class="form-control" type="text" placeholder="CNPJ/CPF" id="documento" name="documento" maxlength="14" />
                                        <label>CNPJ/CPF</label>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <input value="<?php echo $linha['Inscestadual'] ?>" class="form-control" type="text" placeholder="Insc. Estadual" id="ie" name="ie" maxlength="20" />
                                        <label>Inscrição Estadual</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <input value="<?php echo $linha['Email'] ?>" class="form-control" type="email" placeholder="E-mail" id="email" name="email" maxlength="50" />
                                        <label>E-mail</label>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <input value="<?php echo $linha['Emailvalida'] ?>" class="form-control" type="email" placeholder="Repita o e-mail" id="repitaEmail" name="repitaEmail" maxlength="50" />
                                        <label>Repita o e-mail</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <input value="<?php echo $linha['Telefone'] ?>" class="form-control" type="text" placeholder="Telefone Fixo" id="telefone" name="telefone" maxlength="11" />
                                        <label>Telefone Fixo</label>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <input value="<?php echo $linha['Celular'] ?>" class="form-control" type="text" placeholder="Celular" id="celular" name="celular" maxlength="11" />
                                        <label>Celular</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                        <input value="<?php echo $linha['NomeContato'] ?>" class="form-control" type="text" placeholder="Pessoa de Contato" id="contato" name="contato" maxlength="60" />
                                        <label>Pessoa de Contato</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
                                        <input value="<?php echo $linha['Endereco'] ?>" class="form-control" type="text" placeholder="Endereço" id="endereco" name="endereco" maxlength="60" />
                                        <label>Endereço</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <input value="<?php echo $linha['Cep'] ?>" class="form-control" type="text" placeholder="CEP" id="CEP" name="cep" maxlength="8" />
                                        <label>CEP</label>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <input value="<?php echo $linha['Bairro'] ?>" class="form-control" type="text" placeholder="Bairro" id="bairro" name="bairro" maxlength="30" />
                                        <label>Bairro</label>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <input value="<?php echo $linha['Complemento'] ?>" class="form-control" type="text" placeholder="Complemento" id="complemento" name="complemento" maxlength="60" />
                                        <label>Complemento</label>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <select name="pais" id="pais" class="form-control" required="required">
                                            <option value="<?php echo $linha['Idpais']; ?>"><?php echo $linha['Pais'] ?></option>
                                            <?php
                                                include "../../model/bancoPais.php";
												$codpais = $linha['Idpais'];
                                                $banco = new BancoPais();
                                                $array = $banco->getPaisEdit($codpais);
                                                foreach ($array as $linhaP) {
                                                    ?>
                                                <option value="<?php echo $linhaP['Id']; ?>"><?php echo utf8_encode($linhaP['Nome']); ?></option>
                                            <?php
                                                }
                                                ?>
                                        </select>
                                        <label>País</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <select name="estado" id="estado" class="form-control" required="required">
                                            <option><?php echo $linha['Estado'] ?></option>                                            
                                        </select>
                                        <label>Estado</label>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <input value="<?php echo $linha['Cidade'] ?>" class="form-control" type="text" placeholder="Cidade" id="cidade" name="cidade" maxlength="60" />
                                        <label>Cidade</label>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <br>


                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <br>
                                    <button class="botaoPadrao200 float-right" type="submit" value="submit">
                                        Salvar Cliente
                                        <div class="circuloPadrao200">
                                            <img src="../../public/svgs/add_laranjado.png" width="15px"></img>
                                        </div>
                                    </button>
                                </div>
                                <input type="hidden" name="id" id="id" value="<?php echo $param ?>">
                            </div>

                        </form>

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
	<script type="text/javascript">
		$(document).ready(function(){
			$('#pais').change(function(){
				$('#estado').load('listaEstados.php?pais='+$('#pais').val());
			});
		});
    </script>
</body>

</html>