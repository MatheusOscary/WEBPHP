
<?php 

include_once "../../bll/bllVenda.php";

$Forma_pagto = $_POST['Forma_pagto'];
$SoldId = $_POST['SoldId'];

$bllVenda = new \bll\bllVenda;


$data = $bllVenda->FinalizeSold($SoldId, $Forma_pagto);


?>