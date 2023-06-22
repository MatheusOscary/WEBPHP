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
            });
        });
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
  <a class="navbar-brand" href="#">Sachete</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Cliente
        </a>
    
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Produto
        </a>
      <li class="nav-item">
        <a class="nav-link" href="#">Venda</a>
      </li>
      
    </ul>
    
  </div>
</nav>
</body>
</html>
