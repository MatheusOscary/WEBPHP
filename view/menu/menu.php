
    <?php 
        include_once '../include_padrao.php';
        include_once "../../bll/bllUsuario.php";
    ?>
    <script>
        jQuery(function($) {
            $(document).ready(function() {
                $('.collapseele').click(function() {
                    $(this).next().collapse('show');
                });

                $('.collapse').mouseleave(function() {
                    $(this).collapse('hide');
                });
            });
        });
    </script>
    <?php 
    $bllUsuario= new \bll\bllUsuario;
    $User = $bllUsuario->SelectUser();

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <a class="navbar-brand" style="margin-left: 1%;" href="#"><img src="../../public/Logo.png" class="rounded" alt="" width="150px"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item" style="margin-right: 40%;">
                <a class="nav-link collapseele" href="#" id="cliente" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">
                    Clientes
                </a>
                <div class="collapse" id="collapse1" style="position:absolute;">
                <div class="col-12">
                    <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action" id="cadastrar" data-toggle="list" href="../cliente/cliente_inserir.php" role="tab" aria-controls="cadastrar"><i class="fa-solid fa-plus fa-bounce"></i> Cliente Cadastrar</a>
                    <a class="list-group-item list-group-item-action" id="listar" data-toggle="list" href="../cliente/cliente_listar.php" role="tab" aria-controls="listar"><i class="fa-solid fa-list fa-fade"></i> Cliente Listar</a>
                    </div>
                </div>
                </div>
            </li>
            <li class="nav-item" style="margin-right: 40%;">
                <a class="nav-link collapseele" href="#" id="cliente" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">
                    Produtos
                </a>
                <div class="collapse" id="collapse2" style="position:absolute;">
                <div class="col-12">
                    <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action" id="cadastrarproduto" data-toggle="list" href="../produto/produto_inserir.php" role="tab" aria-controls="cadastrarproduto"><i class="fa-solid fa-plus fa-bounce"></i> Produto Cadastrar</a>
                    <a class="list-group-item list-group-item-action" id="listarproduto" data-toggle="list" href="../produto/produto_listar.php" role="tab" aria-controls="listarproduto"><i class="fa-solid fa-list fa-fade"></i> Produto Listar</a>
                    </div>
                </div>
                </div>
            </li>
            <li class="nav-item" style="margin-right: 40%;">
                <a class="nav-link collapseele" href="#" id="cliente" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse3">
                    Vendas
                </a>
                <div class="collapse" id="collapse3" style="position:absolute;">
                <div class="col-12">
                    <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action" id="listarproduto" data-toggle="list" href="../venda/venda_listar.php" role="tab" aria-controls="listarproduto">Concluídas</a>
                    </div>
                </div>
                </div>
            </li>
        </ul>
        <a class="btn btn-light" style="margin-left: 40%;" href="../venda/venda_inserir.php"><i class="fa-solid fa-cash-register"></i><b> Venda</b></a>
        <div class="text-light" style="margin-left: 5%;"><i class="fa-solid fa-user"></i> <b><?php echo $User; ?></b></div>
        <a class="text-danger"  href="../usuario/logout.php" style="margin-left: 5%;"><i class="fa-solid fa-right-from-bracket"></i> Desconectar</a>
    </div>
</nav>
