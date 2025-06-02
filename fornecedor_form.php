<?php
$titulo = "Fornecedor";
include 'header.php';

$pdo = new PDO('sqlite:backup.db');
$id = $_GET['id'] ?? null;
$fornecedor = ['nome'=>'', 'contato'=>'', 'email'=>'', 'cnpj'=>''];

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM fornecedores WHERE id = ?");
    $stmt->execute([$id]);
    $fornecedor = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<h2><?= $id ? 'Editar' : 'Novo' ?> Fornecedor</h2>

<form method="POST" action="fornecedor_salvar.php">
  <input type="hidden" name="id" value="<?= $id ?>">

  <div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($fornecedor['nome']) ?>" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Contato</label>
    <input type="text" name="contato" class="form-control" value="<?= htmlspecialchars($fornecedor['contato']) ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($fornecedor['email']) ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">CNPJ</label>
    <input type="text" name="cnpj" class="form-control" value="<?= htmlspecialchars($fornecedor['cnpj']) ?>">
  </div>

  <button type="submit" class="btn btn-success">Salvar</button>
  <a href="fornecedores.php" class="btn btn-secondary">Voltar para lista</a>
</form>

<?php include 'footer.php'; ?>
