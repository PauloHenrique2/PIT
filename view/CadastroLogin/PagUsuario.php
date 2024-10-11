<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="PagUsuario.css">
    <title>Página do Usuário</title>
</head>
<body>
    <?php 
    include_once "../../model/Usuario.php";
    $u = new Usuario();

    session_start();
    if (!isset($_SESSION["id_usuario"])){
        header("location:../LandingPage/LandingPage.html");
    }

    ?>
    <div class="user-profile">
        <h1>Página do Usuário</h1>
        <div class="user-info">
        <p class="user-details"><?php $u->ExibirDados($_SESSION['id_usuario']); ?></p>
        </div>
        <div class="user-options">
            <a href="RecuperaSenha.php">Redefinir Senha</a>
            <a href="PagExclusão.php">Excluir Conta</a>
            <a href="..\..\control\Cadastro_Login\Deslogar.php">Sair</a>
        </div>
    </div>
</body>
</html>