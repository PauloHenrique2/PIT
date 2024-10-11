<?php
include_once ("../../model/BancoDeDados.php");
include_once ("../../model/Resposta.php");

$bd = new BancoDeDados();
$r = new Resposta();

$r->SetConteudoResposta($_POST['conteudo']);
$r->SetAnexo($_POST['anexo']);

$bd->Conexao();
session_start();

$sql = "SELECT
        atv.id_atividade
        FROM
         Usuarios_Por_Sala
         INNER JOIN Usuarios USING (id_usuario)
         INNER JOIN Atividades atv USING (id_sala)
        WHERE
        id_usuario = $_SESSION[id_usuario]
         AND
        id_sala = $_SESSION[id_sala];";

$result = $bd->conn->query($sql);

if ($result->num_rows === 1)
{
    $row = $result->fetch_row();
    $r->EnviarResposta($row[0]);
    echo "Resposta enviada com sucesso!";
}

else
{
    echo "Ocorreu um erro: " . $bd->conn->error;
}

$bd->conn->close();

?>