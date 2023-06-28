
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
    <title>atualizar produto</title>
    <script>
        
        jQuery(function($){
            $(document).on('click', '#atualizar',function(){
            event.preventDefault(); // Impede o comportamento padrão do botão de enviar

            var form = $('#atualizar_produto')[0];
            if (form.checkValidity()) {
                $.ajax({
                    method : 'POST',
                    url : 'produto_atualizar_script.php',
                    data : $('#atualizar_produto').serialize(),
                    success : function(data){
                            Swal.fire({
                                title: 'Sucesso!',
                                text: 'Cliente atualizado.',
                                icon: 'success',
                                confirmButtonText: 'Confirmar'
                            }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = 'produto_listar.php'
                        }
                        })
                    }
                });
            } else {
            form.classList.add('was-validated'); // Adiciona a classe was-validated para exibir os feedbacks de validação
        }
            });
        
        });
    </script>
</head>
<?php 
    $bllProduto= new \bll\bllProduto;
    $bllProduto = $bllProduto->SelectConsumer($_REQUEST["ProductsId"]);

?>
<body>
<?php 
        include_once '../menu/menu.php';
    ?>
    <div class="dsp-flex justify-content-center">
        <form action="" class="col-md-12 needs-validation" id="atualizar_produto" method="post" required>
            <div class="container shadow pb-2">
            <div class="col-md-12 container dsp-flex justify-content-between position-relative progress-box bg-dark rounded mt-2">
                <div class="col-md-12 title-person-2" align="center">
                    ATUALIZAR PRODUTO
                </div>
            </div>
            <!-- NOME -->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="Nome" id="Nome" value="<?php echo $bllProduto->getNome();?>" maxlength="120" required>
                <div class="invalid-feedback">
                  Nome não pode estar vazio.
                </div>
            </div>
            <!-- VALOR VENDA -->
            <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Valor_venda" class="form-label">Valor venda</label>
                <input type="number" step="any" class="form-control" name="Valor_venda" id="Valor_venda"  value="<?php echo $bllProduto->getPreco_venda();?>" placeholder="R$" required>
                <div class="invalid-feedback">
                  Valor inválido.
                </div>
            </div>
               <!-- VALOR COMPRA -->
               <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Valor_compra" class="form-label">Valor compra</label>
                <input type="number" step="any" class="form-control" name="Valor_compra" id="Valor_compra"  value="<?php echo $bllProduto->getPreco_compra();?>" placeholder="R$" required>
                <div class="invalid-feedback">
                    Valor inválido.
                </div>
            </div>
              <!-- CODIGO DE BARRA -->
              <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Cod_barra" class="form-label">Código de Barras</label>
                <input type="text" disabled="disabled" class="form-control" name="Cod_barra" id="Cod_barra" placeholder="00000000000"  value="<?php echo $bllProduto->getCod_barra();?>"  maxlength="13" required>
                <div class="invalid-feedback">
                   O código de barra está inválido.
                </div>
            </div>
              <!-- ESTOQUE -->
              <div class="col-md-8 container dsp-flex flex-column justify-content-center">
                <label for="Estoque" class="form-label">Estoque</label>
                <input type="number" class="form-control" name="Estoque" id="Estoque"  value="<?php echo $bllProduto->getEstoque();?>" required>
                <div class="invalid-feedback">
                   o estoque não pode estar vazio.
                </div>
            </div>

            <input type="hidden" name="ProductsId" value="<?php echo $_REQUEST["ProductsId"];?>">
            <div class="botoes dsp-flex justify-content-end col-md-11">
                <!--<a id="atualizar" class="btn btn-large btn-dark" align="right"><i class="fa-sharp fa-solid fa-plus fa-fade"></i> atualizar produto</a>-->
                    <a id="atualizar" class="btn btn-large btn-dark" align="right"><i class="fa-sharp fa-solid fa-plus fa-fade"></i> atualizar produto</a>
            </div>
            
            </div>
            
        </form>
    </div>
</body>
</html>
