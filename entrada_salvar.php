<?php
session_start();

$pdo = new PDO('sqlite:backup.db');
$id = $_POST['id'] ?? null;
$produto_id = $_POST['produto_id'] ?? null;
$quantidade = $_POST['quantidade'] ?? null;
$data = $_POST['data'] ?? null;
$fornecedor_id = $_POST['fornecedor_id'] ?? null;

$errors = [];

// Validações simples
if (!$produto_id) {
    $errors[] = "Produto é obrigatório.";
}
if (!$fornecedor_id) {
    $errors[] = "Fornecedor é obrigatório.";
}
if (!$quantidade || !is_numeric($quantidade) || $quantidade <= 0) {
    $errors[] = "Quantidade deve ser um número positivo.";
}
if (!$data || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $data)) {
    $errors[] = "Data inválida.";
}

if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = $_POST;
    $redirect = $id ? "entrada_form.php?id=$id" : "entrada_form.php";
    header("Location: $redirect");
    exit;
}

try {
    if ($id) {
        $stmt = $pdo->prepare("UPDATE entradas_estoque SET produto_id = ?, quantidade = ?, data = ?, fornecedor_id = ? WHERE id = ?");
        $stmt->execute([$produto_id, $quantidade, $data, $fornecedor_id, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO entradas_estoque (produto_id, quantidade, data, fornecedor_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$produto_id, $quantidade, $data, $fornecedor_id]);
    }
    $_SESSION['success'] = "Entrada salva com sucesso!";
    header("Location: entradas_estoque.php");
    exit;
} catch (Exception $e) {
    $_SESSION['errors'] = ["Erro ao salvar entrada: " . $e->getMessage()];
    $_SESSION['old'] = $_POST;
    $redirect = $id ? "entrada_form.php?id=$id" : "entrada_form.php";
    header("Location: $redirect");
    exit;
}
