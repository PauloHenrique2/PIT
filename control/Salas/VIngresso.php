<?php 
include_once("C:\wamp64\www\PIT\Classes\SalaDeAula.php");

$s = new SalaDeAula();
$cod = $_POST['codigo'];
$s->SetCodigo($_POST['codigo']); 
$s->IngressarSala(1);
?>