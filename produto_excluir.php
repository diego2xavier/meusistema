<?php
$pdo = new PDO('sqlite:backup.db');
$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: produtos.php");
exit;
