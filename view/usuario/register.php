
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
    <title>Registrar</title>
    <script>
        
        jQuery(function($){
            $('#pronto').click(function(){

                $.ajax({
                    method : 'POST',
                    url : 'register_script.php',
                    data : $('#Registrar').serialize(),
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
            });
        });
    </script>
</head>
<body>
    <div class="container dsp-flex justify-content-center">
        <form action="register_script.php" class="col-md-6 sign-box" id="Registrar" method="post">
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
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Email" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="Email" id="Email">
            </div>
            <div class="botoes dsp-flex justify-content-end col-md-12">
                <a id="pronto" class="btn btn-large btn-primary" align="right">Pronto <i class="fa-solid fa-forward fa-beat"></i></a>
            </div>
        </form>
    </div>
</body>
</html>
