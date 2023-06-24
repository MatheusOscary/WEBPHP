
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
    <title>Clientes</title>
    <script>
        jQuery(function($){
            $('.delete').click(function(){
                $.ajax({
                    method: 'POST',
                    url: 'cliente_deletar.php',
                    data: 'ConsumerId=' + $(this).attr('ConsumerId'),
                    success: function(data){
                        window.reload();
                    }
                });
            });
        });
    </script>
</head>
<?php 
    $bllCliente = new \bll\bllCliente;
    $clientes = $bllCliente->Select();
?>
<body>
    <div class="container dsp-flex justify-content-center">
        <table class="table table-dark">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">CPF/CNPJ</th>
                <th scope="col">Nome</th>
                <th scope="col">Atualizar</th>
                <th scope="col">Deletar</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($clientes != null)
                foreach ($clientes as $cliente){ ?>
                    <tr>
                        <th scope="row"><?php echo $cliente->getId(); ?></th>
                        <td><?php echo $cliente->getCPF_CNPJ(); ?></td>
                        <td><?php echo $cliente->getNome(); ?></td>
                        <td>
                        <a href="cliente_atualizar.php?ConsumerId=<?php echo $cliente->getId(); ?>"><i class="fa-solid fa-arrows-rotate fa-lg" style="color: #0008ff;"></i></a>    
                        </td>
                        <td><a class="delete" href="javascript:" ConsumerId="<?php echo $cliente->getId(); ?>"><i class="fa-solid fa-trash fa-lg" style="color: #ff0000;"></i></a></td>
                    </tr>
                <?php }; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
