<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        include_once "../../bll/bllVenda.php";
    ?>
    <style>
        .botoes{
            margin-top: 5%;
        }
    </style>
    <title>Venda</title>
</head>
<?php 
    $bllVenda = new \bll\bllVenda;
    $vendaProdutos = $bllVenda->SelectProductSold($_REQUEST['SoldId']);
?>
<body>
    <table class="table table-dark">
        <thead class="thead-light">
            <tr>
            <th scope="col">Código de barras</th>
            <th scope="col">Nome</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Preço</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($vendaProdutos != null)
                foreach ($vendaProdutos as $vendaProduto){ ?>
                    <tr>
                        <td scope="row"><?php echo $vendaProduto->getCod_barra(); ?></td>
                        <td><?php echo $vendaProduto->getNome(); ?></td>
                        <td><?php echo $vendaProduto->getQuantidade(); ?></td>
                        <td>R$ <?php echo $vendaProduto->getPreco(); ?></td>
                    </tr>
                <?php }; ?>
        </tbody>
    </table>
</body>
</html>
