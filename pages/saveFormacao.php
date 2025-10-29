<?php

session_start();
if (empty($_SESSION['usuarios'])) {
    header("Location: /index.php");
    exit;
}
require_once __DIR__ . '/../includes/conexao.php';
require_once __DIR__ . '/../includes/funcoes.php';

$usuario_id = $_POST['usuarios'] ?? null;
$instituicao = $_POST['instituicao'] ?? '';
$curso = $_POST['curso'] ?? '';
$ano = $_POST['ano'] ?? null;
$descricao = $_POST['descricao'] ?? '';

if (!$usuario_id) {
    die("Usuário não identificado. Volte e salve os dados pessoais primeiro.");
}

if (adicionarFormacao($conn, $usuario_id, $instituicao, $curso, $ano, $descricao)) {
    header("Location: /pages/formacao.php");
    exit;
} else {
    die("Erro ao salvar formação: " . $conn->error);
}
?>
