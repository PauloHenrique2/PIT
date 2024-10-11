<?php 
include_once "../../model/Atividade.php";
include_once "../../model/BancoDeDados.php";

$bd = new BancoDeDados();
$atv = new Atividade();
$atv->SetTitulo($_POST['titulo']);
$atv->SetDescricao($_POST['instrucoes']);
$atv->SetValor($_POST['valor']);
$atv->SetPrazo($_POST['prazo']); 

$bd->Conexao();
session_start();
$sql = "SELECT id_sala FROM Usuarios_Por_Sala WHERE id_usuario = $_SESSION[id_usuario]";
$result = $bd->conn->query($sql);

if ($result->num_rows === 1)
{
    $row = $result->fetch_row();
    $atv->CriarAtividade($row[0]);
}

else
{
    echo "Ocorreu um erro: " . $bd->conn->error;
}

$bd->conn->close();
?>