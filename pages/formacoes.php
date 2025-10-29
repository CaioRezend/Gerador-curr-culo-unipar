<?php
session_start();
if (empty($_SESSION['user_login_id'])) {
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
      <h3>Formação Acadêmica</h3>
      <form action="/pages/saveformacao.php" method="post">
        <div class="mb-3">
          <label>Instituição</label>
          <input name="instituicao" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Curso</label>
          <input name="curso" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Ano de Conclusão</label>
          <input name="ano" class="form-control" type="number" min="1900" max="2100">
        </div>
        <div class="mb-3">
          <label>Descrição (opcional)</label>
          <textarea name="descricao" class="form-control"></textarea>
        </div>
        <input type="hidden" name="usuario_id" value="<?php echo htmlspecialchars($usuario_id); ?>">
        <div class="d-flex gap-2">
          <button class="btn btn-dark">Adicionar Formação</button>
          <a href="<?php echo $caminhoBase;  ?>/pages/experiencia.php" class="btn btn-outline-secondary">Ir para Experiência</a>
        </div>
      </form>
    </div>
    <div class="mt-4">
      <h5>Formações cadastradas</h5>
      <?php
      if ($usuario_id) {
          $stmt = $conn->prepare("SELECT * FROM formacao WHERE user_id = ? ORDER BY criado_em DESC");
          $stmt->bind_param("i", $usuario_id);
          $stmt->execute();
          $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
          if ($rows) {
              foreach ($rows as $r) {
                  echo "<div class='card p-2 mb-2'><strong>" . htmlspecialchars($r['curso']) . "</strong> — " . htmlspecialchars($r['instituicao']) . " (" . htmlspecialchars($r['ano_conclusao']) . ")</div>";
              }
          } else {
              echo "<p class='text-muted'>Nenhuma formação adicionada.</p>";
          }
      } else {
          echo "<p class='text-muted'>Salve seus dados pessoais primeiro.</p>";
      }
      ?>
    </div>

  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
