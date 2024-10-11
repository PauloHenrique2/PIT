<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include_once "conexao.php";
require '/wamp64/www/Leon/PHPMailer/src/Exception.php';
require '/wamp64/www/Leon/PHPMailer/src/PHPMailer.php';
require '/wamp64/www/Leon/PHPMailer/src/SMTP.php';

$email = $_POST['email'];
$idUsuario = $_POST['id'];
$novasenha = gerarSenha();
$con = new conexao();
$mail = new PHPMailer(true);

// Configurando o servidor
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Username = "threeroom300@gmail.com";
$mail->Password = "jmhzfhcsehmuxnun";
$mail->Port = 465;

// Configurando o remetente
$mail-> setFrom("threeroom300@gmail.com");
$mail-> addAddress($email);

// Definindo o conteúdo do email
$mail->isHTML(true);
$mail->Subject = "Recuperacao de Senha - Leon";
$mail->Body = "Sua nova senha temporaria: " . $novasenha;

function gerarSenha($length = 10)
{
  $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $senha = '';
  for ($i = 0; $i < $length; $i++)
  {
    $senha .= $chars[rand(0, strlen($chars) - 1)];
  }
  return $senha;
}

if (isset($email))
{
  $con->conectar();

  if ($con->con->connect_error)
  {
    die("Falha na conexão: " . $con->con->connect_error);
  }
  
  else 
  {
    $consulta1 = "SELECT email FROM Usuarios WHERE email = '$email'";
    $consulta2 = "UPDATE Usuarios SET senha = '$novasenha' WHERE id_usuario = '$idUsuario'";
    $resultado1 = $con->con->query($consulta1);

    if ($resultado1->num_rows > 0)
    {
      if ($mail->send())
      {
        echo 'Email enviado com sucesso!';
        $resultado2 = $con->con->query($consulta2);
        $con->con->close();
      }

      else
      {
        echo 'Erro ao enviar o email: ' . $mail->ErrorInfo;
      }
    }
  }
}

else
{
  header("Location: pagRecusenha.php");
  echo "Verifique o e-mail inserido!";
}
