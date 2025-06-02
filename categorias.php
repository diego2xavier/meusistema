<?php
$titulo = "Categorias";
include 'header.php';

$pdo = new PDO('sqlite:backup.db');
$categorias = $pdo->query("SELECT * FROM categorias")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Categorias</h2>
<a href="categoria_form.php" class="btn btn-primary mb-3">Nova Categoria</a>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($categorias as $c): ?>
    <tr>
      <td><?= $c['id'] ?></td>
      <td><?= htmlspecialchars($c['nome']) ?></td>
      <td>
        <a href="categoria_form.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
        <a href="categoria_excluir.php?id=<?= $c['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirmar exclusão?')">Excluir</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php" class="btn btn-secondary mt-3">Voltar ao Menu</a>

<?php include 'footer.php'; ?>
