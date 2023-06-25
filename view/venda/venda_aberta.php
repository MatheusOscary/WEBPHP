
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
    <title>Vendas Concluídas</title>
    <script>
        jQuery(function($){
            
        });
    </script>
</head>
<?php 
    $bllVenda = new \bll\bllVenda;
    $vendas = $bllVenda->SelectSoldA();
?>
<body>
    <div class="container dsp-flex justify-content-center">
        <table class="table table-black">
            <thead class="thead-black">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Cliente</th>
                <th scope="col">Total</th>
                <th scope="col">Forma de pagamento</th>
                <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($vendas != null)
                foreach ($vendas as $venda){ ?>
                    <tr>
                        <th scope="row"><?php echo $venda->getId(); ?></th>
                        <td><?php echo $venda->getConsumer(); ?></td>
                        <td><?php echo $venda->getTotal(); ?></td>
                        <td><?php echo $venda->getForma_pagto(); ?></td>
                        <td><a href="venda.php?SoldId=<?php echo $venda->getId(); ?>"><i class="fa-solid fa-pencil fa-lg" style="color: #00a33f;"></i></a></td>
                    </tr>
                    <tr>
                        <td colspan="5">
                        <?php
                            $vendaId = $venda->getId();
                            $url = 'http://localhost/WEBPHP/view/venda/venda_itens_venda.php?&SoldId=' . urlencode($vendaId);
                            $content = file_get_contents($url);
                            eval('?>' . $content);
                        ?>
                        </td>
                    </tr>
                <?php }; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
