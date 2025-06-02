<?php
// Arquivo de conexão com o banco (SQLite)
$db = new PDO('sqlite:backup.db');

// Habilita o modo de erros com exceções
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
    // Cria a tabela 'usuarios' se não existir
    $db->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT NOT NULL UNIQUE,
            password TEXT NOT NULL
        );
    ");

    // Insere usuário padrão 'admin' com senha 'senha123', se não existir
    $username = 'DiegoXavier01';
    $password = password_hash('Xavier@262', PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT OR IGNORE INTO usuarios (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);

    echo "✅ Banco de dados criado com sucesso.<br>";
    echo "🔐 Usuário padrão: <b>DiegoXavier01</b><br>Senha: <b>Xavier@262</b><br><br>";
    echo "➡️ <a href='login.php'>Ir para a tela de login</a>";
} catch (PDOException $e) {
    echo "Erro ao criar o banco ou inserir usuário: " . $e->getMessage();
}
?>
