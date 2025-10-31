<?php

session_start();

require_once '../includes/conexao.php';


$mensagem_status = '';

if (isset($_SESSION['curriculo_id'])) {
  unset($_SESSION['curriculo_id']);
}

if (isset($_SESSION['usuarios'])) {
  unset($_SESSION['usuarios']);
}

if (isset($_GET['erro'])) {
  $erro = $_GET['erro'];
  switch ($erro) {

    case 'falha_ao_salvar_curriculo':
      $mensagem_status = 'Houve um erro ao salvar seus dados de currículo.';
      break;
    case 'campos_incompletos':
      $mensagem_status = 'Por favor, preencha todos os campos obrigatórios.';
      break;
    default:
      $mensagem_status = 'Ocorreu um erro desconhecido.';
  }
} elseif (isset($_GET['sucesso']) && $_GET['sucesso'] == 'dados_salvos') {
  $mensagem_status = 'Dados pessoais salvos com sucesso!';
}
?>
<?php include __DIR__ . '/../includes/header.php'; ?>
<!DOCTYPE html>
<html>

<head>
  <title>Dados Pessoais</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <h2>Criar Novo Currículo</h2>

  <?php if ($mensagem_status): ?>
    <p style="color: red; border: 1px solid red; padding: 10px;"><?php echo htmlspecialchars($mensagem_status); ?></p>
  <?php endif; ?>

  <form action="/GERADOR-CURR-CULO-UNIPAR/pages/saveData.php" method="POST">

    <label for="nome">Nome Completo:</label>
    <input type="text" id="nome" name="nome" required>
    <br>
    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="telefone">Telefone:</label>
    <input type="tel" id="telefone" name="telefone" required>
    <br>
    <br>
    <label for="sobre">Descreva suas qualidades</label>
    <textarea name="sobre" class="form-control"></textarea>
    <br>
    <label for="foto_perfil">Foto de Perfil (Opcional):</label>
    <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*">
    <br>
    <button type="submit">Salvar Dados Pessoais e Continuar</button>
  </form>
</body>

</html>
<?php include __DIR__ . '/../includes/footer.php'; ?>