<?php
$pdo = new PDO('sqlite:backup.db');
$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM fornecedores WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: fornecedores.php");
exit;
