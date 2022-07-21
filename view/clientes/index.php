<?php
  session_start();
?>
<!doctype html>

<html lang="pt-br" xmlns="http://www.w3.org/1999/html">

<?php include("headcliente.php"); 
	$fantasia = $_GET['fantasia'];
	$estado   = $_GET['estado'];
?>

<body class="view-clientes">
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
							<img src="../../public/svgs/followers.png" class="icone56">
						</div>
						<div class="col-xs-11 col-sm-11 col-md-7 col-lg-8">
							<h3>Cadastrar Novo Cliente</h3>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
							<div class="float-right">
								<form method="get" action="./cadastroClientes.php">
									<button class="botaoSecundario200">
										Novo Cliente
										<div class="circuloSecundario200">
											<a href="distribuidor-clientes-edit.php"><img src="../../public/svgs/followers-branco.png" width="15px"></a>
										</div>
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
				<section id="user-form" class="">
					<h3 class="cinza">
						Todos os Clientes
					</h3>
					<form method="get">
						<div class="bloco">							
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
									<label class="label2">Nome do Cliente</label>
									<input class="form-control busca" type="search" placeholder="" name="fantasia" id="fantasia">
								</div>
								<!--<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<label class="label2">Estado</label>
									<input class="form-control" type="text" placeholder="" name="estado" id="estado">
								</div>-->
								
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<label class="label2">Estado</label>
									<select name="estado" id="estado" class="form-control" placeholder="Estado">
										<option value="">Selecionar</option>
										<?php
												include "../../model/bancoEstado.php";
												$banco = new BancoEstado();
												$array = $banco->getEstado();												
												foreach ($array as $linhaP) {	
										?>
												<option value="<?php echo utf8_encode($linhaP['Nome']);?>"><?php echo utf8_encode($linhaP['Nome']);?></option>	
										<?php												
												}								
										?>
									</select>									
								</div>

								<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
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
							<?php if (!empty($fantasia) && empty($estado)) { ?>
								<h6>Resultado da busca por <?php echo "Cliente: ".$fantasia; ?></h6>
							<?php }?>
							<?php if (empty($fantasia) && empty(!$estado)) { ?>
								<h6>Resultado da busca por <?php echo "Estado: ".$estado; ?></h6>
							<?php }?>
							<?php if (!empty($fantasia) && !empty($estado)) { ?>
								<h6>Resultado da busca por <?php echo "Cliente: ".$fantasia." e Estado: ".$estado; ?></h6>
							<?php }?>	
						</div>	
					</div>
					<br>
					
						<?php
						include "../../model/bancoCliente.php";
						$banco = new BancoCliente();
						$banco->setPaginacao();
						$array = $banco->pesquisaCliente($fantasia,$estado);

						foreach ($array as $linha) {
							?>
							<div class="bloco-tabela">
								<div class="table-responsive">
									<table class="table" id="meusclientes">
										<thead>
											<tr>
												<th style="width: 40%" scope="col"><label class="label6">
														<?php echo $linha['Nomefantasia']?>
													</label></th>
												<th style="width: 30%" scope="col"></th>
												<th style="width: 30%" scope="col"></th>
											</tr>
										</thead>
										<tbody>										
											<tr>																
												<td colspan="2">
													<label class="label10">Localização:</label>
													<hr class="hbr">
													<label class="label11">
														<?php echo $linha['Endereco'] ?>
														<hr class="hbr2">
														<?php echo $linha['Bairro'] . '-' . $linha['Cidade'] . '/' . $linha['Sigla'] ?>
														<hr class="hbr2">
														<?php echo 'CEP: ' . $linha['Cep'] ?>
													</label>
												</td>
											
												<td colspan="2">
													<label class="label10">Contato:</label>
													<hr class="hbr">
													<label class="label11">
														<?php echo $linha['Telefone'] ?>
														<hr class="hbr2">
														<?php echo $linha['Celular'] ?>
														<hr class="hbr2">
														<?php echo $linha['Email'] ?>														
													</label>
												</td>											

												<td colspan="2">
													<label class="label10">Vendedor:</label>
													<hr class="hbr">
													<label class="label11">
														<?php echo utf8_encode($linha['Vendedor']) ?>
														<hr class="hbr2">														
													</label>
												</td>
											
												<td class="float-right">
													<a class="aButton" href="./cadastroClientes-edit.php?id=<?php echo $linha['Id'] ?>">
														<button class="btGridBranco" type="button" value="visualizar" data-toggle="tooltip" data-placement="top" title="Editar">
															<img src="../../public/svgs/edit-azul-opaco.png" width="24px">
															<img class="imgHover" src="../../public/svgs/edit-azul.png" width="24px">
														</button>
													</a>
													<a class="aButton" onclick="excluirCliente(<?php echo $linha['Id'] ?>);">
														<button class="btGridBranco" type="button" value="excluir" data-toggle="tooltip" data-placement="top" title="Excluir">
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

					<?php echo $banco->getPaginationLinks($banco->page, $banco->pages, '') ?>				
				</section>					
			</div>
		</div>
    </div>

    <?php include("../../footer.php"); ?>	

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
	<script>
		$("#menu-toggle").click(function(e) {
		  e.preventDefault();
		  $("#wrapper").toggleClass("toggled");
		});
	 </script>
    <script>
        async function fetchAsync(url) {
            let response = await fetch(url);
            let data = await response.json();
            return data;
        }

        function excluirCliente(seq) {
            //fetchAsync('./controller/deleteCliente.php?id=' + seq);
            //fetchAsync('http://localhost/inmes/view/cadastroClientes.php');
            var r = confirm("Deseja excluir este registro?");
            if (r == true) {
                document.location = '../../controller/deleteCliente.php?id=' + seq;
            }

        }
    </script>
</body>

</html>