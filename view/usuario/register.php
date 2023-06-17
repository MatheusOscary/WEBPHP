
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        include_once '../include_padrao.php'
    ?>
    <title>Registrar</title>
</head>
<body>
    <div class="container dsp-flex justify-content-center">
        <form action="register_script.php" class="col-md-4 sign-box" id="Signin" method="post">
            <div class="col-md-12 container dsp-flex justify-content-between position-relative progress-box">
                <div class="col-md-8 title-person-1">
                    REGISTRAR
                </div>
            </div>
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="User" class="form-label">Nome de usuário</label>
                <input type="text" class="form-control" name="User" id="User">
            </div>
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Pass" class="form-label">Senha</label>
                <input type="password" class="form-control" name="Pass" id="Pass">
            </div>
            <div class="botoes dsp-flex justify-content-end col-md-12">
                <button type="submit" class="btn btn-large btn-primary" align="right">Entrar <i class="fa-solid fa-forward fa-beat"></i></button>
            </div>
        </form>
    </div>
</body>
</html>
