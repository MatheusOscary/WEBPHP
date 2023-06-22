<?php 

include_once "../../model/Cliente.php";
include_once "../../bll/bllCliente.php";

$cliente = new \model\Cliente;

$cliente->setCPF_CNPJ($_POST['CPF_CNPJ']);
$cliente->setRG_IE($_POST['RG_IE']);
$cliente->setTipo_pessoa($_POST['Tipo_pessoa']);
$cliente->setData_nascimento ($_POST['Data_nascimento']);
$cliente->setSexo($_POST['Sexo']);

$bllCliente = new \bll\bllCliente;

$data = array();

$data = $bllCliente->Insert($cliente);

$json = json_encode($data);

header('Content-Type: application/json');

echo $json;

?>