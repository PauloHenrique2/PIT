<?php 
include_once "../../model/Atividade.php";
include_once "../../model/BancoDeDados.php";
$atv = new Atividade;
$bd = new BancoDeDados();

session_start();

$quant_grupo = $_POST['quantGrupo'];
$atv = new Atividade;
$atv->SetTitulo($_POST['titulo']);
$atv->SetTipo($_POST['tipo']);
$atv->SetDescricao($_POST['instrucoes']);
$atv->SetValor($_POST['valor']);
$atv->SetPrazo($_POST['prazo']); 

$atv->SetDataCriacao();

if($atv->GetTipo() == "Individual"){
    $atv->CriarAtividade($_SESSION['id_sala']);
}
else{
    $atv->CriarAtividadeEmGrupo($_SESSION['id_sala'], $quant_grupo);
}
?>