<?php 

include_once "../../model/Produto.php";
include_once "../../bll/bllProduto.php";

$produto = new \model\Produto;

$produto->setNome($_POST['Nome']);
$produto->setPreco_venda($_POST['Valor_venda']);
$produto->setPreco_compra($_POST['Valor_compra']);
$produto->setCod_barra($_POST['Cod_barra']);
$produto->setEstoque($_POST['Estoque']);

$bllProduto = new \bll\bllProduto;

$data = array();

$data = $bllProduto->Insert($produto);

$json = json_encode($data);

header('Content-Type: application/json');

echo $json;

?>