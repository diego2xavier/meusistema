<?php
$pdo = new PDO('sqlite:backup.db');
$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM categorias WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: categorias.php");
exit;
