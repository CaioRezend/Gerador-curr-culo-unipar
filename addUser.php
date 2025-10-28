<?php
include('includes/conexao.php');

$nome = "Caio Rezende";
$email = "caio@teste.com";
$telefone = "44999999999";
$nascimento = "2002-05-15";
$idade = date_diff(date_create($nascimento), date_create('today'))->y;
$sobre = "Sou estudante de ADS e estou testando o sistema de currículo.";
$endereço = "Rua Sequiser sim mano";


$sql = "INSERT INTO usuarios (nome, email, telefone, nascimento, idade, sobre)
        VALUES ('$nome', '$email', '$telefone', '$nascimento', '$idade', '$sobre')";

if ($conn->query($sql) === TRUE) {
    echo "<h2>✅ Usuário inserido com sucesso!</h2>";
    echo "ID gerado: " . $conn->insert_id;
} else {
    echo "Erro ao inserir: " . $conn->error;
}

$conn->close();
?>