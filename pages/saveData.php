<?php

session_start(); 
require_once '../includes/conexao.php'; 
require_once '../includes/funcoes.php'; 

$uploadDir = '../uploads/curriculos/';

$foto_caminho = null; 

if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
    
    $arquivoTmp = $_FILES['foto_perfil']['tmp_name'];
    $nomeOriginal = basename($_FILES['foto_perfil']['name']);
    $extensao = pathinfo($nomeOriginal, PATHINFO_EXTENSION);
    $novoNomeArquivo = uniqid('foto_', true) . '.' . $extensao;
    $destino = $uploadDir . $novoNomeArquivo;

    if (move_uploaded_file($arquivoTmp, $destino)) {
        $foto_caminho = $novoNomeArquivo; 
    }
}

$dados = [
    'nome' => $_POST['nome'] ?? null,
    'email' => $_POST['email'] ?? null,
    'telefone' => $_POST['telefone'] ?? null,
    'nascimento' => $_POST['nascimento'] ?? null,
    'sobre' => $_POST['sobre'] ?? null,
    'endereco' => $_POST['endereco'] ?? null,
    'cidade' => $_POST['cidade'] ?? null,
    'estado' => $_POST['estado'] ?? null,
    'cep' => $_POST['cep'] ?? null,
    'foto_caminho' => $foto_caminho,
    'id' => $_POST['id'] ?? null 
];

if (empty($dados['nome']) || empty($dados['email']) || empty($dados['telefone'])) {
    header("Location: dataUsers.php?erro=campos_incompletos");
    exit;
}
$novo_curriculo_id = salvarDadosPessoais($conn, $dados);
if ($novo_curriculo_id) {
    $_SESSION['curriculo_id'] = $novo_curriculo_id;
    header("Location: formacao.php?sucesso=dados_pessoais_salvos");
    exit;
} else {
    header("Location: dataUsers.php?erro=falha_ao_salvar_curriculo");
    exit;
}
?>