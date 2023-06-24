<?php 

include_once "../../bll/bllProduto.php";


$produto = $_POST['ProductsId'];

$bllProduto = new \bll\bllProduto;

$data = $bllProduto->Delete($produto);

echo $data;

?>