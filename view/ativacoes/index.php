<?php
session_start();
?>
<!doctype html>

<html lang="pt" xmlns="http://www.w3.org/1999/html">

<?php include("headAtivacoes.php");
$cliente = $_GET['cliente'];
$data    = $_GET['data'];
$status  = $_GET['status'];
?>

<body class="view-entregas">
	<?php include("../../header.php"); ?>
	<div class="breadcrumb-container">
		<div class="breadcrumb-wrapper">
			<div class="breadcrumb-title">
				<h2>Área do Distribuidor</h2>
			</div>
			<div class="breadcrumb-navigation"><a class="bread-home" href="https://movelin.com.br/area-distribuidor"><span>Início</span></a><span class="divisor-breadcrumb">|</span><span class="pagina-atual-breadcrumb">Ativar Produtos</span></div>
		</div>
	</div>
	<div id="content">
		<div class="d-flex" id="wrapper">
			<div class="bg-light border-right" id="sidebar-wrapper">
				<div class="list-group list-group-flush">
					<div style="height: 100px">
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
								<a class="nav-link aLista active" href="">
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
							<?php } ?>

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
				<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" id="navbar">
					<button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
				</nav>
				<div class="titulo">
					<div class="row">
						<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
							<img src="../../public/svgs/key.png" class="icone56"></img>
						</div>
						<div class="col-xs-11 col-sm-11 col-md-7 col-lg-8">
							<h3>Nova Ativação de Produto</h3>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
							<div class="float-right">
								<form method="get" action="./cadastroAtivacoes.php">
									<button class="botaoSecundario200" type="submit" value="submit">
										Nova Ativação
										<div class="circuloSecundario200">
											<img src="../../public/svgs/key-branco.png" width="15px"></img>
										</div>
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<br> <br>

				<section>
					<h3 class="cinza">
						Todas as Ativações de Produtos
					</h3>
					<form method="get">
						<div class="bloco">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<label class="label2">Cliente</label>
									<input class="form-control busca" type="search" placeholder="" name="cliente" id="cliente">
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-2">
									<label class="label2">Status</label>
									<select class="form-control form-control-lg" tabindex="-1" name="status">
										<option value="">Todos</option>
										<option value="0">Solicitação Recebida</option>
										<option value="1">Contato com o cliente realizado</option>
										<option value="2">Implantação Agendada</option>
										<option value="3">Implantação Finalizada</option>
										<option value="4">Solicitação Cancelada</option>
									</select>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
									<label class="label2">Data</label>
									<input class="form-control" type="date" placeholder="" name="data" id="data">
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-3">
									<br>
									<div class="float-right">
										<button class="botaoPadrao" type="submit" value="submit">
											Filtrar
											<div class="circuloPadrao">
												<img src="../../public/svgs/filter.png" width="15px"></img>
											</div>
										</button>
									</div>
								</div>

							</div>
						</div>
					</form>
					<br>
					<div class="container">
						<div class="row">
							<?php if (!empty($cliente) && empty($data) && empty($status)) { ?>
								<h6>Resultado da busca por <?php echo "Cliente: " . $cliente; ?></h6>
							<?php } ?>
							<?php if (empty($cliente) && !empty($data) && empty($status)) { ?>
								<h6>Resultado da busca por <?php echo "Data: " . date('d/m/Y', strtotime($data)); ?></h6>
							<?php } ?>
							<?php if (empty($cliente) && empty($data) && !empty($status)) { ?>
								<h6>Resultado da busca por <?php echo "Status: " . $status; ?></h6>
							<?php } ?>
							<?php if (!empty($cliente) && !empty($data) && empty($status)) { ?>
								<h6>Resultado da busca por <?php echo "Cliente: " . $cliente . " e Data: " . date('d/m/Y', strtotime($data)); ?></h6>
							<?php } ?>
							<?php if (!empty($cliente) && empty($data) && !empty($status)) { ?>
								<h6>Resultado da busca por <?php echo "Cliente: " . $cliente . " e Status: " . $status; ?></h6>
							<?php } ?>
							<?php if (empty($cliente) && !empty($data) && !empty($status)) { ?>
								<h6>Resultado da busca por <?php echo "Data: " . date('d/m/Y', strtotime($data)) . " e Status: " . $status; ?></h6>
							<?php } ?>
							<?php if (!empty($cliente) && !empty($data) && !empty($status)) { ?>
								<h6>Resultado da busca por <?php echo "Cliente: " . $cliente . ", Data: " . date('d/m/Y', strtotime($data)) . " e Status: " . $status; ?></h6>
							<?php } ?>
						</div>
					</div>

					<br>

					<?php
					include "../../model/bancoAtivacao.php";
					$banco = new BancoAtivacao();
					$banco->setPaginacao();					
					$array = $banco->pesquisaClienteAtivacao($cliente, $data, $status);

					foreach ($array as $linha) {
					?>
						<div class="bloco-tabela">
							<div class="table-responsive">
								<table class="table ">
									<thead>
										<tr>
											<th style="width: 15%" scope="col">
												<label class="label6">
													Nº <?php echo $linha['Id'] ?>
												</label>
											</th>
											<th style="width: 15%" scope="col">
												<label class="label6">
													<?php echo date('d/m/Y', strtotime($linha['Datacriacao'])); ?>
												</label>
											</th>																						
											<th style="width: 30%" align="right" scope="col">
												<div class="float-left">
													<label class="label8">Status</label>
													<hr class="hbr">
													<label class="label6">
														<b><?php echo $linha['StatusDescricao']?> - <?php 
																		if ($linha['Dataatualizacao'] !="") {echo date('d/m/Y', strtotime($linha['Dataatualizacao']));}
																		else {echo date('d/m/Y', strtotime($linha['Datacriacao']));} 
																		?></b>
													</label>
												</div>
											</th>
											<th style="width: 40%" scope="col">
												<label class="label8">E-mail</label>
													<hr class="hbr">
													<label class="label6">
														<?php echo $linha['StatusEmailDescricao']; ?>
													</label>
											</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td colspan="2">
												<label class="label10">Cliente:</label>												
												<label class="label11">
													<?php if ($linha['Nomefantasia'] != '') { echo $linha['Nomefantasia']; } else {echo $linha['Razaosocial'];} ?>
												</label>
											</td>
											<td colspan="2">
												<label class="label10">Vendedor:</label>
												
												<label class="label11">
													<?php echo utf8_encode($linha['Vendedor']) ?>
												</label>
											</td>											
																																											
										</tr>
										<tr>
										
											<td colspan="2">
												<label class="label10">Produto:</label>												
												<label class="label11">
													<?php echo $linha['produto']; ?>
												</label>
											</td>
											<td colspan="5">
												<label class="label10">Chave:</label>												
												<label class="label11">
													<?php echo $linha['Chave']; ?>
												</label>
											</td>
										

											<td class="float-right">

												<a class="aButton" href="./cadastroAtivacoes-edit.php?atv=<?php echo base64_encode($linha['Id'])?>&cli=<?php echo base64_encode($linha['IdCliente'])?>">
													<button class="btGridBranco" type="button" value="Editar" data-toggle="tooltip" data-placement="top" title="Editar">
														<img src="../../public/svgs/edit-azul-opaco.png" width="24px">
														<img class="imgHover" src="../../public/svgs/edit-azul.png" width="24px">
													</button>
												</a>
												<a class="aButton" onclick="reenviaEmail(<?php echo $linha['Id'] ?>);">
													<button class="btGridBranco" type="button" value="enviarEmail" data-toggle="tooltip" data-placement="top" title="Reenviar E-mail">														
														<img src="../../public/svgs/email-azul-opaco.png" width="24px">
														<img class="imgHover" src="../../public/svgs/email-azul.png" width="24px">
													</button>
												</a>
												<a class="aButton" onclick="cancelarAtivacao(<?php echo $linha['Id'] ?>);">
													<button class="btGridBranco" type="button" value="excluir" data-toggle="tooltip" data-placement="top" title="Cancelar">
														<img src="../../public/svgs/trash-azul-opaco.png" width="24px">
														<img class="imgHover" src="../../public/svgs/trash-azul.png" width="24px">
													</button>
												</a>											
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<br>
					<?php } ?>
				</section>
				<br>
				<br>

				<?php echo $banco->getPaginationLinks($banco->page, $banco->pages, '') ?>

				</section>
			</div>
		</div>
	</div>
	<?php include("../../footer.php");
	?>
	<script>
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
	</script>
	<script>
		$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
	<script>
		function excluirEntrega(seq) {
			var r = confirm("Deseja excluir este registro?");
			if (r == true) {
				document.location = '../../controller/deleteEntrega.php?id=' + seq;
			}

		}
	</script>

	<script>
		function cancelarAtivacao(seq) {
			var r = confirm("Deseja cancelar esta solicitação de ativação?");
			if (r == true) {
				document.location = '../../controller/cancelaAtivacao.php?id=' + seq;
			}

		}
	</script>

	<script>
		function reenviaEmail(seq) {
			var r = confirm("Deseja reenviar o e-mail de solicitação de ativação?");
			if (r == true) {
				document.location = '../../controller/reenviaEmail.php?id=' + seq;
			}

		}
	</script>	

	<script type="text/javascript">
		$('.dropdown-toggle').dropdown()
	</script>
</body>

</html>