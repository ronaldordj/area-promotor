<?php
  session_start();
?>
<!DOCTYPE HTML>
<html lang="pt-br" xmlns="http://www.w3.org/1999/html">

<?php 
	include("headIndicacoes.php"); 
	require_once("../../model/init.php");	
	$db = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);

	$sql="SELECT MAX(Idindicacao) as maior from mi_indicacao";
	$sql_result=mysqli_query($db,$sql)or die("Erro:".mysqli_error($db));
	$row=mysqli_fetch_array($sql_result);	
	$idindicacao = $row['maior']+1;
?>

<body>
    <?php include("../../header.php"); ?>
	<div class="breadcrumb-container">
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb-title">
                <h2>Área do Promotor</h2>
            </div>
            <div class="breadcrumb-navigation"><a class="bread-home" href="https://movelin.com.br/area-promotor"><span>Início</span></a><span class="divisor-breadcrumb">|</span><span class="pagina-atual-breadcrumb">Área do Promotor</span></div>
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
								<a class="nav-link aLista active" href="index.php">
									<img src="../../public/svgs/like.png" class="icone20"></img>
									<img class="imgHover icone20" src="../../public/svgs/like-branco.png">
									Indicações
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
							<h3>Ver todas as indicações</h3>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
							<div class="float-right">
								<form method="get" action="./index.php">
									<button class="botaoSecundario" type="submit" value="submit">
										Ver Todas
										<div class="circuloSecundario">
											<img src="../../public/svgs/like-branco.png" width="15px"></img>
										</div>
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<form method="post" action="../../controller/ControllerCadastroIndicacao.php" id="fmIndicacao">
					<h3 class="cinza">
						Cadastrar Nova Indicação
					</h3>
					<br>
					<div class="bloco">

						<h5>Ficha de Indicação</h5>

						<div class="row">
							<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 form-group">
								<input name="data" class="form-control form-control-lg" type="text" id="data" placeholder="Data" readonly value="<?php echo date("d/m/Y") ?>" />
								<label>Data</label>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<label>Razão Social</label>
								<input name="razao" class="form-control form-control-lg" type="text" id="razao" placeholder="Razão Social" maxlength="60" required />
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<label>Nome Fantasia</label>
								<input name="fantasia" class="form-control form-control-lg" type="text" id="fantasia" placeholder="Nome Fantasia" maxlength="60" required />
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<label>Nome do Contato</label>
								<input name="contato" class="form-control form-control-lg" type="text" placeholder="Nome do Contato" maxlength="60" required />
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="text" placeholder="CNPJ/CPF" id="documento" name="documento" maxlength="14" required />
								<label>CNPJ/CPF</label>
							</div>
						</div>											

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="text" placeholder="Telefone Fixo" id="telefone" name="telefone" maxlength="14" required />
								<label>Telefone Fixo</label>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="text" placeholder="Celular" id="celular" name="celular" maxlength="15" required />
								<label>Celular</label>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="email" placeholder="E-mail" id="email" name="email" maxlength="80" required />
								<label>E-mail</label>
							</div>	
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control form-control-lg" type="text" placeholder="Site" id="site" name="site" maxlength="80" />
								<label>Site</label>
							</div>							
						</div>
					</div>

					<br>
					<div class="bloco">

						<h5>Produto de Interesse</h5>
						<br>					
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<input type="checkbox" id="tipoCombo" name="tipo" value="COMBO">								
									<label>COMBO</label>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<input type="checkbox" id="tipoIncad" name="tipo" value="INCAD">								
									<label>INCAD</label>
							</div>
						</div>
						<br>					
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<input type="checkbox" id="modalidadeMono" name="modalidade" value="MONOUSUARIO">								
									<label>MONOUSUÁRIO</label>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<input type="checkbox" id="modalidadeMulti" name="modalidade" value="MULTIUSUARIO">								
									<label>MULTIUSUÁRIO</label>
							</div>
						</div>
						<br>					
						<div class="row">
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<input type="checkbox" id="integracaoSem" name="integracao" value="SEM INTEGRAÇÃO">								
									<label>SEM INTEGRAÇÃO</label>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<input type="checkbox" id="integracaoInmes" name="integracao" value="COM INTEGRACAO INMES">								
									<label>COM INTEGRAÇÃO INMES</label>
							</div>
							<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<input type="checkbox" id="integracaoOutra" name="integracao" value="COM INTEGRACAO OUTRA">								
									<label>COM INTEGRAÇÃO OUTRA</label>
							</div>
						</div>					

					</div>


					<br>
					<div class="bloco">
						<h5>Revenda</h5>
						<br>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
								<label>Nome da Revenda</label>
								<input name="revenda" class="form-control form-control-lg" type="text" id="revenda" placeholder="Digite as iniciais para busca" maxlength="100" required autocomplete="off"/>
							</div>
						</div>
						<!-- Código da Revenda -->
						<input class="form-control" type="hidden" id="idrevenda" name="idrevenda">
						<!-- Fim -->					
					</div>	
					<br>
					<br>

					<input class="form-control" type="hidden" id="idindicacao" name="idindicacao" value="<?php echo $idindicacao ?>">
					<input class="form-control" type="hidden" id="dataindicacao" name="dataindicacao" value="<?php echo date('Y-m-d') ?>">
					<input class="form-control" value="<?php echo $_SESSION['usuarioId']; ?>" type="hidden" placeholder="" id="idpromotor" name="idpromotor">

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<br>
							<button class="botaoPadrao200 float-right" type="submit" value="submit">
								Enviar Indicação
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
	
	
	<br>
	<?php include("../../footer.php"); ?>	

	<script>
        $(document).ready(function() {
            $("#revenda").autocomplete({
                source: "getRevendas.php",
                minLength: 1,
                select: function(event, ui) {
                    $("#idrevenda").val(ui.item.codigo);
					$("#revenda").val(ui.item.nome);                    
                }
            }).data("ui-autocomplete")._renderItem = function(ul, item) {
                return $("<li class='ui-autocomplete-row'></li>")
                    .data("item.autocomplete", item)
                    .append(item.label)
                    .appendTo(ul);
            };
        });
    </script>

	<script>
		$(document).ready(function(){
			var SPMaskBehavior = function (val) {
				return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
			},
			spOptions = {
				onKeyPress: function(val, e, field, options) {
					field.mask(SPMaskBehavior.apply({}, arguments), options);
				}
			};

			$('#telefone').mask(SPMaskBehavior, spOptions);
      		$('#celular').mask(SPMaskBehavior, spOptions);
		});
	</script>

