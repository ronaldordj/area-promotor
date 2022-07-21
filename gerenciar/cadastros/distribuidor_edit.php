<?php
	include '../config/conecta.php';
	$id = $_GET['id'];
	//Executa consulta
	$sql="SELECT d.*, i.Descricao as Idioma, p.Nome as Pais, e.Id as Idestado, e.Nome as Estado
				FROM cd_distribuidor d
				JOIN cf_idioma i ON (i.Id = d.Ididioma)
				JOIN cd_pais p ON (p.Id = d.Idpais)
				JOIN cd_estado e ON (e.Sigla = d.UF)
			WHERE d.Id = $id";
	$sql_result=mysqli_query($conexao,$sql)or die("Erro:".mysqli_error($conexao)); 		 	 		 		
	$resultado=mysqli_fetch_array($sql_result);
	$estado = $resultado['Idestado'];
	$pais   = $resultado['Idpais'];
	$idioma = $resultado['Ididioma']
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
      <div class="card-header">Cadastro de Distribuidor - Id nº. <?php echo $id ?></div>	
      <div class="card-body">
        <form action="../processa/proc_edit_distribuidor.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <div class="form-row">
			  <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
              <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="form-label-group">
                  <input name="nome" type="text" id="nome" class="form-control" placeholder="Distribuidor" required="required" value="<?php echo $resultado['Distribuidor'];?>" maxlength="60" />
                  <label for="nome">Distribuidor</label>
                </div>
              </div>			  
            </div>
          </div> 		  
          <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="email" type="email" id="email" class="form-control" placeholder="E-mail" required="required" value="<?php echo $resultado['Email'];?>" maxlength="50" />
                  <label for="email">E-mail</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="site" type="url" id="site" class="form-control" placeholder="Site" value="<?php echo $resultado['Site'];?>" maxlength="60" />
                  <label for="site">Site</label>
                </div>
              </div>
            </div>
          </div>
		  <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="telefone" type="text" id="telefone" class="form-control" placeholder="Telefone" required="required" value="<?php echo $resultado['Telefone'];?>" maxlength="14" />
                  <label for="telefone">Telefone</label>
                </div>
              </div>
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="celular" type="text" id="celular" class="form-control" placeholder="Celular" value="<?php echo $resultado['Celular'];?>" maxlength="15" />
                  <label for="celular">Celular</label>
                </div>
              </div>
            </div>
          </div>
		  <div class="form-group">
            <div class="form-row">
				<div class="col-xs-12 col-md-6 col-lg-6">
					<div class="form-label-group">
					  <input name="endereco" type="text" id="endereco" class="form-control" placeholder="Endereço" required="required" value="<?php echo $resultado['Endereco'];?>" maxlength="60" />
					  <label for="endereco">Endereço</label>
					</div>
				</div>
				
				<div class="col-xs-12 col-md-2 col-lg-2">
					<div class="form-label-group">
					  <input name="numero" type="text" id="numero" class="form-control" placeholder="Número" required="required" value="<?php echo $resultado['Numero'];?>" maxlength="6" />
					  <label for="numero">Número</label>
					</div>
				</div>
				
				<div class="col-xs-12 col-md-4 col-lg-4">
				  <div class="form-label-group">
					  <input name="bairro" type="text" id="bairro" class="form-control" placeholder="Bairro" required="required" value="<?php echo $resultado['Bairro'];?>" maxlength="30" />
					  <label for="bairro">Bairro</label>
				  </div>
				</div>
			</div>
		  </div> 
		  <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-12 col-lg-12">
                <div class="form-label-group">
                  <input name="complemento" type="text" id="complemento" class="form-control" placeholder="Complemento" value="<?php echo $resultado['Complemento'];?>" maxlength="60" />
                  <label for="complemento">Complemento</label>
                </div>
              </div>
			</div>  		
		  </div>
		  <div class="form-group">
            <div class="form-row">
              <div class="col-xs-12 col-md-6 col-lg-6">
                <div class="form-label-group">
                  <input name="cidade" type="text" id="cidade" class="form-control" placeholder="Cidade" required="required" value="<?php echo utf8_encode($resultado['Cidade']);?>" maxlength="60" />
                  <label for="cidade">Cidade</label>
                </div>
              </div>			
            <div class="col-xs-12 col-md-6 col-lg-6">
              <div class="form-label-group">
                  <input name="cep" type="text" id="cep" class="form-control" placeholder="CEP" required="required" value="<?php echo $resultado['CEP'];?>" maxlength="8" />
                  <label for="cep">CEP</label>
              </div>
            </div>
			</div>
		  </div>
		  <div class="form-group">
			<div class="form-row">
				<div class="col-xs-12 col-md6 col-lg-6">
					<div class="form-label-group">
						<select name="estado" id="estado" class="form-control" required="required">
							<option value="<?php echo $resultado['UF'];?>"><?php echo utf8_encode($resultado['Estado']);?></option>
							<?php
									$sqlE="select id,nome,sigla from cd_estado where ativo = 1 and id <> $estado order by nome";
									$sql_resultE=mysqli_query($conexao,$sqlE)or die("Erro:".mysqli_error($conexao));
									while($rowE=mysqli_fetch_array($sql_resultE)){
							?>
									<option value="<?php echo $rowE[2];?>"><?php echo utf8_encode($rowE[1]);?></option>	
							<?php		
									}								
							?>
						</select>						
					</div>
				</div>
				<div class="col-xs-12 col-md6 col-lg-6">
					<div class="form-label-group">
						<select name="pais" id="pais" class="form-control" required="required">
							<option value="<?php echo $resultado['Idpais'];?>"><?php echo utf8_encode($resultado['Pais']);?></option>
							<?php
							$sqlP="select id,nome from cd_pais where ativo = 1 and id <> $pais order by nome";
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
					<div class="col-xs-12 col-md6 col-lg-6">
						<div class="form-label-group">
							<select name="idioma" id="idioma" class="form-control" required="required">
								<option value="<?php echo $resultado['Ididioma'];?>"><?php echo utf8_encode($resultado['Idioma']);?></option>
								<?php
										$sqlI="SELECT Id, Descricao FROM cf_idioma where Id <> $idioma ORDER BY Id";
										$sql_resultI=mysqli_query($conexao,$sqlI)or die("Erro:".mysqli_error($conexao));
										while($rowI=mysqli_fetch_array($sql_resultI)){
								?>
										<option value="<?php echo $rowI[0];?>"><?php echo utf8_encode($rowI[1]);?></option>
								<?php		
										}								
								?>
							</select>						
						</div>
					</div>
					<div class="col-xs-12 col-md6 col-lg-6">
						<div class="form-label-group">
							<input name="arquivo" type="file" id="arquivo" class="form-control" placeholder="Logomarca Distribuidor"><?php if($resultado['imglogo'] != '') {
								echo 'Possui logomarca cadastrada.'; } else {echo 'Não possui logomarca cadastrada.';} ?></input>
							<label for="arquivo">Logomarca</label>
						</div>
					</div>
				</div>
			</div>			
		  <div class="form-group">
				<div class="form-row">
				  <div class="col-xs-2 col-md-2 col-lg-2">
					<div class="form-check">					  
					  <input name="ativo" class="form-check-input" type="radio" id="ativo" value="1" <?php if ($resultado['Ativo'] == 1) {echo 'checked';} ?>>
					  <label class="form-check-label" for="ativo">
						Ativo
					  </label>
					</div>
				  </div>
				  <div class="col-xs-2 col-md-2 col-lg-2">
					<div class="form-check">					  
					  <input name="ativo" class="form-check-input" type="radio" id="ativo" value="0" <?php if ($resultado['Ativo'] == 0) {echo 'checked';} ?>>
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

</body>

</html>
