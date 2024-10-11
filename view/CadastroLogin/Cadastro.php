<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="cadastro.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <title>Cadastrar</title>
</head>
<body>
      <!--Formulário de cadastro-->
      <h1>Cadastro</h1> 
      <div id="cadastro">
        <form action="../../control/Cadastro_Login/VCadastro.php" method="POST" >          
          <p> 
            <label for="nome_cad">Insira seu nome:</label><br>
            <input id="nome_cad" name="nome_cad" required="required" type="text" placeholder="Nome" />
          </p>
          <br>
          <p id="b"> 
            <label for="email_cad">Insira seu E-mail:</label><br>
            <input id="email_cad" name="email_cad" required="required" type="email" placeholder="E-mail"/> 
          </p>
          <br>
          <p id="c"> 
            <label for="senha_cad">Crie sua Senha:</label><br>
            <input id="senha_cad" name="senha_cad" required="required" type="password" placeholder="Senha"/>
          </p>
          <br>
          <p> 
            <input type="submit" value="Cadastrar"/> 
          </p>
          <br>
          <p class="link">  
            Já tem conta?
            <a href="Login.php"> Ir para Login </a>
            </p>
        </form>
      </div>
    </div>
  </div> 
</body>
</html>