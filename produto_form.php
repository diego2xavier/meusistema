<?php
$titulo = "Produto";
include 'header.php';

$pdo = new PDO('sqlite:backup.db');
$id = $_GET['id'] ?? null;
$produto = ['nome'=>'', 'descricao'=>'', 'quantidade'=>'', 'preco'=>'', 'categoria_id'=>''];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);
}

$categorias = $pdo->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h2 class="mb-4"><?= $id ? 'Editar' : 'Novo' ?> Produto</h2>

    <form method="POST" action="produto_salvar.php">
        <input type="hidden" name="id" value="<?= $id ?>">

        <div class="mb-3">
            <label class="form-label">Nome:</label>
            <input name="nome" class="form-control" value="<?= htmlspecialchars($produto['nome']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descrição:</label>
            <input name="descricao" class="form-control" value="<?= htmlspecialchars($produto['descricao']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Quantidade:</label>
            <input type="number" name="quantidade" class="form-control" value="<?= htmlspecialchars($produto['quantidade']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Preço:</label>
            <input type="number" step="0.01" name="preco" class="form-control" value="<?= htmlspecialchars($produto['preco']) ?>" required>
        </div>

        <div class="mb-4">
            <label class="form-label">Categoria:</label>
            <select name="categoria_id" class="form-select" required>
                <option value="">Selecione...</option>
                <?php foreach ($categorias as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= $produto['categoria_id'] == $c['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="produtos.php" class="btn btn-secondary">Voltar para lista</a>
    </form>
</div>

<?php include 'footer.php'; ?>

