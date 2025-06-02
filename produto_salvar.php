<?php
$titulo = "Salvar Produto";
include 'header.php';

$pdo = new PDO('sqlite:backup.db');

$id = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$quantidade = $_POST['quantidade'] ?? 0;
$preco = $_POST['preco'] ?? 0;
$categoria_id = $_POST['categoria_id'] ?? null;

try {
    if ($id) {
        $sql = "UPDATE produtos SET nome = ?, descricao = ?, quantidade = ?, preco = ?, categoria_id = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $descricao, $quantidade, $preco, $categoria_id, $id]);
        $mensagem = "Produto atualizado com sucesso.";
    } else {
        $sql = "INSERT INTO produtos (nome, descricao, quantidade, preco, categoria_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nome, $descricao, $quantidade, $preco, $categoria_id]);
        $mensagem = "Produto cadastrado com sucesso.";
    }
} catch (Exception $e) {
    $mensagem = "Erro ao salvar o produto: " . $e->getMessage();
}
?>

<div class="container mt-5">
    <div class="alert alert-info">
        <?= $mensagem ?>
    </div>
    <a href="produtos.php" class="btn btn-primary">Voltar para lista de produtos</a>
</div>

<?php include 'footer.php'; ?>
