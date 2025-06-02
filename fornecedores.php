<?php
$titulo = "Fornecedores";
include 'header.php';

$pdo = new PDO('sqlite:backup.db');
$fornecedores = $pdo->query("SELECT * FROM fornecedores")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Fornecedores</h2>
<a href="fornecedor_form.php" class="btn btn-primary mb-3">Novo Fornecedor</a>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Contato</th>
      <th>Email</th>
      <th>CNPJ</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($fornecedores as $f): ?>
    <tr>
      <td><?= $f['id'] ?></td>
      <td><?= htmlspecialchars($f['nome']) ?></td>
      <td><?= htmlspecialchars($f['contato']) ?></td>
      <td><?= htmlspecialchars($f['email']) ?></td>
      <td><?= htmlspecialchars($f['cnpj']) ?></td>
      <td>
        <a href="fornecedor_form.php?id=<?= $f['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
        <a href="fornecedor_excluir.php?id=<?= $f['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirmar exclusão?')">Excluir</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php" class="btn btn-secondary mt-3">Voltar ao Menu</a>

<?php include 'footer.php'; ?>
