<?php
session_start();
$caminhoBase = '/GERADOR-CURR-CULO-UNIPAR';
require_once __DIR__ . '/includes/conexao.php';
require_once __DIR__ . '/includes/funcoes.php';

if (isset($_GET['logout']) && $_GET['logout'] == '1') {
  session_destroy();
  header("Location: " . $caminhoBase . "/index.php");
  exit;
}
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'] ?? '';
  $senha = $_POST['senha'] ?? '';
  $user = buscarUsuarioPorLogin($conn, $email);
  if ($user && password_verify($senha, $user['password'])) {
    $_SESSION['usuarios'] = $user['id'];
    header("Location: " . $caminhoBase . "/pages/dataUsers.php");
    exit;
  } else {
    $erro = "E-mail ou senha inválidos.";
  }
}
?>
<?php include __DIR__ . '/includes/header.php'; ?>
<div class="row justify-content-center">
  <div class="col-md-6">
    <div class="card p-4 shadow-sm">
      <h3 class="mb-3">Login</h3>
      <?php if ($erro): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
      <?php endif; ?>
      <form method="post" action="">
        <div class="mb-3">
          <label class="form-label">E-mail</label>
          <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Senha</label>
          <input type="password" name="senha" class="form-control" required>
        </div>
        <button class="btn btn-dark w-100">Entrar</button>
      </form>
      <hr>
      <small class="text-muted">
        Ainda não tem usuário?
        <a href="<?php echo $caminhoBase; ?>/pages/dataUsers.php">Clique aqui para criar</a>.
      </small>
    </div>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
