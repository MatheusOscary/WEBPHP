
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
</head>
<body>
    <div class="dsp-flex justify-content-center">
        <form action="register_script.php" class="col-md-12 needs-validation" id="Registrar" method="post" required>
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
                    <button type="submit"id="cadastrar" class="btn btn-large btn-dark" align="right"><i class="fa-sharp fa-solid fa-plus fa-fade"></i> Cadastrar produto></button>
            </div>
            
            </div>
            
        </form>
    </div>
</body>
</html>
