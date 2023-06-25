
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
    <title>Cadastrar produto</title>
    <script>
        
        jQuery(function($){
            $('#cadastrar').click(function(){
            event.preventDefault(); // Impede o comportamento padrão do botão de enviar

            var form = $('#Cadastrar_produto')[0];
            if (form.checkValidity()) {
                $.ajax({
                    method : 'POST',
                    url : 'produto_inserir_script.php',
                    data : $('#Cadastrar_produto').serialize(),
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
        <form action="register_script.php" class="col-md-12 needs-validation" id="Cadastrar_produto" method="post" required>
            <div class="container shadow pb-2">
            <div class="col-md-12 container dsp-flex justify-content-between position-relative progress-box bg-dark rounded mt-2">
                <div class="col-md-12 title-person-2" align="center">
                    CADASTRAR PRODUTO
                </div>
            </div>
            <!-- NOME -->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="Nome" id="Nome"  maxlength="120" required>
                <div class="invalid-feedback">
                  Nome não pode estar vazio.
                </div>
            </div>
            <!-- VALOR VENDA -->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Valor_venda" class="form-label">Valor venda</label>
                <input type="number" step="any" class="form-control" name="Valor_venda" id="Valor_venda" placeholder="R$" required>
                <div class="invalid-feedback">
                  Valor inválido.
                </div>
            </div>
               <!-- VALOR COMPRA -->
               <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Valor_compra" class="form-label">Valor compra</label>
                <input type="number" step="any" class="form-control" name="Valor_compra" id="Valor_compra" placeholder="R$" required>
                <div class="invalid-feedback">
                    Valor inválido.
                </div>
            </div>
              <!-- CODIGO DE BARRA -->
              <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Cod_barra" class="form-label">Código de Barras</label>
                <input type="text" class="form-control" name="Cod_barra" id="Cod_barra" placeholder="00000000000" maxlength="13" required>
                <div class="invalid-feedback">
                   Codigo de barra inválido.
                </div>
            </div>
              <!-- ESTOQUE -->
              <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Estoque" class="form-label">Estoque</label>
                <input type="number" class="form-control" name="Estoque" id="Estoque" required>
                <div class="invalid-feedback">
                   Estoque não pode estar vazio.
                </div>
            </div>


            <div class="botoes dsp-flex justify-content-end col-md-11">
                <!--<a id="cadastrar" class="btn btn-large btn-dark" align="right"><i class="fa-sharp fa-solid fa-plus fa-fade"></i> Cadastrar produto</a>-->
                    <a id="cadastrar" class="btn btn-large btn-dark" align="right"><i class="fa-sharp fa-solid fa-plus fa-fade"></i> Cadastrar produto</a>
            </div>
            
            </div>
            
        </form>
    </div>
</body>
</html>
