<?php
session_start();

// Exibir erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Captura os dados do formulário
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

try {
    // Conectando ao banco
    $pdo = new PDO('sqlite:backup.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta o usuário pelo e-mail
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica a senha
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit;
    } else {
        echo "<div style='text-align:center; margin-top:20px;'>Usuário ou senha incorretos.</div>";
    }

} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}
