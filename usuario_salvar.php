<?php
session_start();
$pdo = new PDO('sqlite:backup.db');

$id = $_POST['id'] ?? null;
$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$tipo = $_POST['tipo'] ?? '';
$senha = $_POST['senha'] ?? '';

$errors = [];

// Validações
if ($nome === '') {
    $errors[] = "O nome é obrigatório.";
}
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email inválido.";
}
if (!in_array($tipo, ['admin', 'usuario'])) {
    $errors[] = "Tipo de usuário inválido.";
}
if (!$id && $senha === '') {
    $errors[] = "Senha é obrigatória para novo usuário.";
}
if ($senha !== '' && strlen($senha) < 6) {
    $errors[] = "Senha deve ter pelo menos 6 caracteres.";
}

if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    $redirect = $id ? "usuario_form.php?id=$id" : "usuario_form.php";
    header("Location: $redirect");
    exit;
}

try {
    if ($id) {
        // Atualizar com ou sem senha
        if ($senha !== '') {
            $hashSenha = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, tipo = ?, senha = ? WHERE id = ?");
            $stmt->execute([$nome, $email, $tipo, $hashSenha, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE usuarios SET nome = ?, email = ?, tipo = ? WHERE id = ?");
            $stmt->execute([$nome, $email, $tipo, $id]);
        }
        $_SESSION['success'] = "Usuário atualizado com sucesso!";
    } else {
        $hashSenha = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, tipo, senha) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nome, $email, $tipo, $hashSenha]);
        $_SESSION['success'] = "Usuário criado com sucesso!";
    }

    header("Location: usuarios.php");
    exit;

} catch (Exception $e) {
    $_SESSION['errors'] = ["Erro ao salvar usuário: " . $e->getMessage()];
    $_SESSION['old'] = $_POST;
    $redirect = $id ? "usuario_form.php?id=$id" : "usuario_form.php";
    header("Location: $redirect");
    exit;
}


