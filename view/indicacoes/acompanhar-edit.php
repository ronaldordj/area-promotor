<?php
session_start();
?>
<!doctype html>

<html lang="pt" xmlns="http://www.w3.org/1999/html">

<?php 
	include("headIndicacoes.php"); 
	$idindicacao = base64_decode($_GET['ind']);	
?>

<body>
	<?php include("../../header.php");?>
	<div class="breadcrumb-container">
        <div class="breadcrumb-wrapper">
            <div class="breadcrumb-title">
                <h2>Área do Promotor</h2>
            </div>
            <div class="breadcrumb-navigation"><a class="bread-home" href="https://movelin.com.br/area-distribuidor"><span>Início</span></a><span class="divisor-breadcrumb">|</span><span class="pagina-atual-breadcrumb">Acompanhar Indicação</span></div>
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
							<h3>Ver todas as Indicações </h3>
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

				<br><br>

				<h3 class="cinza">
					Acompanhamento de Indicação
				</h3>				
				<form method="post" action="../../controller/ControllerCadastroAcompanhamentoEdit.php">
					<?php	
						include "../../model/bancoIndicacao.php";
						$banco = new BancoIndicacao();									
						$acompanhamentos = $banco->getAcompanhamento($idindicacao);											
						foreach ($acompanhamentos as $acompanhamento) {
					?>
					<div class="bloco">
						<h6>Cliente</h6>
						<div class="row">
							<div class = "col-xs-12 col-md-12 col-lg-12">
								<h5><?php echo $acompanhamento['Razaosocial'];?></h5>
							</div>
						</div>
					</div>
					<br>
					<div class="bloco">						
						<table class="table">
							<thead>
								<tr>
								<th scope="col">Indicação</th>
								<th scope="col">Contato c/ cliente</th>
								<th scope="col">Agendado apresentação</th>
								<th scope="col">Enviado proposta</th>
								<th scope="col">Fechado</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td width="10%">										
										<input type="date" class="form-control" disabled id="dataindicacao" name="dataindicacao" value="<?php echo $acompanhamento['Dataindicacao']?>">
									</td>
									<td width="10%">
										<input type="date" class="form-control" checked id="datacontato" name="datacontato" value="<?php echo $acompanhamento['Datacontato']?>">
									</td>
									<td>
										<div class="form-check">					  
											<input name="apresentacao" class="form-check-input" type="radio" id="apresentacaoN" value="N" <?php if ($acompanhamento['Flapresentacao'] == "N") {echo 'checked';} ?>>
											<label class="form-check-label" for="apresentacao">
												Não
											</label>
										</div>
										<div class="form-check">					  
											<input name="apresentacao" class="form-check-input" type="radio" id="apresentacaoS" value="S" <?php if ($acompanhamento['Flapresentacao'] == "S") {echo 'checked';} ?>>
											<label class="form-check-label" for="apresentacao">
												Sim
											</label>
										</div>										
									</td>
									<td width="10%">
										<input type="date" class="form-control" checked id="dataproposta" name="dataproposta" value="<?php echo $acompanhamento['Dataproposta']?>">
									</td>
									<td>
										<div class="form-check">					  
											<input name="fechado" class="form-check-input" type="radio" id="fechadoN" value="N" <?php if ($acompanhamento['Flfechado'] == "N") {echo 'checked';} ?>>
											<label class="form-check-label" for="fechado">
												Não
											</label>
										</div>
										<div class="form-check">					  
											<input name="fechado" class="form-check-input" type="radio" id="fechadoS" value="S" <?php if ($acompanhamento['Flfechado'] == "S") {echo 'checked';} ?>>
											<label class="form-check-label" for="fechado">
												Sim
											</label>
										</div>
									</td>
								</tr>
								
							</tbody>
						</table>

						<br>

						<!-- AGENDADO APRESENTAÇÃO = NÃO -->															
						<div class='form-group' id='interesses' style='display: none'>						
							<div class="card-group">
								<div class="card">								
									<div class="card-body">
										<h5 class="card-title">Agendado Apresentação</h5>
										<div class="form-row">
											<div class="col-xs-12 col-md-12 col-lg-12">
												<div class="form-check">					  
												<input name="interesse" class="form-check-input" type="radio" id="interesse1" value="SI" <?php if ($acompanhamento['Flinteresse'] == "SI") {echo 'checked';} ?>>
												<label class="form-check-label" for="interesse">
													Não teve interesse
												</label>
												</div>
											</div>
											<div class="col-xs-12 col-md-12 col-lg-12">
												<div class="form-check">					  
												<input name="interesse" class="form-check-input" type="radio" id="interesse2" value="AG" <?php if ($acompanhamento['Flinteresse'] == "AG") {echo 'checked';} ?>>
												<label class="form-check-label" for="interesse">
													Aguardando horário
												</label>
												</div>
											</div>
											<div class="col-xs-12 col-md-12 col-lg-12">
												<div class="form-check">					  
												<input name="interesse" class="form-check-input" type="radio" id="interesse3" value="OU" <?php if ($acompanhamento['Flinteresse'] == "OU") {echo 'checked';} ?>>
												<label class="form-check-label" for="interesse">
													Outro
												</label>
												</div>
											</div>
										</div>  		
									
										<div class="form-group" id="motivos" style="display: none">
											<div class="form-row">
												<div class="col-xs-6 col-md-6 col-lg-6">
													<label class="form-check-label" for="motivo">Motivo</label><br>
													<textarea class="form-control" id="motivo" name="motivo"><?php echo $acompanhamento['Motivointeresse']?></textarea>
												</div>
											</div>
										</div>
									</div>	
								</div>
							</div>
						</div>

						<!-- AGENDADO APRESENTAÇÃO = NÃO *****EDITANDO***** -->															
						<?php if($acompanhamento['Flapresentacao'] == "N") { ?>
							<div class='form-group'>						
								<div class="card-group">
									<div class="card">								
										<div class="card-body">
											<h5 class="card-title">Agendado Apresentação</h5>
											<div class="form-row">
												<div class="col-xs-12 col-md-12 col-lg-12">
													<div class="form-check">					  
													<input name="interesse" class="form-check-input" type="radio" id="interesseSI" value="SI" <?php if ($acompanhamento['Flinteresse'] == "SI") {echo 'checked';} ?>>
													<label class="form-check-label" for="interesse">
														Não teve interesse
													</label>
													</div>
												</div>
												<div class="col-xs-12 col-md-12 col-lg-12">
													<div class="form-check">					  
													<input name="interesse" class="form-check-input" type="radio" id="interesseAG" value="AG" <?php if ($acompanhamento['Flinteresse'] == "AG") {echo 'checked';} ?>>
													<label class="form-check-label" for="interesse">
														Aguardando horário
													</label>
													</div>
												</div>
												<div class="col-xs-12 col-md-12 col-lg-12">
													<div class="form-check">					  
													<input name="interesse" class="form-check-input" type="radio" id="interesseOU" value="OU" <?php if ($acompanhamento['Flinteresse'] == "OU") {echo 'checked';} ?>>
													<label class="form-check-label" for="interesse">
														Outro
													</label>
													</div>
												</div>
											</div>  		
										
											<div class="form-group">
												<div class="form-row">
													<div class="col-xs-6 col-md-6 col-lg-6">
														<label class="form-check-label" for="motivo" id="lblmotivoED">Motivo</label><br>
														<textarea class="form-control" id="motivoED" name="motivo"><?php echo $acompanhamento['Motivointeresse']?></textarea>
													</div>
												</div>
											</div>
										</div>	
									</div>
								</div>
							</div>
						<?php } ?>	

						<!-- AGENDADO APRESENTAÇÃO = SIM -->
						<div class="form-group" id="agendado" style="display: none">
							<div class="card-group">
								<div class="card">								
									<div class="card-body">
										<h5 class="card-title">Agendado Apresentação</h5>
										<div class="form-group">
											<div class="form-row">
												<div class="col-xs-2 col-md-3 col-lg-3">
													<label class="form-check-label" for="dataagendamento">Data</label><br>
													<input type="date" class="form-control" checked id="dataagendamento" name="dataagendamento" value="<?php echo $acompanhamento['Dataapresentacao']?>">
												</div>
											</div>
										</div>		
									
										<div class="form-row">
											<label class="form-check-label" for="interesse">Houve interesse?</label><br>
											<div class="col-xs-12 col-md-12 col-lg-12">
												<div class="form-check">					  
													<input name="interesseA" class="form-check-input" type="radio" id="interesseN" value="N" <?php if ($acompanhamento['Flinteresseapr'] == "N") {echo 'checked';} ?>>
													<label class="form-check-label" for="interesseA">
														Não
													</label>
												</div>
											</div>
											<div class="col-xs-12 col-md-12 col-lg-12">
												<div class="form-check">					  
													<input name="interesseA" class="form-check-input" type="radio" id="interesseS" value="S" <?php if ($acompanhamento['Flinteresseapr'] == "S") {echo 'checked';} ?>>
													<label class="form-check-label" for="interesseA">
														Sim
													</label>
												</div>
											</div>								
										</div>

										<div class="form-group" id="motivos2" style="display: none">
											<div class="form-row">
												<div class="col-xs-6 col-md-6 col-lg-6">
													<label class="form-check-label" for="motivo2">Motivo</label><br>
													<textarea class="form-control" id="motivo2" name="motivo2"><?php echo $acompanhamento['Motivoapresentacao']?></textarea>
												</div>
											</div>
										</div>
									</div>		
								</div>
							</div>								  		
						</div>	

						<!-- AGENDADO APRESENTAÇÃO = SIM ******EDITANDO****** -->
						<?php if($acompanhamento['Flapresentacao'] == "S") { ?>
							<div class="form-group">
								<div class="card-group">
									<div class="card">								
										<div class="card-body">
											<h5 class="card-title">Agendado Apresentação</h5>
											<div class="form-group">
												<div class="form-row">
													<div class="col-xs-2 col-md-3 col-lg-3">
														<label class="form-check-label" for="dataagendamento">Data</label><br>
														<input type="date" class="form-control" checked id="dataagendamento" name="dataagendamento" value="<?php echo $acompanhamento['Dataapresentacao']?>">
													</div>
												</div>
											</div>		
										
											<div class="form-row">
												<label class="form-check-label" for="interesse">Houve interesse?</label><br>
												<div class="col-xs-12 col-md-12 col-lg-12">
													<div class="form-check">					  
														<input name="interesseA" class="form-check-input" type="radio" id="interesseNed" value="N" <?php if ($acompanhamento['Flinteresseapr'] == "N") {echo 'checked';} ?>>
														<label class="form-check-label" for="interesseA">
															Não
														</label>
													</div>
												</div>
												<div class="col-xs-12 col-md-12 col-lg-12">
													<div class="form-check">					  
														<input name="interesseA" class="form-check-input" type="radio" id="interesseSed" value="S" <?php if ($acompanhamento['Flinteresseapr'] == "S") {echo 'checked';} ?>>
														<label class="form-check-label" for="interesseA">
															Sim
														</label>
													</div>
												</div>								
											</div>
							
											<div class="form-group" id="motivos2ED" style="display: none">
												<div class="form-row">
													<div class="col-xs-6 col-md-6 col-lg-6">
														<label class="form-check-label" for="motivo2" id="lblmotivo2ED">Motivo</label><br>
														<textarea class="form-control" id="motivo2ED" name="motivo2"><?php echo $acompanhamento['Motivoapresentacao']?></textarea>
													</div>
												</div>
											</div>

										</div>		
									</div>
								</div>								  		
							</div>
						<?PHP } ?>							

						<!-- FECHADO = NÃO -->
						<div class="form-group" id="feedback" style="display: none">
							<div class="card-group">
								<div class="card">								
									<div class="card-body">
										<h5 class="card-title">Fechado</h5>									
										<div class="form-row">
											<div class="col-xs-6 col-md-6 col-lg-6">
												<label class="form-check-label" for="feed">Feedback</label><br>
												<textarea rows="8" cols="800" class="form-control" id="feed" name="feed"><?php echo $acompanhamento['Motivofechado']?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>	

						<!-- FECHADO = NÃO ****EDITANDO****-->
						<?php if($acompanhamento['Flfechado'] == "S") { ?>
							<div class="form-group" id="feedback" style="display: none">
								<div class="card-group">
									<div class="card">								
										<div class="card-body">
											<h5 class="card-title">Fechado</h5>									
											<div class="form-row">
												<div class="col-xs-6 col-md-6 col-lg-6">
													<label class="form-check-label" for="feed">Feedback</label><br>
													<textarea rows="8" cols="800" class="form-control" id="feed" name="feed"><?php echo $acompanhamento['Motivofechado']?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>	
						<?php } elseif ($acompanhamento['Flfechado'] == "N") { ?>							
							<div class="form-group" id="feedback">
								<div class="card-group">
									<div class="card">								
										<div class="card-body">
											<h5 class="card-title">Fechado</h5>									
											<div class="form-row">
												<div class="col-xs-6 col-md-6 col-lg-6">
													<label class="form-check-label" for="feed">Feedback</label><br>
													<textarea rows="8" cols="800" class="form-control" id="feed" name="feed"><?php echo $acompanhamento['Motivofechado']?></textarea>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>	

						<input type="hidden" class="form-control" id="idindicacao" name="idindicacao" value="<?php echo $acompanhamento['Idindicacao']?>">


					<?php } ?>
					<br>			
				</div>
				<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<br>
							<button class="botaoPadrao200 float-right" type="submit" value="submit">
								Salvar
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
	<br> <br>
	<?php include("../../footer.php");?>

	<style>
		.disabled {
			color: #ffffff;			
		}
		.enabled {
			color: #6c757d;        
		}
		.some {
			display: none;
		}

	</style>

	<script>  				
		$(document).ready(function() {
			$("#apresentacaoN").on("change", function() {
				if (this.checked) {
					$("#interesses").show();											
					$("#agendado").hide();
				}
			});			

			$("#interesse3").on("change", function() {										
				if (this.checked) {
					$("#motivos").show();					
				}	
			});

			$("#interesse1").on("change", function() {										
				if (this.checked) {					
					$("#motivos").hide();
				}	
			});

			$("#interesse2").on("change", function() {										
				if (this.checked) {					
					$("#motivos").hide();
				}	
			});

			$("#interesseOU").on("change", function() {										
				if (this.checked) {
					$("#motivoED").show();
					$("#lblmotivoED").addClass('enabled');					
				}	
			});

			$("#interesseSI").on("change", function() {										
				if (this.checked) {					
					$("#motivoED").hide();
					$("#lblmotivoED").addClass('disabled');
				}	
			});

			$("#interesseAG").on("change", function() {										
				if (this.checked) {					
					$("#motivoED").hide();
					$("#lblmotivoED").addClass('disabled');
				}	
			});			

			$("#apresentacaoS").on("change", function() {
				if (this.checked) {
					$("#agendado").show();
					$("#interesses").hide();
					$("#motivos").hide();
				}
			});

			$("#interesseN").on("change", function() {										
				if (this.checked) {
					$("#motivos2").show();
				}	
			});
			$("#interesseS").on("change", function() {										
				if (this.checked) {
					$("#motivos2").hide();
				}	
			});

			$("#interesseNed").on("change", function() {										
				if (this.checked) {
					$("#motivos2ED").show();
					$("#motivo2ED").show();
				}	
			});
			$("#interesseSed").on("change", function() {										
				if (this.checked) {
					$("#motivo2ED").hide();
					$("#lblmotivo2ED").addClass('disabled');					
				}	
			});

			$("#fechadoN").on("change", function() {										
				if (this.checked) {
					$("#feedback").show();
				}	
			});

			$("#fechadoS").on("change", function() {										
				if (this.checked) {
					$("#feedback").hide();
				}	
			});			

		});		
	</script>


	

	<script>
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
	</script>

	
</body>

</html>