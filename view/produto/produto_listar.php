
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        include_once '../include_padrao.php';
        include_once "../../bll/bllProduto.php";
    ?>
    <style>
        .botoes{
            margin-top: 5%;
        }
    </style>
    <title>Produto</title>
    <script>
        jQuery(function($){
            $('.delete').click(function(){
                $.ajax({
                    method: 'POST',
                    url: 'produto_deletar.php',
                    data: 'ProductsId=' + $(this).attr('ProductsId'),
                    success: function(data){
                        window.reload();
                    }
                });
            });
        });
    </script>
</head>
<?php 
    $bllProduto = new \bll\bllProduto;
    $produtos = $bllProduto->Select();
?>
<body>
    <?php 
        include_once '../menu/menu.php';
    ?>
    <h2 class="text-light bg-dark text-center">Produtos</h2>
    <div class="container dsp-flex justify-content-center">
        <table class="table table-dark">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Código de barras</th>
                <th scope="col">Nome</th>
                <th scope="col">Estoque</th>
                <th scope="col">Preço venda</th>
                <th scope="col">Atualizar</th>
                <th scope="col">Deletar</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($produtos != null)
                    foreach ($produtos as $produto){ 
                ?>
                    <tr>
                        <th scope="row"><?php echo $produto->getId(); ?></th>
                        <td><?php echo $produto->getCod_barra(); ?></td>
                        <td><?php echo $produto->getNome(); ?></td>
                        <td><?php echo $produto->getEstoque(); ?></td>
                        <td>R$ <?php echo $produto->getPreco_venda(); ?></td>
                        <td><a href="produto_atualizar.php?ProductsId=<?php echo $produto->getId(); ?>"><i class="fa-solid fa-arrows-rotate fa-lg" style="color: #0008ff;"></i></a></td>
                        <td><a class="delete" href="javascript:" ProductsId="<?php echo $produto->getId(); ?>"><i class="fa-solid fa-trash fa-lg" style="color: #ff0000;"></i></a></td>
                    </tr>
                <?php }; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
