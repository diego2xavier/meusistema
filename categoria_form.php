<?php
$titulo = "Categoria";
include 'header.php';

$pdo = new PDO('sqlite:backup.db');
$id = $_GET['id'] ?? null;
$categoria = ['nome' => ''];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM categorias WHERE id = ?");
    $stmt->execute([$id]);
    $categoria = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<div class="container mt-5">
    <h1 class="mb-4"><?= $id ? 'Editar' : 'Nova' ?> Categoria</h1>
    <form method="POST" action="categoria_salvar.php" class="border p-4 rounded bg-white shadow-sm">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Categoria</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($categoria['nome']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="categorias.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>

<?php include 'footer.php'; ?>
