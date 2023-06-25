
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
    <title>Entrar</title>
    <script>
        
        jQuery(function($){
            $('#entrar').click(function(){
                $.ajax({
                    method : 'POST',
                    url : 'login_script.php',
                    data : $('#Registrar').serialize(),
                    success : function(data){
                        var statusCode = data.STATUS_CODE;
                        var message = data.MESSAGE;
                        var token = data.ENTROU;
                        if (statusCode == 200){
                            Swal.fire({
                                title: 'Sucesso!',
                                text: message,
                                icon: 'success',
                                confirmButtonText: 'Confirmar'
                            }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '../menu/home.php'
                            }
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
                        console.log(token);
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
                    LOGIN
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
            <div class="botoes dsp-flex justify-content-between col-md-12">
                <a id="cadastro" href="register.php"  class="btn btn-large btn-primary" align="right"><i class="fa-solid fa-forward fa-rotate-180"></i> Cadastrar</a>
                <a id="entrar" href="javascript:" class="btn btn-large btn-primary" align="right">Entrar <i class="fa-solid fa-forward"></i></a>
            </div>
        </form>
    </div>
</body>
</html>
