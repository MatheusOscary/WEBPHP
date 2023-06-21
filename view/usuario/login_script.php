<?php 

include_once "../../model/Usuario.php";
include_once "../../bll/bllUsuario.php";

$usuario = new \model\Usuario;

$usuario->setUser($_POST['User']);
$usuario->setPassword($_POST['Pass']);

$bllUsuario = new \bll\bllUsuario;

$data = array();

$data = $bllUsuario->Login($usuario);

$json = json_encode($data);

header('Content-Type: application/json');

echo $json;

?>