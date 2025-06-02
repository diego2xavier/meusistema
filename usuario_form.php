<?php
include 'verifica_admin.php';

$pdo = new PDO('sqlite:backup.db');

$id = $_GET['id'] ?? null;
$usuario = ['nome'=>'', 'email'=>'', 'tipo'=>''];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Se vier dados antigos após erro de validação, usa para preencher o form
if (isset($_SESSION['old'])) {
    $usuario = $_SESSION['old'];
    unset($_SESSION['old']);
}

$errors = $_SESSION['errors'] ?? null;
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title><?= $id ? 'Editar' : 'Novo' ?> Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4"><?= $id ? 'Editar' : 'Novo' ?> Usuário</h1>

    <?php if ($errors): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="usuario_salvar.php" class="needs-validation" novalidate>
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" required
                value="<?= htmlspecialchars($usuario['nome']) ?>">
            <div class="invalid-feedback">Por favor, informe o nome.</div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required
                value="<?= htmlspecialchars($usuario['email']) ?>">
            <div class="invalid-feedback">Informe um email válido.</div>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select id="tipo" name="tipo" class="form-select" required>
                <option value="">Selecione...</option>
                <option value="admin" <?= ($usuario['tipo'] ?? '') === 'admin' ? 'selected' : '' ?>>Administrador</option>
                <option value="usuario" <?= ($usuario['tipo'] ?? '') === 'usuario' ? 'selected' : '' ?>>Usuário</option>
            </select>
            <div class="invalid-feedback">Selecione um tipo de usuário.</div>
        </div>

        <div class="mb-3">
    <label for="senha" class="form-label">Senha</label>
    <input
        type="password"
        id="senha"
        name="senha"
        class="form-control"
        placeholder="<?= $id ? 'Deixe em branco para manter a senha atual' : '' ?>"
        <?= $id ? '' : 'required' ?>
    />
    <div class="invalid-feedback">
        <?= $id ? 'Informe a senha para alterar ou deixe em branco para manter.' : 'Senha é obrigatória.' ?>
    </div>
</div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="usuarios.php" class="btn btn-secondary ms-2">Voltar</a>
    </form>
</div>

<script>
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