<script>
	$(document).ready(function() {
			//PRODUTOS DE INTERESSE
			//COMBO
			$("#tipoCombo").on("change", function() {
				if (this.checked) {					
					$("#tipoIncad").prop('disabled',true);
				}
				else {
					$("#tipoIncad").prop('disabled',false);
					}
			});	
			//INCAD
			$("#tipoIncad").on("change", function() {
				if (this.checked) {					
					$("#tipoCombo").prop('disabled',true);
				}
				else {
					$("#tipoCombo").prop('disabled',false);
					}
			});	

			//MONOUSUARIO
			$("#modalidadeMono").on("change", function() {
				if (this.checked) {					
					$("#modalidadeMulti").prop('disabled',true);
				}
				else {
					$("#modalidadeMulti").prop('disabled',false);
					}
			});	
			//MULTIUSUARIO
			$("#modalidadeMulti").on("change", function() {
				if (this.checked) {					
					$("#modalidadeMono").prop('disabled',true);
				}
				else {
					$("#modalidadeMono").prop('disabled',false);
					}
			});	

			//SEM INTEGRACAO
			$("#integracaoSem").on("change", function() {
				if (this.checked) {					
					$("#integracaoInmes").prop('disabled',true);
					$("#integracaoOutra").prop('disabled',true);
				}
				else {
					$("#integracaoInmes").prop('disabled',false);
					$("#integracaoOutra").prop('disabled',false);
					}
			});
			//INTEGRAÇÃO INMES
			$("#integracaoInmes").on("change", function() {
				if (this.checked) {					
					$("#integracaoSem").prop('disabled',true);
					$("#integracaoOutra").prop('disabled',true);
				}
				else {
					$("#integracaoSem").prop('disabled',false);
					$("#integracaoOutra").prop('disabled',false);
					}
			});
			//INTEGRAÇÃO OUTRA
			$("#integracaoOutra").on("change", function() {
				if (this.checked) {					
					$("#integracaoSem").prop('disabled',true);
					$("#integracaoInmes").prop('disabled',true);
				}
				else {
					$("#integracaoSem").prop('disabled',false);
					$("#integracaoInmes").prop('disabled',false);
					}
			});
	});			
</script>


</body>

</html>