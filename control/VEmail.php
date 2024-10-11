<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include_once("../model/BancoDeDados.php");
require '../control/PHPMailer/src/Exception.php';
require '../control/PHPMailer/src/PHPMailer.php';
require '../control/PHPMailer/src/SMTP.php';

$bd = new BancoDeDados();
$mail = new PHPMailer(true);

$email = $_POST['email'];
$novasenha = gerarSenha();


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
  $bd->Conexao();

  if ($bd->conn->connect_error)
  {
    die("Falha na conexão: " . $bd->conn->connect_error);
  }
  
  else 
  {
    $consulta1 = "SELECT id_usuario FROM Usuarios WHERE email = '$email'";
    $resultado1 = $bd->conn->query($consulta1);
    

    if ($resultado1->num_rows == 1)
    {
      $id_usuario = $resultado1->fetch_row()[0];     
      $consulta2 = "UPDATE Usuarios SET senha = '$novasenha' WHERE id_usuario = $id_usuario";
      if ($bd->conn->query($consulta2) && $mail->send())
      {
        echo 'Email enviado com sucesso!';
        $bd->conn->close();
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
  header("Location: ../../view/RecuperaSenha.php");
  echo "Verifique o e-mail inserido!";
}
