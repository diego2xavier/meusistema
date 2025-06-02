<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Stock Master - Menu Principal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('background.jpg') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .card-container {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
      max-width: 500px;
      margin-top: 100px;
    }

    .btn-custom {
      font-size: 18px;
      padding: 12px;
    }

    .logo-text {
      font-weight: bold;
      font-size: 28px;
      color: #007bff;
    }
  </style>
</head>
<body>

<div class="container d-flex justify-content-center">
  <div class="card-container text-center">
    <div class="logo-text mb-3">📦 Stock Master</div>
    <h4 class="mb-4">Menu Principal</h4>

    <?php if (!empty($_SESSION['errors'])): ?>
      <div class="alert alert-danger">
        <?php foreach ($_SESSION['errors'] as $error): ?>
          <div><?= htmlspecialchars($error) ?></div>
        <?php endforeach; ?>
        <?php unset($_SESSION['errors']); ?>
      </div>
    <?php endif; ?>

    <div class="d-grid gap-3">
      <a href="produtos.php" class="btn btn-primary btn-custom">📦 Produtos</a>
      <a href="categorias.php" class="btn btn-secondary btn-custom">🏷️ Categorias</a>
      <a href="fornecedores.php" class="btn btn-success btn-custom">🚚 Fornecedores</a>
      <a href="entradas_estoque.php" class="btn btn-warning btn-custom">📥 Entradas de Estoque</a>

      <?php if ($_SESSION['usuario']['tipo'] === 'admin'): ?>
        <a href="usuarios.php" class="btn btn-info btn-custom">👤 Gerenciar Usuários</a>
      <?php endif; ?>

      <a href="logout.php" class="btn btn-danger btn-custom">🚪 Sair</a>
    </div>
  </div>
</div>

</body>
</html>

