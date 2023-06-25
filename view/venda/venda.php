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
    <script>
        jQuery(function($){
            $('#Add').click(function(){
                $.ajax({
                    method: "POST",
                    url: "venda_inserir_produto.php",
                    data: "produto="+ jQuery('#produto').val() +"&qtd="+ jQuery('#qtd').val() +"&SoldId=<?php echo $_REQUEST['SoldId'];?>",
                    success: function(data){
                        var statusCode = data.STATUS_CODE;
                        var message = data.MESSAGE;
                        if (statusCode == 200){
                            Swal.fire({
                                title: 'Sucesso!',
                                text: message,
                                icon: 'success',
                                confirmButtonText: 'Confirmar'
                            });
                            $.ajax({
                                method: "GET",
                                url: "venda_itens.php",
                                data: "SoldId=<?php echo $_REQUEST['SoldId'];?>",
                                success: function(resp){
                                    $('#itens_venda').html(resp);
                                }
                            });
                        }else{
                            Swal.fire({
                                title: 'Erro!',
                                text: message,
                                icon: 'error',
                                confirmButtonText: 'Confirmar'
                            })
                        }
                    }
                })
            });
            $(document).on('click', '.delete', function(){
                $.ajax({
                    method: 'POST',
                    url: 'venda_produto_deletar.php',
                    data: 'SoldId=<?php echo $_REQUEST['SoldId'];?>&ProductsId='+ $(this).attr('productsid'),
                    success: function(data){
                        var statusCode = data.STATUS_CODE;
                        var message = data.MESSAGE;
                        if (statusCode == 200){
                            Swal.fire({
                                title: 'Sucesso!',
                                text: message,
                                icon: 'success',
                                confirmButtonText: 'Confirmar'
                            });
                            $.ajax({
                                method: "GET",
                                url: "venda_itens.php",
                                data: "SoldId=<?php echo $_REQUEST['SoldId'];?>",
                                success: function(resp){
                                    $('#itens_venda').html(resp);
                                }
                            });
                        }else{
                            Swal.fire({
                                title: 'Erro!',
                                text: message,
                                icon: 'error',
                                confirmButtonText: 'Confirmar'
                            })
                        }
                    }

                });
            });
            $('#cliente').change(function(){
                $.ajax({
                    method: 'POST',
                    url: 'venda_cliente_inserir.php',
                    data: 'SoldId=<?php echo $_REQUEST['SoldId'];?>&CPF_CNPJ='+ $(this).val(),
                    success: function(data){
                        var statusCode = data.STATUS_CODE;
                        var message = data.MESSAGE;
                        if (statusCode == 200){
                            Swal.fire({
                                title: 'Sucesso!',
                                text: message,
                                icon: 'success',
                                confirmButtonText: 'Confirmar'
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                            //location.reload();
                        }else{
                            Swal.fire({
                                title: 'Erro!',
                                text: message,
                                icon: 'error',
                                confirmButtonText: 'Confirmar'
                            })
                        }
                    }

                });
            });
            $('#finalizar').click(function(){
                $.ajax({
                    method: 'POST',
                    url: 'venda_finalizar.php',
                    data: 'SoldId=<?php echo $_REQUEST['SoldId'];?>&Forma_pagto='+ $('#Forma_pagto').val(),
                    success: function(data){
                        window.location.href="venda_listar.php";
                    }
                });
            });
        });
    </script>
</head>
<?php 
    $bllVenda = new \bll\bllVenda;
    $venda = $bllVenda->SelectSold($_REQUEST["SoldId"]);

?>
<body>
    <div class="card text-left">
        <div class="card-header text-bg-dark">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="cliente" class="col-form-label">Cliente </label>
                </div>
                <div class="col-auto">
                    <input type="text" id="cliente" class="form-control" value="<?php echo $venda->getConsumer();?>">
                </div>
                <div class="col-md-3" align="right">
                    <label for="produto" class="col-form-label">Adicionar produto </label>
                </div>
                <div class="col-auto">
                    <input type="text" id="produto" name="produto" max-lenght="13" class="form-control">
                </div>
                <div class="col-auto">
                    <label for="qtd" class="col-form-label">Qtd </label>
                </div>
                <div class="col-md-1">
                    <input type="number" step="any" class="form-control" name="qtd" id="qtd" placeholder="R$" value="0">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-light" id="Add">Add</button>
                </div>
            </div>
            
        </div>
        <div class="card-body" id="itens_venda">
            <?php 
                include_once 'venda_itens.php'
            ?>
        </div>
        <div class="card-footer text-body-secondary text-center">
            <div class="row g-3 align-items-center text-center" style="margin-left: 40%;">
                <div class="col-auto text-center">
                    <select class="form-control" id="Forma_pagto">
                        <option value="0">Dinheiro</option>
                        <option value="1">Pix</option>
                    </select>                    
                </div>
                <div class="col-auto text-center">
                    <button type="button" id="finalizar" class="btn btn-success">Finalizar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
