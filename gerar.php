<?php
include('includes/conexao.php'); // importa a conexão com o banco

// Recebe os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$nascimento = $_POST['nascimento'];
$sobre = $_POST['sobre'];

// Calcula idade automaticamente (se quiser)
$idade = date_diff(date_create($nascimento), date_create('today'))->y;

// Grava no banco
$sql = "INSERT INTO usuarios (nome, email, telefone, nascimento, idade, sobre)
        VALUES ('$nome', '$email', '$telefone', '$nascimento', '$idade', '$sobre')";

if ($conn->query($sql) === TRUE) {
    $ultimo_id = $conn->insert_id; // ID do usuário recém-criado
} else {
    die("Erro ao salvar: " . $conn->error);
}

// Exibe o currículo gerado
?>

<?php include('includes/header.php'); ?>

<div class="container mt-4">
  <h1>Currículo de <?php echo $nome; ?></h1>
  <p><strong>Email:</strong> <?php echo $email; ?></p>
  <p><strong>Telefone:</strong> <?php echo $telefone; ?></p>
  <p><strong>Data de nascimento:</strong> <?php echo date('d/m/Y', strtotime($nascimento)); ?></p>
  <p><strong>Idade:</strong> <?php echo $idade; ?> anos</p>
  <p><strong>Sobre:</strong> <?php echo nl2br($sobre); ?></p>
</div>

<button onclick="window.print()">Baixar Currículo</button>

<?php include('includes/footer.php'); ?>