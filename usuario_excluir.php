<?php
$pdo = new PDO('sqlite:backup.db');
$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
}
header("Location: usuarios.php");
exit;
