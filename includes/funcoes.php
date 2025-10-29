<?php
// includes/funcoes.php
// funções reutilizáveis (usa $conn da conexao.php)

function buscarUsuarioPorLogin($conn, $email) {
    $sql = "SELECT id, nome, email, password FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res->fetch_assoc();
}

/**
 * Busca os dados pessoais de currículo associados a um usuário de login.
 * @param mysqli $conn Objeto de conexão MySQLi.
 * @param int $user_login_id ID do usuário logado (da tabela 'usuarios').
 * @return array|null Dados pessoais do currículo ou null.
 */
function buscarDadosPessoaisCurriculo($conn, $user_login_id) {
    $sql = "SELECT * FROM dados_pessoais WHERE user_login_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_login_id);
    $stmt->execute();
    $res = $stmt->get_result();
    return $res->fetch_assoc();
}


function salvarDadosPessoais($conn, $dados) {
    if (!empty($dados['id'])) {
        $sql = "UPDATE dados_pessoais SET nome=?, email=?, telefone=?, nascimento=?, sobre=?, endereco=?, cidade=?, estado=?, cep=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssi",
            $dados['nome'],$dados['email'],$dados['telefone'],$dados['nascimento'],
            $dados['sobre'],$dados['endereco'],$dados['cidade'],$dados['estado'],$dados['cep'],$dados['id']);
        return $stmt->execute();
    } else {
        $sql = "INSERT INTO dados_pessoais (user_login_id, nome, email, telefone, nascimento, sobre, endereco, cidade, estado, cep)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssssssss",
            $dados['user_login_id'],$dados['nome'],$dados['email'],$dados['telefone'],$dados['nascimento'],
            $dados['sobre'],$dados['endereco'],$dados['cidade'],$dados['estado'],$dados['cep']);
        
        if ($stmt->execute()) {
            return $conn->insert_id;
        }
        return false;
    }
}

function adicionarFormacao($conn, $usuario_id, $instituicao, $curso, $ano, $descricao) {
    $sql = "INSERT INTO formacoes (usuario_id, instituicao, curso, ano_conclusao, descricao)
             VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issis", $usuario_id, $instituicao, $curso, $ano, $descricao);
    return $stmt->execute();
}

function adicionarExperiencia($conn, $usuario_id, $cargo, $empresa, $periodo, $descricao, $atual = 0) {
    $sql = "INSERT INTO experiencias (usuario_id, cargo, empresa, periodo, descricao, atual)
             VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssi", $usuario_id, $cargo, $empresa, $periodo, $descricao, $atual);
    return $stmt->execute();
}

function buscarCurriculo($conn, $user_login_id) {
    $out = [];
    
    $out['dados_pessoais'] = buscarDadosPessoaisCurriculo($conn, $user_login_id);

    if (!$out['dados_pessoais']) {
 
        return $out;
    }

    $stmt = $conn->prepare("SELECT * FROM formacoes WHERE usuario_id = ? ORDER BY criado_em DESC");
    $stmt->bind_param("i", $user_login_id);
    $stmt->execute();
    $out['formacoes'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $stmt = $conn->prepare("SELECT * FROM experiencias WHERE usuario_id = ? ORDER BY criado_em DESC");
    $stmt->bind_param("i", $user_login_id);
    $stmt->execute();
    $out['experiencias'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    return $out;
} 
?>
