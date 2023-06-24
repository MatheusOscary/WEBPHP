<?php 

include_once "../../bll/bllCliente.php";


$cliente = $_POST['ConsumerId'];

$bllCliente = new \bll\bllCliente;

$data = $bllCliente->Delete($cliente);

echo $data;

?>