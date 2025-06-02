<?php
$pdo = new PDO('sqlite:backup.db');
$id = $_GET['id'] ?? null;
$entrada = ['produto_id'=>'', 'quantidade'=>'', 'data'=>'', 'fornecedor_id'=>''];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM entradas_estoque WHERE id = ?");
    $stmt->execute([$id]);
    $entrada = $stmt->fetch(PDO::FETCH_ASSOC);
}

$produtos = $pdo->query("SELECT id, nome FROM produtos")->fetchAll(PDO::FETCH_ASSOC);
$fornecedores = $pdo->query("SELECT id, nome FROM fornecedores")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= $id ? 'Editar' : 'Nova' ?> Entrada no Estoque</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4"><?= $id ? 'Editar' : 'Nova' ?> Entrada no Estoque</h1>

    <form method="POST" action="entrada_salvar.php" class="needs-validation" novalidate>
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

        <div class="mb-3">
            <label for="produto_id" class="form-label">Produto</label>
            <select id="produto_id" name="produto_id" class="form-select" required>
                <option value="">Selecione...</option>
                <?php foreach ($produtos as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= $entrada['produto_id'] == $p['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                Por favor, selecione um produto.
            </div>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input
                type="number"
                id="quantidade"
                name="quantidade"
                class="form-control"
                value="<?= htmlspecialchars($entrada['quantidade']) ?>"
                required
                min="1"
            />
            <div class="invalid-feedback">
                Informe uma quantidade válida.
            </div>
        </div>

        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input
                type="date"
                id="data"
                name="data"
                class="form-control"
                value="<?= htmlspecialchars($entrada['data']) ?>"
                required
            />
            <div class="invalid-feedback">
                Informe uma data válida.
            </div>
        </div>

        <div class="mb-3">
            <label for="fornecedor_id" class="form-label">Fornecedor</label>
            <select id="fornecedor_id" name="fornecedor_id" class="form-select" required>
                <option value="">Selecione...</option>
                <?php foreach ($fornecedores as $f): ?>
                    <option value="<?= $f['id'] ?>" <?= $entrada['fornecedor_id'] == $f['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($f['nome']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                Por favor, selecione um fornecedor.
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="entradas_estoque.php" class="btn btn-secondary ms-2">Voltar para lista</a>
    </form>
</div>

<script>
// Exemplo de JavaScript para ativar feedback de validação do Bootstrap
(() => {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

