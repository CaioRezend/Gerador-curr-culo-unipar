<?php
// Define o caminho base da aplicação para redirecionamentos seguros
$caminhoBase = '/GERADOR-CURR-CULO-UNIPAR';

session_start();

// ------------------------------------------------------------------
// ** CORREÇÃO 1: Verificação correta da variável de sessão **
// A sessão de login é 'usuarios', conforme definido no index.php.
if (empty($_SESSION['usuarios'])) {
    // Redireciona de volta para o login usando o caminho base correto
    header("Location: " . $caminhoBase . "/index.php");
    exit;
}
// ------------------------------------------------------------------

require_once __DIR__ . '/../includes/conexao.php';
require_once __DIR__ . '/../includes/funcoes.php';

// Atribui a ID do usuário logado para a variável local
$user_id_logado = $_SESSION['usuarios'];

// ------------------------------------------------------------------
// ** CORREÇÃO 2: Busca correta no banco de dados **
// Buscar o registro onde o campo 'id' (PK) é igual à ID salva na sessão.
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
// Se a coluna é 'id' e é um inteiro, o tipo é "i" (integer)
$stmt->bind_param("i", $user_id_logado); 
$stmt->execute();
$res = $stmt->get_result()->fetch_assoc();
// ------------------------------------------------------------------
?>
<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="row justify-content-center">
  <div class="col-md-8">
    <div class="card p-4">
      <h3>Dados Pessoais</h3>
      
      <!-- ** CORREÇÃO 3: Uso do $caminhoBase no FORM e links ** -->
      <form action="<?php echo $caminhoBase; ?>/pages/saveData.php" method="post">
        
        <input type="hidden" name="id" value="<?php echo $res['id'] ?? ''; ?>">
        
        <div class="mb-3">
          <label>Nome</label>
          <input name="nome" class="form-control" required value="<?php echo htmlspecialchars($res['nome'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label>E-mail</label>
          <input name="email" class="form-control" type="email" value="<?php echo htmlspecialchars($res['email'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label>Telefone</label>
          <input name="telefone" class="form-control" value="<?php echo htmlspecialchars($res['telefone'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label>Data de Nascimento</label>
          <input name="nascimento" class="form-control" type="date" value="<?php echo htmlspecialchars($res['nascimento'] ?? ''); ?>">
        </div>
        <div class="mb-3">
          <label>Sobre</label>
          <textarea name="sobre" class="form-control"><?php echo htmlspecialchars($res['sobre'] ?? ''); ?></textarea>
        </div>
        <div class="mb-3">
          <label>Endereço</label>
          <input name="endereco" class="form-control" value="<?php echo htmlspecialchars($res['endereco'] ?? ''); ?>">
        </div>
        <div class="d-flex gap-2">
          <button class="btn btn-dark">Salvar e Continuar</button>
          <!-- ** CORREÇÃO 3: Uso do $caminhoBase no link de navegação ** -->
          <a href="<?php echo $caminhoBase; ?>/pages/formacoes.php" class="btn btn-outline-secondary">Ir para Formação</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
