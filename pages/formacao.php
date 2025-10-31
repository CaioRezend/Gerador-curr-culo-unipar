<?php
session_start();

if (empty($_SESSION['curriculo_id'])) {
    header("Location: " . $caminhoBase . "/index.php?erro=curriculo_nao_iniciado");
    exit;
}

require_once __DIR__ . '/../includes/conexao.php';
require_once __DIR__ . '/../includes/funcoes.php';

$curriculo_id = $_SESSION['curriculo_id'] ?? null; 
?>

<?php include __DIR__ . '/../includes/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-4">
            <h3>Formação Acadêmica</h3>      
            <form action="/GERADOR-CURR-CULO-UNIPAR/pages/saveFormacao.php" method="post">
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
                    <input name="data_fim" class="form-control" type="number" min="1900" max="2100" required>
                </div>
                <div class="mb-3">
                    <label>Descrição (opcional)</label>
                    <textarea name="descricao" class="form-control"></textarea>
                </div>
                <input type="hidden" name="curriculo_id" value="<?php echo htmlspecialchars($curriculo_id); ?>">
                <div class="d-flex gap-2">
                    <button class="btn btn-dark">Adicionar Formação</button>
                    <a href="/GERADOR-CURR-CULO-UNIPAR/pages/experiencia.php" class="btn btn-outline-secondary">Ir para Experiência</a>
                </div>
            </form>
        </div>
        <div class="mt-4">
            <h5>Formações cadastradas</h5>
            <?php
            if ($curriculo_id) {
                $stmt = $conn->prepare("SELECT * FROM formacao WHERE curriculo_id = ? ORDER BY data_fim DESC");
                $stmt->bind_param("i", $curriculo_id);
                $stmt->execute();
                $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                
                if ($rows) {
                    foreach ($rows as $r) {
                        echo "<div class='card p-2 mb-2'><strong>" . htmlspecialchars($r['curso']) . "</strong> — " . htmlspecialchars($r['instituicao']) . " (" . htmlspecialchars($r['data_fim']) . ")</div>";
                    }
                } else {
                    echo "<p class='text-muted'>Nenhuma formação adicionada.</p>";
                }
            } else {
                echo "<p class='text-muted'>ID do currículo não encontrado. Por favor, comece novamente.</p>";
            }
            ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>