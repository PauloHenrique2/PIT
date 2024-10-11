<?php
include_once("../../model/Usuario.php");
$user = new Usuario();

// Obtendo os dados do formulário
$user->SetEmail( $_POST['email_login']);
$user->SetSenha($_POST['senha_login']);
$user->Logar();
?>