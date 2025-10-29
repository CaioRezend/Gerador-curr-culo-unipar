<?php

$caminhoBase = '/GERADOR-CURR-CULO-UNIPAR';

session_start();

if (empty($_SESSION['usuarios'])) {
  header("Location: " . $caminhoBase . "/index.php");
  exit;
}

require_once __DIR__ . '/../includes/conexao.php';
require_once __DIR__ . '/../includes/funcoes.php';

$user_login_id = $_SESSION['usuarios'];

$res = buscarDadosPessoaisCurriculo($conn, $user_login_id);

if (!$res) {
  $res = ['user_login_id' => $user_login_id, 'id' => null, 'nome' => '', 'email' => ''];
  $user_auth = buscarUsuarioPorLogin($conn, $user_login_id);
  if ($user_auth) {
    $res['nome'] = $user_auth['nome'] ?? '';
    $res['email'] = $user_auth['email'] ?? '';
  }
}
$conn->close();
?>
<?php include __DIR__ . '/../includes/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card p-4">
      <h3>Dados Pessoais</h3>
      <form action="<?php echo $caminhoBase; ?>/pages/saveData.php" method="post">
        <input type="hidden" name="id" value="<?php echo $res['id'] ?? ''; ?>">
        <input type="hidden" name="user_login_id" value="<?php echo htmlspecialchars($user_login_id); ?>">
        <div class="mb-3">
          <label>Nome</label>
          <input name="nome" class="form-control" required value="<?php echo htmlspecialchars($res['nome'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label>E-mail</label>
          <input name="email" class="form-control" type="email"
            value="<?php echo htmlspecialchars($res['email'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label>Telefone</label>
          <input name="telefone" class="form-control" value="<?php echo htmlspecialchars($res['telefone'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label>Data de Nascimento</label>
          <input name="nascimento" class="form-control" type="date"
            value="<?php echo htmlspecialchars($res['nascimento'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label>Sobre</label>
          <textarea name="sobre" class="form-control"><?php echo htmlspecialchars($res['sobre'] ?? ''); ?></textarea>
        </div>
        <div class="mb-3">
          <label>Endereço</label>
          <input name="endereco" class="form-control" value="<?php echo htmlspecialchars($res['endereco'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label>Cidade</label>
          <input name="cidade" class="form-control" value="<?php echo htmlspecialchars($res['cidade'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label>Estado</label>
          <input name="estado" class="form-control" value="<?php echo htmlspecialchars($res['estado'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label>CEP</label>
          <input name="cep" class="form-control" value="<?php echo htmlspecialchars($res['cep'] ?? ''); ?>">
        </div>
        <div class="d-flex gap-2"><button class="btn btn-dark">Salvar e Continuar</button>
          <a href="<?php echo $caminhoBase; ?>/pages/formacao.php" class="btn btn-outline-secondary">Ir para
            Formação</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>