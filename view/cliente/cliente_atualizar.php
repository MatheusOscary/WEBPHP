
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        include_once '../include_padrao.php';
        include_once "../../bll/bllCliente.php";
    ?>
    <style>
        .botoes{
            margin-top: 5%;
        }
    </style>
    <title>Cadastrar Cliente</title>
	<script>
        
        jQuery(function($){
            $(document).on('click', '#atualizar',function(){
				event.preventDefault(); // Impede o comportamento padrão do botão de enviar

            var form = $('#Atualizar_cliente')[0];
            if (form.checkValidity()) {

                $.ajax({
                    method : 'POST',
                    url : 'cliente_atualizar_script.php',
                    data : $('#Atualizar_cliente').serialize(),
                    success : function(data){
                            Swal.fire({
                                title: 'Sucesso!',
                                text: 'Cliente atualizado.',
                                icon: 'success',
                                confirmButtonText: 'Confirmar'
                            }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = 'cliente_listar.php'
                        }
                        })
                    }
                });
			} else {
            form.classList.add('was-validated'); // Adiciona a classe was-validated para exibir os feedbacks de validação
        }
            });
		
        });
    </script>
</head>
<?php 
    //$cliente = new \model\Cliente;
    $bllCliente = new \bll\bllCliente;
    $cliente = $bllCliente->SelectConsumer($_REQUEST["ConsumerId"]);

?>
<body>
<?php 
        include_once '../menu/menu.php';
    ?>
    <div class="dsp-flex justify-content-center">
        <form action="" class="col-md-12 needs-validation" id="Atualizar_cliente" method="post" novalidate>
            <div class="container shadow pb-2">
            <div class="col-md-12 container dsp-flex justify-content-between position-relative progress-box bg-dark rounded mt-2">
                <div class="col-md-12 title-person-2" align="center">
                    ATUALIZAR CLIENTE
                </div>
            </div>
			<!-- CNPJ -->
			<div class="col-md-8 container dsp-flex flex-column justify-content-center">
				<label for="CPF_CNPJ" class="form-label">CNPJ/CPF</label>
				<input type="text" disabled="disabled" value="<?php echo $cliente->getCPF_CNPJ();?>" class="form-control" name="CPF_CNPJ" id="CPF_CNPJ" >
				
			</div>
			<br>
            <!-- RG-->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="RG_IE" class="form-label">RG/IE</label>
                <input type="text" class="form-control" name="RG_IE" id="RG_IE" value="<?php echo $cliente->getRG_IE();?>" minlength="11" maxlength="14" required>
				<div class="invalid-feedback">
                    RG/IE inválido.
                </div>
            </div>
			<br>
			<!-- NOME -->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="Nome" id="Nome" value="<?php echo $cliente->getNome();?>" maxlength="120" required>
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
							Juridica 
						</label>
  						<input class="form-check-input" type="radio" value="J" <?php  if ($cliente->getTipo_pessoa() == "J") { echo 'checked="checked"'; } ?> name="Tipo_pessoa" id="Tipo_pessoa1">
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" <?php  if ($cliente->getTipo_pessoa() == "F"){ echo 'checked="checked"'; } ?>  value="F" name="Tipo_pessoa" id="Tipo_pessoa2" >
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
						<input class="form-check-input" value="M" <?php  if ($cliente->getSexo() == "M") { echo 'checked="checked"'; } ?>  type="radio" name="Sexo" id="Sexo1">
						<label class="form-check-label" for="Sexo1">
							Masculino
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="F" <?php  if ($cliente->getSexo() == "F"){ echo 'checked="checked"'; } ?> name="Sexo" id="Sexo2" >
						<label class="form-check-label" for="Sexo2">
							Feminino
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="MNTC" <?php  if ($cliente->getSexo() == "MNTC"){ echo 'checked="checked"'; } ?> name="Sexo" id="Sexo3">
						<label class="form-check-label" for="Sexo3">
							MNETC
						</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" value="I" <?php  if ($cliente->getSexo() == "I") { echo 'checked="checked"'; } ?> name="Sexo" id="Sexo3">
						<label class="form-check-label" for="Sexo3">
							Indefinido
						</label>
					</div>
				</div>
				<br>
				<!-- DATA -->
				<div class="col-md-8 container dsp-flex flex-column justify-content-center">
					<label for="Data_nascimento" class="form-label">Data</label>
					<input type="date" class="form-control" name="Data_nascimento" id="Data_nascimento" value="<?php echo date("Y-m-d", strtotime($cliente->getData_nascimento())); ?>" placeholder="DD/MM/AAAA" required>
				</div>
				<br>
                <input type="hidden" name="ConsumerId" value="<?php echo $_REQUEST["ConsumerId"];?>">
				<div class="botoes dsp-flex justify-content-end col-md-11">
					<a id="atualizar" class="btn btn-large btn-dark" align="right"><i class="fa-sharp fa-solid fa-plus fa-fade"></i> Atualizar</a>
				</div>
            </div> 
        </form>
    </div>
</body>
</html>
