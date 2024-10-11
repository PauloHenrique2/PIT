<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CriarSala.css">
    <title>Criação de Turma</title>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION["id_usuario"])){
        header("location:../LandingPage/LandingPage.html");
    }
    ?>
    <h1>Entrar em uma turma</h1>
    <form id="turma-form" action = "../../control/Salas/VIngressarSala.php" method="POST">
        <p> 
        <label for="nome-turma">Código de Convite:</label>
        <input type="text" name="codigo" required>
        <p>
        <button type="submit">Entrar</button>
    </form>
    <div id="mensagem"></div>
</body>
</html>
</body>