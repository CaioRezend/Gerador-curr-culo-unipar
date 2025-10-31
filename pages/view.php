<?php

session_start();

$caminhoBase = '/GERADOR-CURR-CULO-UNIPAR';

if (empty($_SESSION['curriculo_id'])) {
  header("Location: " . $caminhoBase . "/dataUsers.php?erro=curriculo_nao_iniciado");
  exit;
}

require_once __DIR__ . '/../includes/conexao.php';
require_once __DIR__ . '/../includes/funcoes.php';

$curriculo_id = $_SESSION['curriculo_id'];
$data = buscarCurriculo($conn, $curriculo_id);
$dados_pessoais = $data['dados_pessoais'] ?? [];
$formacao = $data['formacoes'] ?? [];
$experiencias = $data['experiencias'] ?? [];
$baseUpload = $caminhoBase . '/uploads/curriculos/';
$fotoUrl = isset($dados_pessoais['foto_caminho']) && $dados_pessoais['foto_caminho']
  ? $baseUpload . $dados_pessoais['foto_caminho']
  : $caminhoBase . '/assets/img/profile.png';

if (!$dados_pessoais) {
  header("Location: " . $caminhoBase . "/dataUsers.php?erro=dados_nao_encontrados");
  exit;
}
?>
<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="card p-4 mx-auto shadow-lg" style="max-width:1200px;">
  <div class="row">
    <div class="col-md-4 text-center bg-dark text-white rounded-3 p-4">
      <img src="<?php echo htmlspecialchars($fotoUrl); ?>" alt="Foto de Perfil"
        class="img-fluid rounded-circle mb-3 border border-3 border-white"
        style="width:150px; height:150px; object-fit: cover;">

      <h3 class="mb-0 mt-2 text-uppercase"><?php echo htmlspecialchars($dados_pessoais['nome'] ?? 'Nome Completo'); ?>
      </h3>

      <div class="mt-3 text-start px-3">
        <p class="mb-1"><i
            class="bi bi-envelope-fill me-2"></i><?php echo htmlspecialchars($dados_pessoais['email'] ?? 'E-mail'); ?>
        </p>
        <p class="mb-1"><i
            class="bi bi-phone-fill me-2"></i><?php echo htmlspecialchars($dados_pessoais['telefone'] ?? 'Telefone'); ?>
        </p>

        <p class="mb-1">
          <i class="bi bi-geo-alt-fill me-2"></i>
          <small>
            <?php
            $partes = [];
            if (!empty($dados_pessoais['endereco']))
              $partes[] = htmlspecialchars($dados_pessoais['endereco']);
            if (!empty($dados_pessoais['cidade']))
              $partes[] = htmlspecialchars($dados_pessoais['cidade']);

            $estado_cep = [];
            if (!empty($dados_pessoais['estado']))
              $estado_cep[] = htmlspecialchars($dados_pessoais['estado']);
            if (!empty($dados_pessoais['cep']))
              $estado_cep[] = htmlspecialchars($dados_pessoais['cep']);

            if (!empty($estado_cep)) {
              $partes[] = implode(" / ", $estado_cep);
            }

            if (!empty($partes)) {
              echo implode(", ", $partes);
            } else {
              echo "Endereço não informado.";
            }
            ?>
          </small>
        </p>
      </div>
    </div>
    <div class="col-md-8 p-4">

      <h4 class="text-primary border-bottom pb-1">Sobre Mim</h4>
      <p class="text-justify">
        <?php echo nl2br(htmlspecialchars($dados_pessoais['sobre'] ?? 'Aguardando descrição pessoal...')); ?></p>

      <h4 class="text-primary border-bottom pb-1 mt-4">Formação Acadêmica</h4>
      <?php if (!empty($formacao)): ?>
        <?php foreach ($formacao as $f): ?>
          <div class="mb-3">
            <strong><?php echo htmlspecialchars($f['curso'] ?? 'Curso sem nome'); ?></strong>
            <span class="text-muted float-end">
              (<?php echo htmlspecialchars($f['data_fim'] ?? $f['ano_conclusao'] ?? 'Atual'); ?>)
            </span>
            <br><span class="text-secondary"><?php echo htmlspecialchars($f['instituicao'] ?? 'Instituição'); ?></span>
            <p class="mt-1 small text-muted"><?php echo nl2br(htmlspecialchars($f['descricao'] ?? '')); ?></p>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-muted">Nenhuma formação cadastrada.</p>
      <?php endif; ?>

      <h4 class="text-primary border-bottom pb-1 mt-4">Experiência Profissional</h4>
      <?php if (!empty($experiencias)): ?>
        <?php foreach ($experiencias as $e): ?>
          <div class="mb-3">
            <strong><?php echo htmlspecialchars($e['cargo'] ?? 'Cargo'); ?></strong> —
            <?php echo htmlspecialchars($e['empresa'] ?? 'Empresa'); ?>

            <span class="text-muted float-end small">
              <?php

              $data_fim = (isset($e['atual']) && $e['atual'] == 1) ? 'Atual' : htmlspecialchars($e['data_fim'] ?? 'Fim');
              echo htmlspecialchars($e['data_inicio'] ?? 'Início') . ' - ' . $data_fim;
              ?>
            </span>

            <br><?php echo nl2br(htmlspecialchars($e['descricao'] ?? '')); ?>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="text-muted">Nenhuma experiência cadastrada.</p>
      <?php endif; ?>

      <button class="btn btn-outline-primary mt-4" onclick="window.print()">
        <i class="bi bi-printer-fill me-2"></i> Baixar / Imprimir
      </button>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>