<?php
$titulo = "Salvar Fornecedor";
include 'header.php';

$pdo = new PDO('sqlite:backup.db');
$id = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? '';
$contato = $_POST['contato'] ?? '';
$email = $_POST['email'] ?? '';
$cnpj = $_POST['cnpj'] ?? '';

try {
    if ($id) {
        $stmt = $pdo->prepare("UPDATE fornecedores SET nome = ?, contato = ?, email = ?, cnpj = ? WHERE id = ?");
        $stmt->execute([$nome, $contato, $email, $cnpj, $id]);
        $mensagem = "Fornecedor atualizado com sucesso.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO fornecedores (nome, contato, email, cnpj) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $contato, $email, $cnpj]);
        $mensagem = "Fornecedor cadastrado com sucesso.";
    }
} catch (Exception $e) {
    $mensagem = "Erro ao salvar fornecedor: " . $e->getMessage();
}
?>

<div class="alert alert-success mt-4">
  <?= $mensagem ?>
</div>

<a href="fornecedores.php" class="btn btn-primary mt-3">Voltar para lista de fornecedores</a>

<?php include 'footer.php'; ?>
