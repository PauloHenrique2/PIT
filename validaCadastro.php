<?php
$servidor = "localhost";
$usuario = "root";
$senhaBd = "IsadoraPinto2";
$nomeBd = "classroomplus";

// Criando uma conexão com o banco de dados
$conn = new mysqli($servidor, $usuario, $senhaBd, $nomeBd);

// Verificando a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Obtendo os dados do formulário
$nome = $_POST['nome_cad'];
$email = $_POST['email_cad'];
$senha = $_POST['senha_cad'];

// Inserindo os dados no banco de dados

if (!empty($nome) or !empty($nome) or !empty($nome)){
$sql = "INSERT INTO usuarios(nome, email, senha) VALUES ('$nome', '$email', '$senha')";

if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}
}
else{
    echo("Eta deu ruim hein");
}

// Fechando a conexão
$conn->close();

?>