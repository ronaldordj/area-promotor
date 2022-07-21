<?php
  session_start();
?>
<!DOCTYPE HTML>
<html lang="pt-br" xmlns="http://www.w3.org/1999/html">

<?php 
	include("headcliente.php"); 
	require_once("../../model/init.php");
?>

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
								<a class="nav-link aLista" href="../ativacoes">
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
				<form method="post" action="../../controller/ControllerCadastroCliente.php" id="fmCliente">
					<h3 class="cinza">
						Cadastrar Novo Cliente
					</h3>
					<br>
					<div class="bloco">

						<h5>Dados do Cliente</h5>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
								<input name="fantasia" class="form-control form-control-lg" type="text" id="fantasia" placeholder="Nome da Empresa" maxlength="60" required />
								<label>Nome da Empresa</label>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
								<label>Razão Social</label>
								<input name="razao" class="form-control form-control-lg" type="text" id="razao" placeholder="Razão Social" maxlength="60" required />
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="text" placeholder="CNPJ/CPF" id="documento" name="documento" maxlength="14" required />
								<label>CNPJ/CPF</label>
							</div>
							<!-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="text" placeholder="Insc. Estadual" id="ie" name="ie" maxlength="20" />
								<label>Inscrição Estadual</label>
							</div> -->
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="email" placeholder="E-mail" id="email" name="email" maxlength="50" required />
								<label>E-mail</label>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="email" placeholder="Repita o e-mail" id="repitaEmail" name="repitaEmail" maxlength="50" required />
								<label>Repita o e-mail</label>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="text" placeholder="Telefone Fixo" id="telefone" name="telefone" maxlength="11" required />
								<label>Telefone Fixo</label>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="text" placeholder="Celular" id="celular" name="celular" maxlength="11" required />
								<label>Celular</label>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
								<input class="form-control form-control-lg" type="text" placeholder="Pessoa de Contato" id="contato" name="contato" maxlength="60" required />
								<label>Pessoa de Contato</label>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
								<input class="form-control form-control-lg" type="text" placeholder="Endereço" id="endereco" name="endereco" maxlength="60" required />
								<label>Endereço</label>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="text" placeholder="CEP" id="CEP" name="cep" maxlength="8" required />
								<label>CEP</label>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="text" placeholder="Bairro" id="bairro" name="bairro" maxlength="30" required />
								<label>Bairro</label>
							</div>

						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="text" placeholder="Complemento" id="complemento" name="complemento" maxlength="60" />
								<label>Complemento</label>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<select name="pais" id="pais" class="form-control form-control-lg" required="required" placeholder="País">
									<option></option>
									<?php
											include "../../model/bancoPais.php";
											$banco = new BancoPais();
											$array = $banco->getPais();												
											foreach ($array as $linhaP) {	
									?>
											<option value="<?php echo $linhaP['Id'];?>"><?php echo utf8_encode($linhaP['Nome']);?></option>	
									<?php												
											}								
									?>
								</select>
								<label>País</label>
							</div>
						</div>
						
						<div class="row">							
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">								
								<select name="estado" id="estado" class="form-control form-control-lg" required="required" placeholder="Estado">
								<option>Estado</option>
								</select>
								<label>Estado</label>
							</div>	
							
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="text" placeholder="Cidade" id="cidade" name="cidade" maxlength="60" required />
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
								Cadastrar Cliente
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
	
	<script>
		$("#menu-toggle").click(function(e) {
		  e.preventDefault();
		  $("#wrapper").toggleClass("toggled");
		});
	 </script>
    <script>
		var vemail = document.getElementById("email"), vconfirma = document.getElementById("repitaEmail");

		function validateEmail(){
		  if(vemail.value != vconfirma.value) {
			vconfirma.setCustomValidity("Os e-mail's estão diferentes!");
		  } else {
			vconfirma.setCustomValidity('');
		  }
		}

		vemail.onchange = validateEmail;
		vconfirma.onkeyup = validateEmail;
	</script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#pais').change(function(){
				$('#estado').load('listaEstados.php?pais='+$('#pais').val());
			});
		});
    </script>
	
	
	
	<?php include("../../footer.php"); ?>	
</body>

</html>