<?php
include_once("../../model/Usuario.php");
$user = new Usuario();

// Obtendo os dados do formulário
$user->SetNome($_POST['nome_cad']);
$user->SetEmail( $_POST['email_cad']);
$user->SetSenha($_POST['senha_cad']);
$user->Cadastrar();
?>