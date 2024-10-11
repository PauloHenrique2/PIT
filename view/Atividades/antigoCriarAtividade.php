<!DOCTYPE html>
<html>
<head>
  <title>Criar Atividade</title>
</head>
<body>
  <h1>Criar Atividade</h1>

  <?php
    session_start();
  ?>
  <form action="../../control/Atividades/VCriarAtividade.php" method="POST" enctype="multipart/form-data">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" required><br><br>

    <label for="instrucoes">Instruções:</label><br>
    <textarea id="instrucoes" name="instrucoes" rows="4" cols="50" required></textarea><br><br>

    <label for="tipo">Tipo:</label>
    <select id="Tipo" name="tipo">
      <option value="Individual">Individual</option>
      <option value="Grupo">Em Grupo</option>
    </select><br><br>

    <label for="tipo">Quantidade de Grupos:</label>
    <select id="QuantGrupo" name="quantGrupo">
      <?php
        for ($i = 2; $i <= 5; $i++) {
          echo "<option value=\"$i\">$i </option>";
        }
      ?>
    </select><br><br>

    <label for="prazo">Prazo de Entrega:</label>
    <input type="date" id="prazo" name="prazo" required><br><br>

    <label for="valor">Valor da Atividade:</label>
    <select id="valor" name="valor">
      <?php
        echo "<option value = ''>";
        for ($i = 1; $i <= 100; $i++) {
          echo "<option value=\"$i\">$i </option>";
        }
      ?>
    </select><br><br>

    <label for="anexo">Anexo:</label>
    <input type="file" id="anexo" name="anexo"><br><br>

    <input type="submit" value="Criar Atividade">
  </form>
</body>
</html>