<?php
include('includes/conexao.php');

$email = "admin@teste.com";
$senha = "admin";


$sql = "INSERT INTO users_login (email, senha)
        VALUES ('$email', '$senha')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>✅ Usuário inserido com sucesso!</h2>";
    echo "ID gerado: " . $conn->insert_id;
} else {
    echo "Erro ao inserir: " . $conn->error;
}

$conn->close();
?>