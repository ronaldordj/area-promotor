<?php
  session_start();
?>
<!doctype html>

<html lang="pt" xmlns="http://www.w3.org/1999/html">

<?php 
	include("headAtivacoesCad.php");
	include("../../model/init.php");

	$db = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);

	$idativacao = base64_decode($_GET['atv']);
	$idcliente  = base64_decode($_GET['cli']);

	$query = "SELECT cd_cliente.Id, Nomefantasia, Razaosocial, Cnpjcpf, Inscestadual, cd_cliente.Email, Emailvalida, cd_cliente.Telefone, Celular, 
                 Endereco, Cep, Bairro, Complemento, Cidade, Idestado, cd_estado.Sigla, coalesce(cd_estado.Nome, '') as 'Estado', cd_cliente.Idpais, cd_pais.Nome as Pais 
		  FROM cd_cliente
		  LEFT OUTER join cd_estado on (cd_cliente.Idestado = cd_estado.Id)
		  LEFT OUTER join cd_pais on (cd_cliente.Idpais = cd_pais.Id)
		  LEFT OUTER join cd_usuario on (cd_cliente.Iddistribuidor = cd_usuario.Id)
		  WHERE cd_cliente.Id = $idcliente
		  AND coalesce(cd_usuario.mascara, '') like '$mascara%' ";
	$result = $db->query($query);
	while($row = $result->fetch_assoc()){		
        $codigo      = $row['Id'];
		$nome        = $row['Nomefantasia'];
        $razao       = $row['Razaosocial']; 
		$documento   = $row['Cnpjcpf'];		
		$email       = $row['Email'];
		$telefone    = $row['Telefone'];
		$celular     = $row['Celular'];
		$endereco    = $row['Endereco'];
		$cep         = $row['Cep'];
		$bairro      = $row['Bairro'];
		$complemento = $row['Complemento'];
		$cidade      = $row['Cidade'];
		$estado      = utf8_encode($row['Estado']);
		$pais        = $row['Pais'];
		$codestado   = $row['Idestado'];
		$codpais     = $row['Idpais'];        
	}

?>

