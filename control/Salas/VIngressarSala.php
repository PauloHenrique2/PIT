<?php 
include_once("../../model/SalaDeAula.php");

$s = new SalaDeAula();
$cod = $_POST['codigo'];
$s->SetCodigo($_POST['codigo']); 

session_start();
$s->IngressarSala($_SESSION['id_usuario']);
?>