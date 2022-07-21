<?php
	include '../config/conecta.php';
	
	$id = $_GET['id'];
	//Executa consulta	
	$sql="SELECT c.id, c.nomefantasia, c.razaosocial, c.cnpjcpf, c.inscestadual, c.email, c.emailvalida, c.telefone, c.celular, 
               c.endereco, c.bairro, c.complemento, c.cidade, c.cep, e.id as idestado, e.sigla, e.nome as estado, p.id as idpais, 
               p.nome as pais, d.id as iddistribuidor, d.distribuidor as distribuidor, c.ativo, c.NomeContato
			FROM cd_cliente c
			LEFT OUTER JOIN cd_estado e ON (e.id = c.idestado)
			LEFT OUTER JOIN cd_pais p ON (p.id = c.idpais)
			LEFT OUTER JOIN cd_usuario u ON (u.Id = c.Iddistribuidor)
      LEFT OUTER JOIN cd_distribuidor d ON (u.DistribuidorId = d.Id)
			WHERE c.id = $id";
	$sql_result=mysqli_query($conexao,$sql)or die("Erro:".mysqli_error($conexao)); 		 	 		 		
	$resultado=mysqli_fetch_array($sql_result);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Painel Admin - Área do Distribuidor</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Cadastro de Cliente - Id nº. <?php echo $id;?></div>
      <div class="card-body">
        <form action="../processa/proc_edit_cliente.php" method="post">
          <div class="form-group">
            <div class="form-row">
			  <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="fantasia" type="text" id="fantasia" class="form-control" placeholder="Nome Fantasia" required="required" value="<?php echo $resultado['nomefantasia'];?>" maxlength="60" />
                  <label for="fantasia">Nome Fantasia</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="razao" type="text" id="razao" class="form-control" placeholder="Razão Social" required="required" value="<?php echo $resultado['razaosocial'];?>" maxlength="60" />
                  <label for="razao">Razão Social</label>
                </div>
              </div>
            </div>
          </div> 
		  <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="cnpjcpf" type="text" id="cnpjcpf" class="form-control" placeholder="CNP/CPF" required="required" value="<?php echo $resultado['cnpjcpf'];?>" maxlength="14" />
                  <label for="cnpjcpf">CNPJ/CPF</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="ie" type="text" id="ie" class="form-control" placeholder="Insc. Estadual" required="required" value="<?php echo $resultado['inscestadual'];?>" maxlength="20" />
                  <label for="ie">Inscrição Estadual</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="email" type="email" id="email" class="form-control" placeholder="E-mail" required="required" value="<?php echo $resultado['email'];?>" maxlength="50" />
                  <label for="email">E-mail</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="repitaEmail" type="email" id="repitaEmail" class="form-control" placeholder="Repetir e-mail" required="required" value="<?php echo $resultado['emailvalida'];?>" maxlength="50" />
                  <label for="repitaEmail">Repetir e-mail</label>
                </div>
              </div>
            </div>
          </div>
		  <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="telefone" type="text" id="telefone" class="form-control" placeholder="Telefone" required="required" value="<?php echo $resultado['telefone'];?>" maxlength="10" />
                  <label for="telefone">Telefone</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="celular" type="text" id="celular" class="form-control" placeholder="Celular" required="required" value="<?php echo $resultado['celular'];?>" maxlength="11" />
                  <label for="celular">Celular</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="contato" type="text" id="contato" class="form-control" placeholder="Pessoa Contato" required="required" value="<?php echo $resultado['NomeContato'];?>" maxlength="60" />
                  <label for="contato">Pessoa Contato</label>
                </div>
              </div>
            </div>  
          </div>  
		  <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="endereco" type="text" id="endereco" class="form-control" placeholder="Endereço" required="required" value="<?php echo $resultado['endereco'];?>" maxlength="60" />
                  <label for="endereco">Endereço</label>
                </div>
              </div>			
            <div class="col-xs-12 col-md-6 col-lg-6">
              <div class="form-label-group">
                  <input name="bairro" type="text" id="bairro" class="form-control" placeholder="Bairro" required="required" value="<?php echo $resultado['bairro'];?>" maxlength="30" />
                  <label for="bairro">Bairro</label>
              </div>
            </div>
			</div>
		  </div> 
		  <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="form-label-group">
                  <input name="complemento" type="text" id="complemento" class="form-control" placeholder="Complemento" value="<?php echo $resultado['complemento'];?>" maxlength="60" />
                  <label for="complemento">Complemento</label>
                </div>
              </div>
			</div>  		
		  </div>
		  <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="cidade" type="text" id="cidade" class="form-control" placeholder="Cidade" required="required" value="<?php echo $resultado['cidade'];?>" maxlength="60" />
                  <label for="cidade">Cidade</label>
                </div>
              </div>			
            <div class="col-xs-12 col-md-6 col-lg-6">
              <div class="form-label-group">
                  <input name="cep" type="text" id="cep" class="form-control" placeholder="CEP" required="required" value="<?php echo $resultado['cep'];?>" maxlength="8" />
                  <label for="cep">CEP</label>
              </div>
            </div>
			</div>
		  </div>
		  <div class="form-group">
			<div class="form-row">
				<div class="col-xs-12 col-md-6 col-lg-6">
					<div class="form-label-group">
						<select name="estado" id="estado" class="form-control" required="required">
							<option value="<?php echo $resultado['idestado'];?>"><?php echo utf8_encode($resultado['estado']);?></option>
							<?php
									$sqlE="select id,nome from cd_estado order by nome";
									$sql_resultE=mysqli_query($conexao,$sqlE)or die("Erro:".mysqli_error($conexao));
									while($rowE=mysqli_fetch_array($sql_resultE)){
							?>
									<option value="<?php echo $rowE[0];?>"><?php echo utf8_encode($rowE[1]);?></option>	
							<?php		
									}								
							?>
						</select>						
					</div>
				</div>
				<div class="col-xs-12 col-md-6 col-lg-6">
					<div class="form-label-group">
						<select name="pais" id="pais" class="form-control" required="required">
							<option value="<?php echo $resultado['idpais'];?>"><?php echo $resultado['pais'];?></option>
							<?php
									$sqlP="select id,nome from cd_pais order by nome";
									$sql_resultP=mysqli_query($conexao,$sqlP)or die("Erro:".mysqli_error($conexao));
									while($rowP=mysqli_fetch_array($sql_resultP)){
							?>
									<option value="<?php echo $rowP[0];?>"><?php echo utf8_encode($rowP[1]);?></option>	
							<?php		
									}								
							?>
						</select>						
					</div>
				</div>
			</div>
		  </div>
		  <div class="form-group">
			<div class="form-row">
				<div class="col-xs-12 col-md-12 col-lg-12">
					<div class="form-label-group">
						<select name="distribuidor" id="distribuidor" class="form-control" required="required">
							<option value="<?php echo $resultado['iddistribuidor'];?>"><?php echo utf8_encode($resultado['distribuidor']);?></option>
							<?php
									$sqlD="select id,distribuidor from cd_distribuidor order by distribuidor";
									$sql_resultD=mysqli_query($conexao,$sqlD)or die("Erro:".mysqli_error($conexao));
									while($rowD=mysqli_fetch_array($sql_resultD)){
							?>
									<option value="<?php echo $rowD[0];?>"><?php echo utf8_encode($rowD[1]);?></option>
							<?php		
									}								
							?>
						</select>						
					</div>
				</div>
			  </div>		
			</div>
			<div class="form-group">
				<div class="form-row">
				  <div class="col-xs-2 col-md-2 col-lg-2">
					<div class="form-check">					  
					  <input name="ativo" class="form-check-input" type="radio" id="ativo" value="1" <?php if ($resultado['ativo'] == 1) {echo 'checked';} ?>>
					  <label class="form-check-label" for="ativo">
						Ativo
					  </label>
					</div>
				  </div>
				  <div class="col-xs-2 col-md-2 col-lg-2">
					<div class="form-check">					  
					  <input name="ativo" class="form-check-input" type="radio" id="ativo" value="0" <?php if ($resultado['ativo'] == 0) {echo 'checked';} ?>>
					  <label class="form-check-label" for="ativo">
						Inativo
					  </label>
					</div>
				  </div>
				</div>  		
			</div>	
          <button type="submit" class="btn btn-success btn-block">Salvar</button>
        </form>        
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  
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

</body>

</html>
