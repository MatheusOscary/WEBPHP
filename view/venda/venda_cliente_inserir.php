
<?php 

include_once "../../bll/bllVenda.php";

$CPF_CNPJ = $_POST['CPF_CNPJ'];
$SoldId = $_POST['SoldId'];

$bllVenda = new \bll\bllVenda;

$data = array();

$data = $bllVenda->InsertConsumerSold($SoldId, $CPF_CNPJ);

$json = json_encode($data);

header('Content-Type: application/json');

echo $json;

?>