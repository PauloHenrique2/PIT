<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Login.css">
    <title>Login</title>
</head>
<body>


    <a class="links" id="paracadastro"></a>
    <a class="links" id="paralogin"></a>
    <h1>Login</h1>
  
      <!--Formulário de login-->
      <div id="login">
        <form action="../../control/Cadastro_Login/VLogin.php" method="POST"> 
          <p> 
            <label for="email_login">Insira seu E-mail:</label><br>
            <input id="email_login" name="email_login" required="required" type="text" placeholder="E-mail"/>
          </p>

          <p> 
            <label for="senha_login">Insira sua Senha:</label><br>
            <input id="senha_login" name="senha_login" required="required" type="password" placeholder="Senha"/> 
          </p>
          <p> 
            <input type="checkbox" name="manterlogado" id="manterlogado" value="" /> 
            <label for="manterlogado">Manter Login</label>
          </p>
          
          <p> 
            <input type="submit" value="Logar" /> 
          </p>

          <p> 
            <a href = "RecuperaSenha.php"> Esqueci minha senha </a> 
          </p>
          
          <p class="link">
            Ainda não tem conta?
            <a href="Cadastro.php">Cadastre-se</a>
          </p>
        </form>
      </div>

