<?php
session_start();
?>
<!doctype html>

<html lang="pt" xmlns="http://www.w3.org/1999/html">

<?php 
	include("headAtivacoesCad.php"); 
	$idativacao = base64_decode($_GET['atv']);
	$idcliente  = base64_decode($_GET['cli']);
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
					Editar Ativação de Produto
				</h3>
				<div class="bloco">
					<h6>Escolha o Produto</h6>
					<form method="post" action="../../controller/ControllerCadastroAtivacaoEdit.php">
					<?php	
						include "../../model/bancoAtivacao.php";
						$banco = new BancoAtivacao();									
						$produtos = $banco->getAtivacaoProduto($idativacao);											
						foreach ($produtos as $produto) {
					?>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">
							<label class="label2">Produto</label>
							<select name="produto" id="produto" class="form-control form-control-lg" required="required">
							<option value="<?php echo $produto['Idproduto'];?>"><?php echo $produto['produto'];?></option>								
								<?php
										include "../../model/bancoProdutoMi.php";
										$bancoP = new BancoProdutoMi();
										$array = $bancoP->getProduto();												
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
							<select name="condicao" id="condicao" class="form-control form-control-lg" required="required">	
							<option value="<?php echo $produto['Idmodalidade'];?>"><?php echo utf8_encode($produto['modalidade']);?></option>
								<?php
										include "../../model/bancoProdModalidade.php";
										$bancoM = new BancoProdModalidade();
										$array = $bancoM->getModalidade();												
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
							<input class="form-control" type="text" id="chave" name="chave" required="required" value="<?php echo $produto['Chave'] ?>"/>
						</div>
					</div>
					<?php } ?>						
				</div>

				<br>			

				<?php					
					$array = $banco->getAtivacao($idativacao);
					foreach ($array as $linha) {
				?>


						<div class="bloco">

							<input value="<?php echo $linha['Idativacao'] ?>" class="form-control" type="hidden" placeholder="" id="idativacao" name="idativacao">							
							<input value="<?php echo $linha['IdUsuario'] ?>" class="form-control" type="hidden" placeholder="" id="idusuario" name="idusuario">


							<h5>Dados do Cliente</h5>	
							<br>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
									<input name="buscaCliente" class="form-control" type="text" id="buscaCliente" placeholder="Digite o nome do cliente" autocomplete="off" value="<?php echo $linha['Razaosocial']?>"/>
									<label>Digite o nome do cliente</label>
								</div>
							</div>
							<!-- Código do Cliente -->
							<input class="form-control" type="hidden" id="idcliente" name="idcliente" value="<?php echo $linha['Idcliente']; ?>" />
							<!-- Fim -->
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
									<input value="<?php echo $linha['Nomefantasia'] ?>" class="form-control" type="text" placeholder="Nome Fantasia" id="fantasia" name="fantasia" readonly />
									<label>Nome Fantasia</label>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
									<input value="<?php echo $linha['Razaosocial'] ?>" class="form-control" type="text" placeholder="Razão Social" id="razao" name="razao" readonly />
									<label>Razão Social</label>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
									<input value="<?php echo $linha['Cnpjcpf'] ?>" class="form-control" type="text" placeholder="CNPJ/CPF" id="documento" name="documento" readonly />
									<label>CNPJ/CPF</label>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
									<input value="<?php echo $linha['Inscestadual'] ?>" class="form-control" type="text" placeholder="Insc. Estadual" id="ie" name="ie" readonly />
									<label>Inscrição Estadual</label>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
									<input value="<?php echo $linha['Email'] ?>" class="form-control" type="email" placeholder="E-mail" name="email" id="email" readonly />
									<label>E-mail</label>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
									<input value="<?php echo $linha['Telefone'] ?>" class="form-control" type="text" placeholder="Telefone" id="telefone" name="telefone" readonly />
									<label>Telefone</label>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
									<input value="<?php echo $linha['Celular'] ?>" class="form-control" type="text" placeholder="Celular" id="celular" name="celular" readonly />
									<label>Celular</label>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
									<input value="<?php echo $linha['Endereco'] ?>" class="form-control" type="text" placeholder="Endereço" id="endereco" name="endereco" readonly />
									<label>Endereço</label>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
									<input value="<?php echo $linha['Cep'] ?>" class="form-control" type="text" placeholder="CEP" id="cep" name="cep" readonly />
									<label>CEP</label>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
									<input value="<?php echo $linha['Bairro'] ?>" class="form-control" type="text" placeholder="Bairro" id="bairro" name="bairro" readonly />
									<label>Bairro</label>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
									<input value="<?php echo $linha['Complemento'] ?>" class="form-control" type="text" placeholder="Complemento" id="complemento" name="complemento" readonly />
									<label>Complemento</label>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
									<input value="<?php echo $linha['Pais'] ?>" class="form-control" type="text" placeholder="País" id="pais" name="pais" readonly />
									<label>País</label>
								</div>
							</div>

							<!-- País -->
							<input class="form-control" type="hidden" id="idpais" name="idpais" value="<?php echo $linha['IdPais']; ?>" />
							<!-- Fim -->

							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
									<input value="<?php echo $linha['Estado'] ?>" class="form-control" type="text" placeholder="Estado" id="estado" name="estado" readonly />
									<label>Estado</label>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 form-group">
									<input value="<?php echo $linha['Cidade'] ?>" class="form-control" type="text" placeholder="Cidade" id="cidade" name="cidade" readonly />
									<label>Cidade</label>
								</div>
							</div>

							<!-- Estado -->
							<input class="form-control" type="hidden" id="idestado" name="idestado" value="<?php echo $linha['IdEstado']; ?>" />
							<!-- Fim -->

						</div>

						<br> <br>
						
					</form>
				<?php } ?>
			</div>
		</div>
	</div>
	<br> <br>
	<?php include("../../footer.php"); 
	?>

	<script>
		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});
	</script>

	<script>
		function excluirEntregaItem(seq, ent) {
			var r = confirm("Deseja excluir este registro?");
			if (r == true) {
				document.location = '../../controller/deleteEntregaItem.php?id=' + seq + '&ent=' + ent;
			}

		}
	</script>

	<script type="text/javascript">
		$(function() {
			$.ajaxSetup({
				cache: false
			});

			$("a[data-modal]").on("click", function(e) {
				var dest = this.href + '?produtoid=' + $('#produtoid2').val() + '&condicao=' + $('#condicao').val() + '&entregaid=<?php echo $_GET['id'] ?>';
				$('#myModalContent').load(dest, function() {
					$('#myModal').modal({
						/*backdrop: 'static',*/
						keyboard: true
					}, 'show');
					bindForm(this);
				});
				return false;
			});
		});

		function bindForm(dialog) {
			$('form', dialog).submit(function() {
				$.ajax({
					url: this.action,
					type: this.method,
					data: $(this).serialize(),
					success: function(result) {
						if (result.success) {
							$('#myModal').modal('hide');
							$('#replacetarget').load(result.url);
						} else {
							$('#myModalContent').html(result);
							bindForm(dialog);
						}
					}
				});
				return false;
			});
		}
	</script>

	<script>
		$(document).ready(function() {
			$("#produto").autocomplete({
				source: "getProdutos.php",
				minLength: 1,
				select: function(event, ui) {
					$("#produto").val(ui.item.value);
					$("#produtoid2").val(ui.item.codigo);
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
		$(document).ready(function() {
			$("#buscaCliente").autocomplete({
				source: "getClientes.php",
				minLength: 1,
				select: function(event, ui) {
					$("#idcliente").val(ui.item.codigo);
					$("#fantasia").val(ui.item.nome);
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
				return $("<li class='ui-autocomplete-row'></li>")
					.data("item.autocomplete", item)
					.append(item.label)
					.appendTo(ul);
			};
		});
	</script>
	<!-- <script>
		$(document).ready(function(){
			if($('#produto').val() != ''){								
				$('#btnAddItem').show()				
			}
			else {
				$('#btnAddItem').hide()
			}
		});
	</script>	
	<script>
		$(document).ready(function(){
			$('#produto').on('input', function(){
				$('#btnAddItem').show($(this).val().length < 4);
			});
		});
	</script> -->
	<!-- <script>		
		function valida_form(){
			if(document.getElementById("produto").value == ""){
				alert('Por favor, informe o produto!');
				document.getElementById("produto").focus();
				return false
			}
		}
	</script> -->
	
	<!-- <script>
		function checkForm() {
		// Fetching values from all input fields and storing them in variables.
		var cliente = document.getElementById("buscaCliente").value;		
		//Check input Fields Should not be blanks.
		if (cliente == '') {
			alert("Por favor informe o cliente!");
		} 
		else {
			document.getElementById("fmEntrega").submit();	
		}
	}
	</script> -->

</body>

</html>