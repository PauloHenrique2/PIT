<?php
include_once("C:\wamp64\www\PIT\Classes\SalaDeAula.php");
include_once("C:\wamp64\www\PIT\Classes\BancoDeDados.php");
$s = new SalaDeAula;
$id = 1;
if (!empty($_POST['nomeSala']) && !empty($_POST['descSala']))
{
  $s->SetCodigo(rand(100000, 999999));
  $s->SetNome($nomesala = $_POST['nomeSala']);
  $s->SetDesc($nomesala = $_POST['descSala']);
  $s->CriarSala($id);
}
else{
  header("C:\wamp64\www\PIT\Classes\TelaCriarSala.html");
}

?>
