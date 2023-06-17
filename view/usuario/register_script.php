<?php 

include_once "../../model/Usuario.php";
include_once "../../bll/bllUsuario.php";

$usuario = new \model\Usuario;

$usuario->setUser($_POST['User']);
$usuario->setPassword($_POST['Pass']);
$usuario->setEmail($_POST['Email']);

$bllUsuario = new \bll\bllUsuario;
$bllUsuario->Insert($usuario);

?>