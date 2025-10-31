<?php
// index.php

// Inicia a sessão APENAS se você for usá-la para armazenar o ID do currículo.
// Se você não iniciar a sessão, o saveData.php não conseguirá armazenar o ID.
// É melhor manter a sessão, mas agora ela serve para o CURRÍCULO, não para o USUÁRIO.
session_start();

// O objetivo é levar o usuário diretamente para a primeira tela de dados
// O caminho deve ser ajustado com base na sua estrutura de pastas.
// Se 'index.php' está na raiz e 'dataUsers.php' está em 'pages/', o caminho é este:

header("Location: pages/dataUsers.php");
exit;

// Se você quisesse uma página de boas-vindas simples, o código seria:
/*
?>
<!DOCTYPE html>
<html>
<head>
    <title>Gerador de Currículos</title>
</head>
<body>
    <h1>Bem-vindo ao Gerador de Currículos!</h1>
    <p>Clique <a href="pages/dataUsers.php">aqui</a> para começar.</p>
</body>
</html>
<?php
*/
// Mas o redirecionamento imediato é mais limpo.
?>