<?php
include_once "configbd.php";

$conn = new mysqli($servidor, $usuario, $senha, $nomeBd);

if ($conn->connect_error)
{
  die("Falha na conexão: " . $conn->connect_error);
}

else
{
  $nomesala = $_POST['nomeSala'];
  $descsala = $_POST['descSala'];
  $cod = rand(10000, 99999);

  if (!empty($nomesala) && !empty($descsala))
  {
   $sql = "INSERT INTO SalaDeAula(nome, descricao, codigo_de_convite) VALUES ('$nomesala', '$descsala', '$cod')";

  if ($conn->query($sql) === TRUE)
  {
   if (!empty($nomesala) && !empty($descsala))
   {
    echo "Sala criada com sucesso!";
   }

   else
   {
    echo "Verifique os campos inseridos!";
   }
  }
 }
}
?>