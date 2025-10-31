<?php

session_start();
if (empty($_SESSION['curriculo_id'])) {
    header("Location: dataUsers.php?erro=curriculo_nao_iniciado");
    exit;
}

require_once '../includes/conexao.php';
require_once '../includes/funcoes.php';


$curriculo_id = $_SESSION['curriculo_id'];
$instituicao = $_POST['instituicao'] ?? null;
$curso       = $_POST['curso'] ?? null;
$ano         = $_POST['data_fim'] ?? null; 
$descricao   = $_POST['descricao'] ?? null;

if (!$instituicao || !$curso || !$ano) {
    header("Location: formacao.php?erro=campos_incompletos");
    exit;
}

$resultado = adicionarFormacao($conn, $curriculo_id, $instituicao, $curso, $ano, $descricao);

if ($resultado) {
    header("Location: formacao.php?sucesso=formacao_salva");
    exit;
} else {
    header("Location: formacao.php?erro=falha_ao_salvar_formacao");
    exit;
}
?>