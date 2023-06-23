<?php 

include_once "../../model/Cliente.php";
include_once "../../bll/bllCliente.php";

$cliente = new \model\Cliente;

$cliente->setNome($_POST['Nome']);
$cliente->setId($_POST['ConsumerId']);
$cliente->setRG_IE($_POST['RG_IE']);
$cliente->setTipo_pessoa($_POST['Tipo_pessoa']);
$cliente->setData_nascimento ($_POST['Data_nascimento']);
$cliente->setSexo($_POST['Sexo']);

$bllCliente = new \bll\bllCliente;

$data = $bllCliente->Update($cliente);

echo $data;

?>