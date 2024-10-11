<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="CriarAtividade.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <title>Criar Atividade</title>
</head>
<body>
  <?php
    session_start();
    if (!isset($_SESSION["id_usuario"])){
        header("location:../LandingPage/LandingPage.html");
    }
  ?>

  <h1>Criar Atividade</h1>
  <div id="a">
    <form action="../../control/Atividades/VCriarAtividade.php" method="POST" enctype="multipart/form-data"><br>
      <label for="titulo">Título:</label><br>
      <input class = "campos" type="text" id="titulo" name="titulo" required><br><br>

      <label for="tipo">Tipo:</label><br>
      <select class = "campos" id="Tipo" name="tipo">
        <option value="Individual">Individual</option>
        <option value="Grupo">Em Grupo</option>
      </select><br><br>

      <label for="tipo">Quantidade de Grupos:</label><br>
      <select class = "campos" id="QuantGrupo" name="quantGrupo">
        <?php
          for ($i = 2; $i <= 10; $i++) {
            echo "<option value=\"$i\">$i </option>";
          }
        ?>
      </select><br><br>

      <label for="instrucoes">Instruções:</label><br>
      <textarea class = "campos"  id="instrucoes" name="instrucoes" rows="4" cols="50" required></textarea><br><br>

      <label for="prazo">Prazo de Entrega:</label> <br>
      <input class = "campos" type="date" id="prazo" name="prazo"><br><br>

      <label for="valor">Valor da Atividade:</label><br>
      <select class = "campos" id="valor" name="valor">
        <?php
          for ($i = 0; $i <= 100; $i++) {
            echo "<option value=\"$i\">$i </option>";
          }
        ?>
      </select><br><br>

      <label for="anexo">Anexo:</label><br>
      <input type="file" id="anexo" name="anexo"><br><br>
      <input type="submit" value="Criar Atividade"><br><br>
    </form>
  </div>
</body>
</html>