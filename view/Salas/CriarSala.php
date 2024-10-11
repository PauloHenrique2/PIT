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

    <h1>Criação de Turma</h1>
    <form id="turma-form" action = "../../control/Salas/VCriarSala.php" method="POST">
        <p> 
        <label for="nome-turma">Nome da Turma:</label>
        <input type="text"  name = "nome" required>
        <p>

         <!-- Campo de Descrição -->

         <label for="descricao">Descrição:</label>
         <textarea id="descricao" name = "desc" rows="4" cols="65"></textarea>

        <button type="submit">Criar Turma</button>
    </form>
</body>
</html>
