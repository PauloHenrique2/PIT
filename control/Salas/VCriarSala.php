<?php
include_once("../../model/SalaDeAula.php");
$s = new SalaDeAula();
session_start();

if(isset($_POST['nome']) && isset($_POST['desc'])){
    $s->SetNome($_POST['nome']);
    $s->SetDesc($_POST['desc']);
    $s->CriarSala($_SESSION['id_usuario']);
}
?>