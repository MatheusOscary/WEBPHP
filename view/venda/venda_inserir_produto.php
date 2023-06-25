<?php 

include_once "../../model/Venda.php";
include_once "../../bll/bllVenda.php";

$vendaProduto = new \model\VendaProduto;

$vendaProduto->setCod_barra($_POST['produto']);
$vendaProduto->setSoldId($_POST['SoldId']);
$vendaProduto->setQuantidade($_POST['qtd']);

$bllVenda = new \bll\bllVenda;

$data = array();

$data = $bllVenda->InsertProductSold($vendaProduto);

$json = json_encode($data);

header('Content-Type: application/json');

echo $json;

?>