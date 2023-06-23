
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
    $('#pronto').click(function(event){
        event.preventDefault(); // Impede o comportamento padrão do botão de enviar

        var form = $('#Registrar')[0];
        if (form.checkValidity()) {
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
        } else {
            form.classList.add('was-validated'); // Adiciona a classe was-validated para exibir os feedbacks de validação
        }
    });
});
    </script>
</head>
<body>
    <div class="container dsp-flex justify-content-center">
        <form action="register_script.php" class="col-md-6 sign-box needs-validation" id="Registrar" method="post" novalidate>
            <div class="col-md-12 container dsp-flex justify-content-between position-relative progress-box">
                <div class="col-md-8 title-person-1">
                    REGISTRAR
                </div>
            </div>
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="User" class="form-label">Nome de usuário</label>
                <input type="text" class="form-control" name="User" id="User"  maxlength="32" required>
                <div class="invalid-feedback">
                    Nome de usuário não pode estar vazio.
                </div>
            </div>
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Pass" class="form-label">Senha</label>
                <input type="password" class="form-control" name="Pass" id="Pass" minlength="8" maxlength="32" required>
                <div class="invalid-feedback">
                   Senha precisa ter mais de 8 caracteres.
                </div>
            </div>
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Email" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="Email" id="Email" maxlength="60" required>
                <div class="invalid-feedback">
                   Email inválido.
                </div>
            </div>
            <div class="botoes dsp-flex justify-content-end col-md-12">
                <a id="pronto" class="btn btn-large btn-primary" align="right">Pronto <i class="fa-solid fa-forward fa-beat"></i></a>
            </div>
        </form>
    </div>
</body>
</html>
