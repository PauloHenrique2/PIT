<?php
include_once "configbd.php";

$email = $_POST['email'];
$senhaNova = $_POST['novasenha'];
$idUsuario = $_POST['id'];

if (!empty($email) && !empty($senha))
{
    $conn = new mysqli($servidor, $usuario, "", $nomeBd);

    if ($conn->connect_error)
    {
     die("Falha na conexão: " . $conn->connect_error);
    }

    else
    {
    $consulta1 = "SELECT email FROM usuarios WHERE email = '$email'";
    $consulta2 = "UPDATE Usuarios SET senha = '$senhaNova' WHERE id_usuario = '$idUsuario'";

    if ($resultado = $conn->query($consulta1))
    {
      if ($resultado2 = $conn->query($consulta2))
      {
        $conn->close();
        echo "Senha alterada com sucesso!";
      }
    }

    else
    {
      echo "Verifique o e-mail inserido!";
      header("Location: pagRecusenha.php");
    }
   }
}
?>