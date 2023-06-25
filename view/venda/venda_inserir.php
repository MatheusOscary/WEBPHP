<?php 

include_once "../../bll/bllVenda.php";


$bllVenda = new \bll\bllVenda;

$data = $bllVenda->InsertSold();

?>