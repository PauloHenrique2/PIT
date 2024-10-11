<?php
 session_start();
 if (!isset($_SESSION["id_usuario"])){
     header("location:../LandingPage/LandingPage.html");
 }
?>
<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusão de conta</title>
</head>
<body>
<h3>
 Deseja realmente excluir sua conta ?
</h3>
 <form action = "../../control/Cadastro_Login/VExclusaoUsuario.php">
  <button>Sim</button>
 </form>   
 <br>
 <br>
 <form action = "../../view/Salas/VisualizarSalas.php">
  <button>Não</button>
 </form>
</body>
</html>