
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        include_once '../include_padrao.php'
    ?>
    <style>
        .botoes{
            margin-top: 5%;
        }
    </style>
    <title>Cadastrar Cliente</title>
</head>
<body>
    <div class="dsp-flex justify-content-center">
        <form action="register_script.php" class="col-md-12" id="Registrar" method="post">
            <div class="container shadow pb-2">
            <div class="col-md-12 container dsp-flex justify-content-between position-relative progress-box bg-dark rounded mt-2">
                <div class="col-md-12 title-person-2" align="center">
                    CADASTRAR CLIENTE
                </div>
            </div>
			<!-- CNPJ -->
			<div class="col-md-8 container dsp-flex flex-column justify-content-center">
				<label for="CNPJ_CPF" class="form-label">CNPJ/CPF</label>
				<input type="text" class="form-control" name="CNPJ_CPF" id="CNPJ_CPF">
			</div>
			<br>
            <!-- RG-->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="RG_IE" class="form-label">RG/IE</label>
                <input type="text" class="form-control" name="RG_IE" id="RG_IE">
            </div>
			<br>
            <!-- TIPO PESSOA -->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
            	<label class="form-label">Selecione seu tipo pessoa</label>
            		<div class="form-check">
						<label class="form-check-label" for="Tipo_pessoa1">
							Juridica 
						</label>
  						<input class="form-check-input" type="radio" value="J" name="Tipo_pessoa" id="Tipo_pessoa1">
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" checked="checked" value="F" name="Tipo_pessoa" id="Tipo_pessoa2" >
						<label class="form-check-label" for="Tipo_pessoa2">
							Fisica
						</label>
					</div>
				</label>
			</div>
			<br>
<!-- SEXOOOOOOOOOOOOOOOOOOOO -->
			<div class="col-md-8 container dsp-flex flex-column justify-content-center">
				<label class="form-label">Sexo</label>
					<div class="form-check">
						<input class="form-check-input" checked="checked" value="M" type="radio" name="Sexo" id="Sexo1">
						<label class="form-check-label" for="Sexo1">
							Masculino
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="F" name="Sexo" id="Sexo2" >
						<label class="form-check-label" for="Sexo2">
							Feminino
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="MNTC" name="Sexo" id="Sexo3">
						<label class="form-check-label" for="Sexo3">
							MNETC
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="I" name="Sexo" id="Sexo3">
						<label class="form-check-label" for="Sexo3">
							Indefinido
						</label>
					</div>
				</div>
				<br>
				<!-- DATA -->
				<div class="col-md-8 container dsp-flex flex-column justify-content-center">
					<label for="Data_nascimento" class="form-label">Data</label>
					<input type="date" class="form-control" name="Data_nascimento" id="Data_nascimento" placeholder="DD/MM/AAAA">
				</div>
				<br>
				<div class="botoes dsp-flex justify-content-end col-md-11">
					<a id="cadastrar" class="btn btn-large btn-dark" align="right"><i class="fa-sharp fa-solid fa-plus fa-fade"></i> Cadastrar</a>
				</div>
            </div> 
        </form>
    </div>
</body>
</html>
