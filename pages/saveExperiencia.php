<?php

session_start();

if (empty($_SESSION['curriculo_id'])) {
    header("Location: dataUsers.php?erro=curriculo_nao_iniciado");
    exit;
}

require_once '../includes/conexao.php';
require_once '../includes/funcoes.php';

$curriculo_id = $_SESSION['curriculo_id'];
$cargo       = $_POST['cargo'] ?? null;
$empresa     = $_POST['empresa'] ?? null;
$data_inicio     = $_POST['data_inicio'] ?? null; 
$descricao   = $_POST['descricao'] ?? null;
$atual       = isset($_POST['atual']) ? 1 : 0; 

if (!$cargo || !$empresa || !$data_inicio) {
    header("Location: experiencia.php?erro=campos_incompletos");
    exit;
}

$resultado = adicionarExperiencia($conn, $curriculo_id, $cargo, $empresa, $periodo, $descricao, $atual);

if ($resultado) {
    header("Location: experiencia.php?sucesso=experiencia_salva"); 
    exit;
} else {
    header("Location: experiencia.php?erro=falha_ao_salvar_experiencia");
    exit;
}
?>