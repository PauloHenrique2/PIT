<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Cadastro</title>
</head>
<body>

<div class="container" >
    <a class="links" id="paracadastro"></a>
    <a class="links" id="paralogin"></a>
    
    <div class="content">      
      <!--FORMULÁRIO DE LOGIN-->
      <div id="login">
        <form action="../../control/Cadastro_Login/VLogin.php" method="POST"> 
          <h1>Login</h1> 
          <p> 
            <label for="email_login">Insira seu E-mail</label>
            <input id="email_login" name="email_login" required="required" type="text" placeholder="E-mail"/>
          </p>
          
          <p> 
            <label for="senha_login">Insira sua Senha</label>
            <input id="senha_login" name="senha_login" required="required" type="password" placeholder="Senha"/> 
          </p>
          
          <p> 
            <input type="checkbox" name="manterlogado" id="manterlogado" value="" /> 
            <label for="manterlogado">Manter Login</label>
          </p>
          
          <p> 
            <input type="submit" value="Logar" /> 
          </p>
          
          <p class="link">
            Ainda não tem conta?
            <a href="#paracadastro">Cadastre-se</a>
            <br>
            <br>
            <br>
            <br>
            Esqueceu a senha?
            <a href="RecuperaSenha.php"> Recupere aqui </a>
          </p>

        </form>
      </div> 

      <!--FORMULÁRIO DE CADASTRO-->
      <div id="cadastro">
        <form action="../../control/Cadastro_Login/VCadastro.php" method="POST" > 
          <h1>Cadastro</h1> 
          
          <p> 
            <label for="nome_cad">Insira seu nome</label>
            <input id="nome_cad" name="nome_cad" required="required" type="text" placeholder="Nome" />
          </p>
          
          <p> 
            <label for="email_cad">Insira seu E-mail</label>
            <input id="email_cad" name="email_cad" required="required" type="email" placeholder="E-mail"/> 
          </p>
          
          <p> 
            <label for="senha_cad">Insira sua Senha</label>
            <input id="senha_cad" name="senha_cad" required="required" type="password" placeholder="Senha"/>
          </p>
          
          <p> 
            <input type="submit" value="Cadastrar"/> 
          </p> 
          
          <p class="link">  
            Já tem conta?
            <a href="#paralogin"> Ir para Login </a>
          </p>
        </form>
      </div>
    </div>
  </div> 
