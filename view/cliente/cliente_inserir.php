
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
	<script>
        
        jQuery(function($){
            $('#cadastrar').click(function(){
            event.preventDefault(); // Impede o comportamento padrão do botão de enviar

            var form = $('#Cadastrar_cliente')[0];
            if (form.checkValidity()) {
                $.ajax({
                    method : 'POST',
                    url : 'cliente_inserir_script.php',
                    data : $('#Cadastrar_cliente').serialize(),
                    success : function(data){
                        var statusCode = data.STATUS_CODE;
                        var message = data.MESSAGE;
                        if (statusCode == 200){
                            Swal.fire({
                                title: 'Sucesso!',
                                text: message,
                                icon: 'success',
                                confirmButtonText: 'Confirmar'
                            })
                        }else{
                            Swal.fire({
                                title: 'Erro!',
                                text: message,
                                icon: 'error',
                                confirmButtonText: 'Confirmar'
                            })
                        }
                        console.log(statusCode);
                        console.log(message);
                    }
                });
            } else {
            form.classList.add('was-validated'); // Adiciona a classe was-validated para exibir os feedbacks de validação
        }
            });
        
        });
    </script>
</head>
<body>
<?php 
        include_once '../menu/menu.php';
    ?>
    <div class="dsp-flex justify-content-center">
        <form action="" class="col-md-12 needs-validation" id="Cadastrar_cliente" method="post" novalidate>
            <div class="container shadow pb-2">
            <div class="col-md-12 container dsp-flex justify-content-between position-relative progress-box bg-dark rounded mt-2">
                <div class="col-md-12 title-person-2" align="center">
                    CADASTRAR CLIENTE
                </div>
            </div>
			<!-- CNPJ -->
			<div class="col-md-8 container dsp-flex flex-column justify-content-center">
				<label for="CPF_CNPJ" class="form-label">CNPJ/CPF</label>
				<input type="text" class="form-control" name="CPF_CNPJ" id="CPF_CNPJ" minlength="11" maxlength="14"  required>
                <div class="invalid-feedback">
                    CPF/CNPJ inválido.
                </div>
			</div>
			<br>
            <!-- RG-->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="RG_IE" class="form-label">RG/IE</label>
                <input type="text" class="form-control" name="RG_IE" id="RG_IE" maxlength="14" required>
                <div class="invalid-feedback">
                    RG/IE inválido.
                </div>
            </div>
			<br>
			<div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="Nome" id="Nome" maxlength="120" required>
                <div class="invalid-feedback">
                    Nome não pode estar vazio.
                </div>
            </div>
			<br>
            <!-- TIPO PESSOA -->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
            	<label class="form-label">Selecione seu tipo pessoa</label>
            		<div class="form-check">
						<label class="form-check-label" for="Tipo_pessoa1">
							Jurídica 
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
					<input type="date" class="form-control" name="Data_nascimento" id="Data_nascimento" placeholder="DD/MM/AAAA" required>
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
