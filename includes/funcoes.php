<?php
// includes/funcoes.php
// Funções para gerenciamento do Currículo

/**
 * Busca os dados pessoais de currículo pelo ID do currículo.
 * @param mysqli $conn Objeto de conexão MySQLi.
 * @param int $curriculo_id ID do currículo (PK da tabela 'dados_pessoais').
 * @return array|null Dados pessoais do currículo ou null.
 */
function buscarDadosPessoais($conn, $curriculo_id) {
    $sql = "SELECT * FROM dados_pessoais WHERE id = ?"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $curriculo_id);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res->fetch_assoc();
}

function salvarDadosPessoais($conn, $dados) {

    $foto_caminho = $dados['foto_caminho'] ?? NULL;
    if (!empty($dados['id'])) {
        $sql = "UPDATE dados_pessoais SET nome=?, email=?, telefone=?, nascimento=?, sobre=?, endereco=?, cidade=?, estado=?, cep=?, foto_caminho=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssi", 
            $dados['nome'],$dados['email'],$dados['telefone'],$dados['nascimento'],
            $dados['sobre'],$dados['endereco'],$dados['cidade'],$dados['estado'],$dados['cep'],
            $foto_caminho,
            $dados['id']
        );
        return $stmt->execute();

    } else {
        $sql = "INSERT INTO dados_pessoais (nome, email, telefone, nascimento, sobre, endereco, cidade, estado, cep, foto_caminho)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssss", 
            $dados['nome'],$dados['email'],$dados['telefone'],$dados['nascimento'],
            $dados['sobre'],$dados['endereco'],$dados['cidade'],$dados['estado'],$dados['cep'],
            $foto_caminho 
        );
        if ($stmt->execute()) {
            return $conn->insert_id; 
        }
        return false;
    }
}


/**
 * Adiciona uma formação acadêmica.
 * @param int $curriculo_id 
 */
function adicionarFormacao($conn, $curriculo_id, $instituicao, $curso, $ano, $descricao) {
    $sql = "INSERT INTO formacao (curriculo_id, instituicao, curso, data_fim, descricao)
             VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issis", $curriculo_id, $instituicao, $curso, $ano, $descricao);
    
    return $stmt->execute(); 
}

/**
 * Adiciona uma experiência profissional.
 * @param int $curriculo_id ID do currículo (PK de dados_pessoais).
 */
function adicionarExperiencia($conn, $curriculo_id, $cargo, $empresa, $periodo, $descricao, $atual = 0) {
    $sql = "INSERT INTO experiencias (curriculo_id, cargo, empresa, data_inicio, descricao, atual)
             VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssi", $curriculo_id, $cargo, $empresa, $periodo, $descricao, $atual);
    return $stmt->execute();
}


/**
 * Busca todos os dados necessários para montar o currículo final.
 * @param int $curriculo_id ID do currículo (PK da tabela 'dados_pessoais').
 */
function buscarCurriculo($conn, $curriculo_id) {
    $out = [];

    $out['dados_pessoais'] = buscarDadosPessoais($conn, $curriculo_id);

    if (!$out['dados_pessoais']) {
        return $out;
    }
    $stmt = $conn->prepare("SELECT * FROM formacao WHERE curriculo_id = ? ORDER BY data_fim DESC");
    $stmt->bind_param("i", $curriculo_id);
    $stmt->execute();
    $out['formacoes'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $stmt = $conn->prepare("SELECT * FROM experiencias WHERE curriculo_id = ? ORDER BY criado_em DESC");
    $stmt->bind_param("i", $curriculo_id);
    $stmt->execute();
    $out['experiencias'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    return $out;
} 
?>