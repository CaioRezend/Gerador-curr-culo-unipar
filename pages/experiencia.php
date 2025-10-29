<?php

session_start();
if (empty($_SESSION['usuarios'])) {
    header("Location: /index.php");
    exit;
}
$caminhoBase = '/GERADOR-CURR-CULO-UNIPAR';
require_once __DIR__ . '/../includes/conexao.php';
require_once __DIR__ . '/../includes/funcoes.php';

$usuario_id = $_SESSION['usuario_id'] ?? null;
?>
<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card p-4">
      <h3>Experiência Profissional</h3>
      <form action="/pages/saveexperiencia.php" method="post">
        <div class="mb-3">
          <label>Cargo</label>
          <input name="cargo" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Empresa</label>
          <input name="empresa" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Período</label>
          <input name="periodo" class="form-control" placeholder="Ex: 2021 - 2023">
        </div>
        <div class="mb-3">
          <label>Descrição</label>
          <textarea name="descricao" class="form-control"></textarea>
        </div>
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" name="atual" id="atual">
          <label class="form-check-label" for="atual">Atualmente trabalho aqui</label>
        </div>
        <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuario_id); ?>">
        <div class="d-flex gap-2">
          <button class="btn btn-dark">Adicionar Experiência</button>
          <a href="<?php echo $caminhoBase ?>/pages/view.php" class="btn btn-outline-secondary">Visualizar Currículo</a>
        </div>
      </form>
    </div>

    <div class="mt-4">
      <h5>Experiências cadastradas</h5>
      <?php
      if ($usuario_id) {
          $stmt = $conn->prepare("SELECT * FROM experiencias WHERE usuario_id = ? ORDER BY criado_em DESC");
          $stmt->bind_param("i", $usuario_id);
          $stmt->execute();
          $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
          if ($rows) {
              foreach ($rows as $r) {
                  echo "<div class='card p-2 mb-2'><strong>" . htmlspecialchars($r['cargo']) . "</strong> — " . htmlspecialchars($r['empresa']) . " <small class='text-muted'>(" . htmlspecialchars($r['periodo']) . ")</small></div>";
              }
          } else {
              echo "<p class='text-muted'>Nenhuma experiência adicionada.</p>";
          }
      } else {
          echo "<p class='text-muted'>Salve seus dados pessoais primeiro.</p>";
      }
      ?>
    </div>

  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
