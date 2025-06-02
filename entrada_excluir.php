<?php
$pdo = new PDO('sqlite:backup.db');
$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM entradas_estoque WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: entradas_estoque.php");
exit;
