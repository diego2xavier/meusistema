<?php

// Conexão com o banco chamado 'backup.db'
$pdo = new PDO('sqlite:backup.db');

// Criação das tabelas
$pdo->exec("CREATE TABLE IF NOT EXISTS categorias (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT
);

CREATE TABLE IF NOT EXISTS produtos (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT,
    descricao TEXT,
    quantidade INTEGER,
    preco REAL,
    categoria_id INTEGER,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

CREATE TABLE IF NOT EXISTS fornecedores (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT,
    contato TEXT,
    email TEXT,
    cnpj TEXT
);

CREATE TABLE IF NOT EXISTS entradas_estoque (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    produto_id INTEGER,
    quantidade INTEGER,
    data TEXT,
    fornecedor_id INTEGER,
    FOREIGN KEY (produto_id) REFERENCES produtos(id),
    FOREIGN KEY (fornecedor_id) REFERENCES fornecedores(id)
);

CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT,
    email TEXT,
    senha TEXT,
    tipo TEXT
);");

// Inserção de dados fictícios

$pdo->exec("INSERT INTO categorias (nome) VALUES
('Informática'),
('Escritório'),
('Limpeza'),
('Segurança'),
('Manutenção'),
('Elétrica'),
('Hidráulica'),
('Mobiliário'),
('Papelaria'),
('Alimentos');");

$pdo->exec("INSERT INTO produtos (nome, descricao, quantidade, preco, categoria_id) VALUES
('Notebook', 'Notebook Dell 15\"', 10, 3500.00, 1),
('Teclado', 'Teclado mecânico ABNT2', 25, 200.00, 1),
('Cadeira', 'Cadeira de escritório ergonômica', 15, 900.00, 8),
('Monitor', 'Monitor LED 24\"', 12, 800.00, 1),
('Mouse', 'Mouse óptico USB', 30, 50.00, 1),
('Papel A4', 'Resma de papel 500 folhas', 50, 25.00, 9),
('Álcool 70%', 'Álcool líquido para limpeza', 20, 15.00, 3),
('Cabo HDMI', 'Cabo de 2 metros', 18, 30.00, 1),
('Lâmpada LED', 'Lâmpada econômica 10W', 40, 12.00, 6),
('Café', 'Pacote 500g café torrado e moído', 22, 18.00, 10);");

$pdo->exec("INSERT INTO fornecedores (nome, contato, email, cnpj) VALUES
('Fornecedor A', 'João Silva', 'joao@forn.com', '12345678000100'),
('Fornecedor B', 'Maria Lima', 'maria@forn.com', '98765432000100'),
('Fornecedor C', 'Carlos Souza', 'carlos@forn.com', '45678912000100'),
('Fornecedor D', 'Ana Paula', 'ana@forn.com', '74185296000100'),
('Fornecedor E', 'Paulo César', 'paulo@forn.com', '85296374000100'),
('Fornecedor F', 'Fernanda Dias', 'fernanda@forn.com', '96385274000100'),
('Fornecedor G', 'Ricardo Alves', 'ricardo@forn.com', '32165498000100'),
('Fornecedor H', 'Tatiane Rocha', 'tatiane@forn.com', '65498732000100'),
('Fornecedor I', 'Eduardo Reis', 'eduardo@forn.com', '15935728000100'),
('Fornecedor J', 'Juliana Costa', 'juliana@forn.com', '75315946000100');");

$pdo->exec("INSERT INTO entradas_estoque (produto_id, quantidade, data, fornecedor_id) VALUES
(1, 5, '2024-05-01', 1),
(2, 10, '2024-05-02', 2),
(3, 3, '2024-05-03', 3),
(4, 6, '2024-05-04', 4),
(5, 15, '2024-05-05', 5),
(6, 20, '2024-05-06', 6),
(7, 8, '2024-05-07', 7),
(8, 9, '2024-05-08', 8),
(9, 10, '2024-05-09', 9),
(10, 12, '2024-05-10', 10);");

$senha = password_hash('123', PASSWORD_DEFAULT);
$pdo->exec("INSERT INTO usuarios (nome, email, senha, tipo) VALUES
('Administrador', 'admin@site.com', '123', 'admin'),
('Admin', 'admin@admin.com', 'admin123', 'admin'),
('João', 'joao@email.com', 'senha123', 'usuario'),
('Maria', 'maria@email.com', 'senha123', 'usuario'),
('Pedro', 'pedro@email.com', 'senha123', 'usuario'),
('Ana', 'ana@email.com', 'senha123', 'usuario'),
('Carlos', 'carlos@email.com', 'senha123', 'usuario'),
('Julia', 'julia@email.com', 'senha123', 'usuario'),
('Bruno', 'bruno@email.com', 'senha123', 'usuario'),
('Laura', 'laura@email.com', 'senha123', 'usuario'),
('Marcos', 'marcos@email.com', 'senha123', 'usuario');");

echo "Banco de dados 'backup.db' criado com sucesso com dados de exemplo.";
