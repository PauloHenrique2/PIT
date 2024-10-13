
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="sala.css" media="screen" />
    <title>Document</title>
</head>

<body>
<form class="container" action = 'validaIngresso.php' method="POST">
        Digite o código de convite: <br>
        <input class="txt1" type="text" name="codigo" required="required">
        <button class="btn1"> Entrar </button>
</form>

<?php $cod = $_POST['codigo']; ?>
</body>