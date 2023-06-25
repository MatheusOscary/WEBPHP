<?php 

include_once "../../model/Venda.php";
include_once "../../bll/bllVenda.php";

$vendaProduto = new \model\VendaProduto;

$vendaProduto->setid($_POST['ProductsId']);
$vendaProduto->setSoldId($_POST['SoldId']);

$bllVenda = new \bll\bllVenda;

$data = array();

$data = $bllVenda->DeleteProductSold($vendaProduto);

$json = json_encode($data);

header('Content-Type: application/json');

echo $json;

?>