<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Login - Stock Master</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('https://images.unsplash.com/photo-1581091012184-5c46a3601a70?auto=format&fit=crop&w=1500&q=80') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
      background-color: rgba(255, 255, 255, 0.95);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
      max-width: 400px;
      margin-top: 120px;
    }

    .logo-text {
      font-weight: bold;
      font-size: 26px;
      color: #007bff;
    }

    .form-control {
      font-size: 16px;
    }

    .btn-login {
      font-size: 16px;
      padding: 10px;
    }
  </style>
</head>
<body>

<div class="container d-flex justify-content-center">
  <div class="login-card text-center">
    <div class="logo-text mb-3">🔐 Stock Master</div>
    <h5 class="mb-4">Acesso ao Sistema</h5>

    <?php if (!empty($_SESSION['errors'])): ?>
      <div class="alert alert-danger text-start">
        <?php foreach ($_SESSION['errors'] as $error): ?>
          <div><?= htmlspecialchars($error) ?></div>
        <?php endforeach; ?>
        <?php unset($_SESSION['errors']); ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="verifica_login.php">
      <div class="mb-3 text-start">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3 text-start">
        <label for="senha" class="form-label">Senha</label>
        <input type="password" class="form-control" id="senha" name="senha" required>
      </div>
      <button type="submit" class="btn btn-primary btn-login w-100">Entrar</button>
    </form>
  </div>
</div>

</body>
</html>

