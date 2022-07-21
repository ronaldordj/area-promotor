<?php
  session_start();
?>
<!doctype html>

<html lang="pt-br" xmlns="http://www.w3.org/1999/html">

<?php include("headusuario.php"); 
	$usuario = $_GET['usuario'];
	$email   = $_GET['email'];
?>	
<body class="view-usuarios">
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
								<a class="nav-link aLista" href="../ativacoes">
									<img src="../../public/svgs/key-cinza.png" class="icone20"></img>
									<img class="imgHover icone20" src="../../public/svgs/key-branco.png">
									Ativar Produtos
								</a>
							</li>

                            <?php if  ($_SESSION['usuarioMascara'] == '' || strlen($_SESSION['usuarioMascara'])<4) {?>
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
				<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom" id="navbar">
				  <button class="btn btn-primary" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>        
				</nav>	
				<div class="titulo">
					<div class="row">
						<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
							<img src="../../public/svgs/user-azul.png" class="icone56"></img>
						</div>
						<div class="col-xs-11 col-sm-11 col-md-7 col-lg-8">
							<h3>Cadastrar Novo Usuário</h3>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
							<div class="float-right">
								<form method="get" action="./cadastroUsuarios.php">
									<button class="botaoSecundario200" type="submit" value="novo">
										Novo Usuário
										<div class="circuloSecundario200">
											<img src="../../public/svgs/user-branco.png" width="15px"></img>
										</div>
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>                

				<section id="user-form" class="">
					<h3 class="cinza">
						Todos os Usuários
					</h3>
					<form method="get">
						<div class="bloco">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
									<label class="label2">Nome do Usuário</label>
									<input class="form-control busca" type="search" placeholder="" name="usuario" id="usuario">
								</div>
								<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
									<label class="label2">E-mail</label>
									<input class="form-control" type="email" placeholder="" name="email" id="email">
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
							<?php if (!empty($usuario) && empty($email)) { ?>
								<h6>Resultado da busca por <?php echo "Usuário: ".$usuario; ?></h6>
							<?php }?>
							<?php if (empty($usuario) && empty(!$email)) { ?>
								<h6>Resultado da busca por <?php echo "E-mail: ".$email; ?></h6>
							<?php }?>
							<?php if (!empty($usuario) && !empty($email)) { ?>
								<h6>Resultado da busca por <?php echo "Usuário: ".$usuario." e E-mail: ".$email; ?></h6>
							<?php }?>	
						</div>	
					</div>

					<br>
					<?php
					include "../../model/bancoUsuario.php";
					$banco = new BancoUsuario();
					$banco->setPaginacao();
					
					$array = $banco->pesquisaUsuario($usuario,$email);

					foreach ($array as $linha) {
						?>
						<div class="bloco-tabela">
							<div class="table-responsive">
								<table class="table ">
									<thead>
										<tr>
											<th style="width: 40%" scope="col">
												<label class="label6">
													<?php echo utf8_encode($linha['Nome']); ?>
												</label>
											</th>
											<th style="width: 30%" scope="col"></th>
											<th style="width: 30%" scope="col"></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<label class="label10">Email:</label>
												<hr class="hbr">
												<label class="label11">
													<?php echo $linha['Email'] ?>
												</label>
											</td>
											<td>
												<label class="label10">Status:</label>
												<hr class="hbr">
												<label class="label11">
													<?php 
														if ($linha['Ativo'] == 1) {
															echo 'Ativo';
														}
														else {
															echo 'Inativo';
														}
													?>
												</label>
											</td>

											<td class="float-right">
												<a class="aButton" href="./cadastroUsuarios-edit.php?id=<?php echo $linha['Id'] ?>">
													<button class="btGridBranco" type="submit" value="visualizar" data-toggle="tooltip" data-placement="top" title="Editar">
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
        function excluirCliente(seq) {
            var r = confirm("Deseja excluir este registro?");
            if (r == true) {
                document.location = '../../controller/deleteUsuario.php?id=' + seq;
            }
        }
    </script>
</body>

</html>