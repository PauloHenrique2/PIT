<?php
  session_start();
  unset($_SESSION['id_usuario']);
  session_destroy();
  header("Location: ../../view/CadastroLogin/Login.php");
?>