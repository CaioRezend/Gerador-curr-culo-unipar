<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$caminhoBase = "/GERADOR-CURR-CULO-UNIPAR"
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gerador de Currículo - UNIPAR</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="/index.php">Currículo UNIPAR</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <?php if (!empty($_SESSION['user_login_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="/GERADOR-CURR-CULO-UNIPAR/pages/dados-pessoais.php">Dados</a></li>
          <li class="nav-item"><a class="nav-link" href="/GERADOR-CURR-CULO-UNIPAR/pages/formacao.php">Formação</a></li>
          <li class="nav-item"><a class="nav-link" href="/GERADOR-CURR-CULO-UNIPAR/pages/experiencia.php">Experiência</a></li>
          <li class="nav-item"><a class="nav-link" href="/GERADOR-CURR-CULO-UNIPAR/pages/visualizar.php">Visualizar</a></li>
          <li class="nav-item"><a class="nav-link text-danger" href="/GERADOR-CURR-CULO-UNIPAR/index.php?logout=1">Sair</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="/GERADOR-CURR-CULO-UNIPAR/index.php">Entrar</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<main class="container my-4">
