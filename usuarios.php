<?php
include 'verifica_admin.php';
$pdo = new PDO('sqlite:backup.db');
$usuarios = $pdo->query("SELECT id, nome, email, tipo FROM usuarios")->fetchAll(PDO::FETCH_ASSOC);

// Mensagens de feedback
$success = $_SESSION['success'] ?? null;
$errors = $_SESSION['errors'] ?? null;
unset($_SESSION['success'], $_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Usuários</h1>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php if ($errors): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <a href="usuario_form.php" class="btn btn-primary mb-3">Novo Usuário</a>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= htmlspecialchars($u['nome']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['tipo']) ?></td>
                    <td>
                        <a href="usuario_form.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="usuario_excluir.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirmar exclusão?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="index.php" class="btn btn-secondary mt-3">Voltar ao Menu</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
