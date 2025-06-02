<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['usuario']['tipo'] !== 'admin') {
    $_SESSION['errors'] = ["Acesso negado. Apenas administradores podem acessar esta área."];
    header("Location: index.php");
    exit;
}
