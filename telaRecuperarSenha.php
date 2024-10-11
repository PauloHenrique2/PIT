<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperação de senha</title>
</head>
<body>
    <form action="validaEmail.php" method="POST">
     <label>Insira seu e-mail</label>
     <input type = "text" name = "email" required>
     <br>
     <br>
     <label>Insira seu id </label>
     <input type = "number" name = "id" required>
     <br>
     <br>
     <label>Insira sua nova senha</label>
     <input type = "password" name = "novasenha" required>
     <br>
     <br>
     <button>Recuperar</button>
    </form>
</body>
</html>