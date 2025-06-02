<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>
    <p>Você está logado no sistema de gerenciamento de estoque.</p>
    <a href="logout.php">Sair</a>
</body>
</html>
