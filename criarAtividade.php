

<!DOCTYPE html>
<html>
<head>
  <title>Criar Atividade</title>
</head>
<body>
  <h1>Criar Atividade</h1>

  <form action="validacaoAtividade.php" method="POST" enctype="multipart/form-data">
    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" required><br><br>

    <label for="instrucoes">Instruções:</label><br>
    <textarea id="instrucoes" name="instrucoes" rows="4" cols="50" required></textarea><br><br>

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

    <?php 
    $titulo = $_POST['titulo'];
    $instrucoes = $_POST['instrucoes'];
    $prazo = $_POST['prazo'];
    $valor = $_POST['valor'];
    $anexo = $_POST['anexo'];
    ?>
  </form>
</body>
</html>