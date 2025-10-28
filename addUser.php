<?php
include('includes/conexao.php');

$nome = "sim";
$email = "sim@gmail.com";
$senha = password_hash("cafecomleite", PASSWORD_DEFAULT);

$check = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('E-mail já cadastrado! Tente outro.'); window.location='cadastro.php';</script>";
    $check->close();
    $conn->close();
    exit;
}

$check->close();

$stmt = $conn->prepare("INSERT INTO usuarios (nome, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $senha);

if ($stmt->execute()) {
    echo "<script>alert('Usuário cadastrado com sucesso!'); window.location='login.php';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar!'); window.location='cadastro.php';</script>";
}

$stmt->close();
$conn->close();
?>
