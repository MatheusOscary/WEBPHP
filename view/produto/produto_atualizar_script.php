<?php 

include_once "../../model/Produto.php";
include_once "../../bll/bllProduto.php";

$produto = new \model\Produto;

$produto->setId($_POST['ProductsId']);
$produto->setNome($_POST['Nome']);
$produto->setPreco_venda($_POST['Valor_venda']);
$produto->setPreco_compra($_POST['Valor_compra']);
$produto->setEstoque($_POST['Estoque']);

$bllProduto = new \bll\bllProduto;

$data = $bllProduto->Update($produto);

echo $data;

?>