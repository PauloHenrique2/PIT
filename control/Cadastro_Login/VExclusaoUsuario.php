<?php
 include_once "../../model/Usuario.php";

 $u = new Usuario();
 if ($u->ExcluirUsuario() === TRUE)
 {
    echo "Conta excluída com sucesso!";
 }

 else
 {
    echo "Ocorreu um erro ao excluir a sua conta!";
 }
?>