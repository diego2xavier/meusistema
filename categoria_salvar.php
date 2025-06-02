<?php
$titulo = "Salvar Categoria";
include 'header.php';

$pdo = new PDO('sqlite:backup.db');

$id = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? '';

try {
    if ($id) {
        $stmt = $pdo->prepare("UPDATE categorias SET nome = ? WHERE id = ?");
        $stmt->execute([$nome, $id]);
        $mensagem = "Categoria atualizada com sucesso.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO categorias (nome) VALUES (?)");
        $stmt->execute([$nome]);
        $mensagem = "Categoria cadastrada com sucesso.";
    }
} catch (Exception $e) {
    $mensagem = "Erro ao salvar a categoria: " . $e->getMessage();
}
?>

<div class="container mt-5">
    <div class="alert alert-info">
        <?= $mensagem ?>
    </div>
    <a href="categorias.php" class="btn btn-primary">Voltar para lista de categorias</a>
</div>

<?php include 'footer.php'; ?>
