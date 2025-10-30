<?php
// Inicia a sessão para verificar o status do login
session_start();

// Inclui arquivos essenciais
require_once '../includes/conexao.php'; // Certifique-se de que a conexão ($conn) está aqui
require_once '../includes/funcoes.php'; // Suas funções (incluindo buscarDadosPessoaisCurriculo)

// ----------------------------------------------------
// 1. Definição do Status de Login e ID
// ----------------------------------------------------
$user_id = $_SESSION['user_id'] ?? null;
$is_logged_in = !empty($user_id);

// ----------------------------------------------------
// 2. Carregamento de Dados (Para pré-preenchimento ou visualização)
// ----------------------------------------------------

$curriculo_id = null;
$dados_curriculo = [];
$nome_inicial = '';
$email_inicial = '';
$telefone_inicial = '';
// ... (inicialize aqui todas as variáveis que você usa no seu formulário)

if ($is_logged_in) {
    // Se logado: Tenta carregar os dados pessoais do currículo
    $dados_curriculo = buscarDadosPessoaisCurriculo($conn, $user_id);
    $dados_login = buscarUsuarioPorLogin($conn, $_SESSION['user_email'] ?? '');
    
    // Prioriza dados do Login para Nome/Email, se disponíveis
    $nome_inicial = $dados_login['nome'] ?? '';
    $email_inicial = $dados_login['email'] ?? '';
    
    if ($dados_curriculo) {
        // Se já tem currículo, usa esses dados para pré-preencher
        $curriculo_id = $dados_curriculo['id'];
        $telefone_inicial = $dados_curriculo['telefone'] ?? $telefone_inicial;
        $nome_inicial = $dados_curriculo['nome'] ?? $nome_inicial;
        $email_inicial = $dados_curriculo['email'] ?? $email_inicial;
        // ... (atribua aqui todos os outros campos do currículo)
    }
} 
// Se NÃO logado: Todas as variáveis de pré-preenchimento permanecem vazias ('')

// ----------------------------------------------------
// 3. Exibição de Mensagens de Erro ou Sucesso
// ----------------------------------------------------
$mensagem_status = '';

if (isset($_GET['erro'])) {
    $erro = $_GET['erro'];
    // Tratamento das mensagens de erro enviadas pelo save_dados_pessoais.php
    switch ($erro) {
        case 'campos_registro_ausentes':
            $mensagem_status = 'Por favor, preencha Nome, Email e Senha para criar sua conta.';
            break;
        case 'email_ja_cadastrado':
            $mensagem_status = 'Este e-mail já está cadastrado. Tente fazer login ou use outro e-mail.';
            break;
        case 'falha_registro':
            $mensagem_status = 'Ocorreu uma falha ao criar sua conta. Tente novamente.';
            break;
        case 'falha_ao_salvar_curriculo':
            $mensagem_status = 'Houve um erro ao salvar seus dados de currículo.';
            break;
        default:
            $mensagem_status = 'Ocorreu um erro desconhecido.';
    }
} elseif (isset($_GET['sucesso']) && $_GET['sucesso'] == 'dados_salvos') {
    $mensagem_status = 'Dados pessoais salvos com sucesso!';
}

// Nota: Use a classe CSS 'alerta-erro' ou similar no seu HTML para exibir $mensagem_status
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