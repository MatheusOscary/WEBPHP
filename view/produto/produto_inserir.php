
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
        <form action="register_script.php" class="col-md-12" id="Registrar" method="post">
            <div class="container shadow pb-2">
            <div class="col-md-12 container dsp-flex justify-content-between position-relative progress-box bg-dark rounded mt-2">
                <div class="col-md-12 title-person-2" align="center">
                    CADASTRAR PRODUTO
                </div>
            </div>
            <!-- ID-->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="User" class="form-label">ID</label>
                <input type="text" class="form-control" name="User" id="User">
            </div>
            <!-- NOME -->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Pass" class="form-label">NOME</label>
                <input type="text" class="form-control" name="Pass" id="Pass">
            </div>
            <!-- VALOR VENDA -->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Pass" class="form-label">VALOR VENDA</label>
                <input type="text" class="form-control" name="Pass" id="Pass" placeholder="R$">
            </div>
               <!-- VALOR COMPRA -->
               <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Pass" class="form-label">VALOR COMPRA</label>
                <input type="text" class="form-control" name="Pass" id="Pass" placeholder="R$">
            </div>
              <!-- CODIGO DE BARRA -->
              <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Pass" class="form-label">Código de Barras/label>
                <input type="text" class="form-control" name="Pass" id="Pass" placeholder="00000000000">
            </div>
              <!-- ESTOQUE -->
              <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Pass" class="form-label">QUANTAS UNIDADES EM ESTOQUE</label>
                <input type="text" class="form-control" name="Pass" id="Pass" >
            </div>


            <div class="botoes dsp-flex justify-content-end col-md-11">
                <a id="cadastrar" class="btn btn-large btn-dark" align="right"><i class="fa-sharp fa-solid fa-plus fa-fade"></i> Cadastrar produto</a>
            </div>
            
            </div>
            
        </form>
    </div>
</body>
</html>
