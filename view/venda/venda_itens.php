<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        include_once '../include_padrao.php';
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
        <thead class="thead-dark">
            <tr>
            <th scope="col">ID</th>
            <th scope="col">Código de barras</th>
            <th scope="col">Nome</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Preço</th>
            <th scope="col">Deletar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($vendaProdutos != null)
                foreach ($vendaProdutos as $vendaProduto){ ?>
                    <tr>
                        <th scope="row"><?php echo $vendaProduto->getId(); ?></th>
                        <td><?php echo $vendaProduto->getCod_barra(); ?></td>
                        <td><?php echo $vendaProduto->getNome(); ?></td>
                        <td><?php echo $vendaProduto->getQuantidade(); ?></td>
                        <td>R$ <?php echo $vendaProduto->getPreco(); ?></td>
                        <td>
                            <a class="delete" href="javascript:">
                                <i class="fa-solid fa-trash fa-lg" style="color: #ff0000;"></i>
                            </a>
                        </td>
                    </tr>
                <?php }; ?>
        </tbody>
    </table>
</body>
</html>
