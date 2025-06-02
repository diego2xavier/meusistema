<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$pdo = new PDO('sqlite:backup.db');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Buscar os produtos
$stmt = $pdo->query("SELECT * FROM produtos");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Produtos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Lista de Produtos</h2>
    <a href="produto_form.php" class="btn btn-success">Novo Produto</a>
  </div>

  <?php if (count($produtos) > 0): ?>
  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Quantidade</th>
        <th>Preço</th>
        <th>ID Categoria</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($produtos as $produto): ?>
        <tr>
          <td><?= htmlspecialchars($produto['id']) ?></td>
          <td><?= htmlspecialchars($produto['nome']) ?></td>
          <td><?= htmlspecialchars($produto['descricao']) ?></td>
          <td><?= htmlspecialchars($produto['quantidade']) ?></td>
          <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
          <td><?= htmlspecialchars($produto['categoria_id']) ?></td>
          <td>
            <a href="produto_form.php?id=<?= $produto['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
            <a href="produto_excluir.php?id=<?= $produto['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php else: ?>
    <p>Nenhum produto cadastrado.</p>
  <?php endif; ?>

  <a href="index.php" class="btn btn-secondary mt-3">Voltar ao Menu</a>
</div>

</body>
</html>
