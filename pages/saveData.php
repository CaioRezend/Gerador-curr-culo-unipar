<?php

session_start();
if (empty($_SESSION['user_login_id'])) {
    header("Location: /index.php");
    exit;
}
require_once __DIR__ . '/../includes/conexao.php';
require_once __DIR__ . '/../includes/funcoes.php';

$user_login_id = $_SESSION['user_login_id'];
$id = $_POST['id'] ?? null;

$dados = [
    'id' => $id,
    'user_login_id' => $user_login_id,
    'nome' => $_POST['nome'] ?? '',
    'email' => $_POST['email'] ?? '',
    'telefone' => $_POST['telefone'] ?? '',
    'nascimento' => $_POST['nascimento'] ?? null,
    'sobre' => $_POST['sobre'] ?? null,
    'endereco' => $_POST['endereco'] ?? null,
    'cidade' => $_POST['cidade'] ?? null,
    'estado' => $_POST['estado'] ?? null,
    'cep' => $_POST['cep'] ?? null
];

$result = salvarDadosPessoais($conn, $dados);
if ($result === false) {
    die("Erro ao salvar: " . $conn->error);
}

if (!$id) {

    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE user_login_id = ? ORDER BY data_registro DESC LIMIT 1");
    $stmt->bind_param("i", $user_login_id);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    $_SESSION['usuario_id'] = $row['id'] ?? null;
} else {
    $_SESSION['usuario_id'] = $id;
}

header("Location: /pages/formacao.php");
exit;
?>
