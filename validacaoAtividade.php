<?php 
include_once "atividade.php";
$atv = new Atividade;
$atv->SetTitulo($_POST['titulo']);
$atv->SetDescricao($_POST['instrucoes']);
$atv->SetValor($_POST['valor']);
$atv->SetPrazo($_POST['prazo']); 
$atv->SetTableAtividade();
?>