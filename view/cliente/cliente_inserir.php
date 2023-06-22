
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
            <!-- RG-->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="User" class="form-label">RG/IE</label>
                <input type="text" class="form-control" name="User" id="User">
            </div>
            <!-- CNPJ -->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Pass" class="form-label">CNPJ/CPF</label>
                <input type="text" class="form-control" name="Pass" id="Pass">
            </div>
            <!-- TIPO PESSOA -->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
            <label for="Pass" class="form-label">Selecione seu tipo pessoa</label>
            <div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
    Juridica 
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
  <label class="form-check-label" for="flexRadioDefault2">
   Fisica
  </label>
  </div>
</div>
<!-- SEXOOOOOOOOOOOOOOOOOOOO -->
<div class="col-md-8 container dsp-flex flex-column justify-content-center">
            <label for="Pass" class="form-label">Sexo </label>
            <div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
    Masculino
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
  <label class="form-check-label" for="flexRadioDefault2">
   Feminino
  </label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
    MNETC
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
    Indefinido
  </label>
</div>
</div>
<!-- DATA -->
<div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Pass" class="form-label">DATA</label>
                <input type="text" class="form-control" name="Pass" id="Pass" placeholder="DD/MM/AAAA">
            </div>
            <div class="botoes dsp-flex justify-content-end col-md-11">
                <a id="cadastrar" class="btn btn-large btn-dark" align="right"><i class="fa-sharp fa-solid fa-plus fa-fade"></i> Cadastrar</a>
            </div>
            
            </div>
            
        </form>
    </div>
</body>
</html>
