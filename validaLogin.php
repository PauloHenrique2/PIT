<?php
$servidor = "localhost";
$usuario = "root";
$senhaBd = "";
$nomeBd = "classroomplus";

// Dados de login
$email = $_POST['email_login'];
$senha = $_POST['senha_login'];

$conn = new mysqli($servidor, $usuario, $senhaBd, $nomeBd);

// Verificando a conexão
if ($conn->connect_error)
{
 die("Falha na conexão: " . $conn->connect_error);
}

$consulta = "SELECT email, senha FROM usuarios WHERE email = '$email' AND senha = '$senha'";
$resultado = $conn->query($consulta);


if ($resultado->num_rows === 1)
{
    $conn->close();
    header("Location: salasDeAula.php"); 
}

else
{
    $conn->close();
    header("Location: telaCadastroLogin.php"); 
}
?>