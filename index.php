<?php
require_once __DIR__ . '/includes/config.php'; 

if (CONFIG_LOADED && ($CONFIG['debug']['enabled'] ?? false)) {

    error_reporting(E_ALL);
    
    if ($CONFIG['debug']['display_errors'] ?? true) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
    }

    if (!empty($CONFIG['app']['timezone'])) {
        date_default_timezone_set($CONFIG['app']['timezone']);
    }

} else {

    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);

    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED); 
}
session_start();
require_once __DIR__ . '/includes/conexao.php';
require_once __DIR__ . '/includes/funcoes.php';

if (isset($_GET['logout']) && $_GET['logout'] == '1') {
    session_destroy();
    header("Location: /index.php");
    exit;
}

$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $user = buscarUsuarioPorLogin($conn, $email);
    if ($user && password_verify($senha, $user['password_hash'])) {
        $_SESSION['user_login_id'] = $user['id'];
        header("Location: /pages/dataUsers.php");
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
      <small class="text-muted">Ainda não tem usuário? Use <code>/addUser.php</code> para criar.</small>
    </div>
  </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
