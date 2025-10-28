<?php

session_start();
if (empty($_SESSION['user_login_id'])) {
    header("Location: /index.php");
    exit;
}
require_once __DIR__ . '/../includes/conexao.php';
require_once __DIR__ . '/../includes/funcoes.php';

$usuario_id = $_SESSION['usuario_id'] ?? null;
if (!$usuario_id) {
    die("Nenhum currículo encontrado. Preencha os dados primeiro.");
}

$data = buscarCurriculo($conn, $usuario_id);
$u = $data['usuario'];
$formacoes = $data['formacoes'];
$exp = $data['experiencias'];
?>
<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="card p-4 mx-auto" style="max-width:1000px;">
  <div class="row">
    <div class="col-md-4 text-center bg-dark text-white rounded-3 p-3">
      <img src="/assets/img/profile.png" alt="Foto" class="img-fluid rounded-circle mb-3" width="120">
      <h3><?php echo htmlspecialchars($u['nome']); ?></h3>
      <p><?php echo htmlspecialchars($u['email']); ?></p>
      <p><?php echo htmlspecialchars($u['telefone']); ?></p>
    </div>
    <div class="col-md-8 p-4">
      <h4>Sobre</h4>
      <p><?php echo nl2br(htmlspecialchars($u['sobre'])); ?></p>

      <h4>Formação</h4>
      <?php if ($formacoes): ?>
        <?php foreach ($formacoes as $f): ?>
          <p><strong><?php echo htmlspecialchars($f['curso']); ?></strong> — <?php echo htmlspecialchars($f['instituicao']); ?> (<?php echo htmlspecialchars($f['ano_conclusao']); ?>)</p>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-muted">Nenhuma formação cadastrada.</p>
      <?php endif; ?>

      <h4>Experiência</h4>
      <?php if ($exp): ?>
        <?php foreach ($exp as $e): ?>
          <p><strong><?php echo htmlspecialchars($e['cargo']); ?></strong> — <?php echo htmlspecialchars($e['empresa']); ?> <small class="text-muted">(<?php echo htmlspecialchars($e['periodo']); ?>)</small><br><?php echo nl2br(htmlspecialchars($e['descricao'])); ?></p>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-muted">Nenhuma experiência cadastrada.</p>
      <?php endif; ?>

      <button class="btn btn-outline-dark mt-3" onclick="window.print()">Baixar / Imprimir</button>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
