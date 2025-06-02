<?php
$titulo = "Entradas no Estoque";
include 'header.php';

$pdo = new PDO('sqlite:backup.db');
$sql = "SELECT e.*, p.nome AS produto, f.nome AS fornecedor
        FROM entradas_estoque e
        LEFT JOIN produtos p ON e.produto_id = p.id
        LEFT JOIN fornecedores f ON e.fornecedor_id = f.id";
$entradas = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">
    <h1 class="mb-4">Entradas no Estoque</h1>
    <a href="entrada_form.php" class="btn btn-primary mb-3">Nova Entrada</a>
    
    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white shadow-sm">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                    <th>Fornecedor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($entradas as $e): ?>
                <tr>
                    <td><?= $e['id'] ?></td>
                    <td><?= htmlspecialchars($e['produto']) ?></td>
                    <td><?= $e['quantidade'] ?></td>
                    <td><?= $e['data'] ?></td>
                    <td><?= htmlspecialchars($e['fornecedor']) ?></td>
                    <td>
                        <a href="entrada_form.php?id=<?= $e['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                        <a href="entrada_excluir.php?id=<?= $e['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirmar exclusão?')">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a href="index.php" class="btn btn-secondary mt-3">Voltar ao Menu</a>
</div>

<?php include 'footer.php'; ?>