<body>
	<?php include("../../header.php");?>
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
								<a class="nav-link aLista active" href="index.php">
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
							<img src="../../public/svgs/key.png" class="icone56"></img>
						</div>
						<div class="col-xs-11 col-sm-11 col-md-8 col-lg-9">
							<h3>Ver todas as Ativações de Produtos</h3>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-3 col-lg-2">
							<div class="float-right">
								<form method="get" action="./index.php">
									<button class="botaoSecundario" type="submit" value="submit">
										Ver Todas
										<div class="circuloSecundario">
											<img src="../../public/svgs/key-branco.png" width="15px"></img>
										</div>
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>

				<br><br>


				<h3 class="cinza">
					Nova Ativação de Produto
				</h3>
				<div class="bloco">
					<h6>Escolha o Produto</h6>
					<form action="../../controller/ControllerCadastroAtivacaoProduto.php" method="post" id="fmAtivacao" name="fmAtivacao" class="box">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">
								<label class="label2">Produto</label>
								<select name="produto" id="produto" class="form-control form-control-lg" required="required">
								<option></option>								
									<?php
											include "../../model/bancoProdutoMi.php";
											$banco = new BancoProdutoMi();
											$array = $banco->getProduto();												
											foreach ($array as $linha) {	
									?>
											<option value="<?php echo $linha['Id'];?>"><?php echo utf8_encode($linha['Descricao']);?></option>	
									<?php		
											}								
									?>
								</select>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
								<label class="label2">Modalidade</label>
								<select name="modalidade" id="modalidade" class="form-control form-control-lg" required="required">	
								<option></option>															
									<?php
											include "../../model/bancoProdModalidade.php";
											$banco = new BancoProdModalidade();
											$array = $banco->getModalidade();												
											foreach ($array as $linha) {	
									?>
											<option value="<?php echo $linha['Id'];?>"><?php echo utf8_encode($linha['Descricao']);?></option>	
									<?php		
											}								
									?>
								</select>
							</div>					
							
							<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
								<br>
								<div class="float-right">
									<button class="botaoPadrao" type="submit" value="btnAddItem" id="btnAddItem" name="btnAddItem" >
										Adicionar
										<div class="circuloPadrao">
											<img src="../../public/svgs/add_laranjado.png" width="15px"></img>
										</div>
									</button>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<label class="label2">Número da Chave</label>
								<input class="form-control" type="text" id="chave" name="chave" required="required"/>
							</div>
						</div>

						<input class="form-control" type="hidden" id="idativacao" name="idativacao" value = "<?php echo $idativacao;?>" />
						<input class="form-control" type="hidden" id="idcliente" name="idcliente" value = "<?php echo $idcliente;?>" />

						</form>
					</div>

				<br>

				<!-- <form action="../../controller/..." method="post" enctype='application/json' id="fmAtivacao" name="fmAtivacao" class="box">				 -->

					<br>

					<div class="bloco">

						<h5>Dados do Cliente</h5>
						<br>		

						<input class="form-control" value="<?php echo $_SESSION['usuarioId']; ?>" type="hidden" placeholder="" id="idusuario" name="idusuario">						
						
						<input class="form-control" type="hidden" id="idcliente" name="idcliente" value = "<?php echo $codigo;?>" />

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
								<input class="form-control" type="text" id="nome" name="nome" value = "<?php echo $nome;?>" readonly />
								<label>Nome Fantasia</label>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
								<input class="form-control" type="text" id="razao" name="razao" value = "<?php echo $razao;?>" readonly />
								<label>Razão Social</label>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control" type="text" id="documento" name="documento" value = "<?php echo $documento;?>" readonly />
								<label>CNPJ/CPF</label>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control" type="email" id="email" name="email" value = "<?php echo $email;?>" readonly />
								<label>E-mail</label>
							</div>
						</div>						

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control" type="text" id="telefone" name="telefone" value = "<?php echo $telefone;?>" readonly />
								<label>Telefone</label>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control" type="text" id="celular" name="celular" value = "<?php echo $celular;?>" readonly />
								<label>Celular</label>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
								<input class="form-control" type="text" id="endereco" name="endereco" value = "<?php echo $endereco;?>" readonly />
								<label>Endereço</label>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control" type="text" id="cep" name="cep" value = "<?php echo $cep;?>" readonly />
								<label>CEP</label>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control" type="text" id="bairro" name="bairro" value = "<?php echo $bairro;?>" readonly />
								<label>Bairro</label>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control" type="text" id="complemento" name="complemento" value = "<?php echo $complemento;?>" readonly />
								<label>Complemento</label>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control" type="text" id="cidade" name="cidade" value = "<?php echo $cidade;?>" readonly />
								<label>Cidade</label>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control" type="text" id="estado" name="estado" value = "<?php echo $estado;?>" readonly />
								<label>Estado</label>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
								<input class="form-control" type="text" id="pais" name="pais" value = "<?php echo $pais;?>" readonly />
								<label>País</label>
							</div>
						</div>
						<!-- Estado -->
						<input class="form-control" type="hidden" id="idestado" name="idestado" value = "<?php echo $codestado;?>"/>
						<!-- Fim -->
						<!-- País -->
						<input class="form-control" type="hidden" id="idpais" name="idpais" value = "<?php echo $codpais;?>"/>
						<!-- Fim -->

					</div>

					<br><br>									

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<br>
							<button class="botaoPadrao200 float-right" type="button" value="submit">
								Enviar Solicitação
								<div class="circuloPadrao200">
									<img src="../../public/svgs/add_laranjado.png" width="15px"></img>
								</div>
							</button>							
						</div>
					</div>
				<!-- </form> -->
			</div>
		</div>
	</div>

	
	<!-- <script>
        $(document).ready(function() {
            $("#buscaCliente").autocomplete({
                source: "getClientesCod.php",
                minLength: 1,
                select: function(event, ui) {
                    $("#idcliente").val(ui.item.codigo);
					$("#nome").val(ui.item.nome);
                    $("#razao").val(ui.item.razao);
                    $("#documento").val(ui.item.documento);
					$("#ie").val(ui.item.ie);
					$("#email").val(ui.item.email);
					$("#telefone").val(ui.item.telefone);
					$("#celular").val(ui.item.celular);
					$("#endereco").val(ui.item.endereco);					
					$("#cep").val(ui.item.cep);
					$("#bairro").val(ui.item.bairro);
					$("#complemento").val(ui.item.complemento);
					$("#cidade").val(ui.item.cidade);
					$("#estado").val(ui.item.estado);
					$("#pais").val(ui.item.pais);
					$("#idestado").val(ui.item.codestado);
					$("#idpais").val(ui.item.codpais);
                }
            }).data("ui-autocomplete")._renderItem = function(ul, item) {
                // return $("<li class='ui-autocomplete-row'></li>")
                //     .data("item.autocomplete", item)
                //     .append(item.label)
                //     .appendTo(ul);
            };
        });
    </script> -->
	
	<br> <br>
	<?php include("../../footer.php"); 
	?>
</body>

</html>