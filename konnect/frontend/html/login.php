<?php
session_start();

// Se já está logado → vai para home
if (isset($_SESSION['id'])) {
    header('Location: /konnect/frontend/html/home.php');
    exit();
}

$login_error = $_SESSION['login_error'] ?? null;
unset($_SESSION['login_error']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/konnect/frontend/css/login.css">
<title>Login</title>
</head>
<body>
    <div class="login-box">

        <?php if ($login_error): ?>
            <div class="notificacaoError" id="notificacaoError">
                <?= htmlspecialchars($login_error) ?>
            </div>
        <?php endif; ?>

        <h1>konnect</h1>
        <form action="/konnect/backend/verificar.php" method="post">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>

        <p>Não possui conta? <a href="/konnect/frontend/html/cadastro.php">Crie uma</a></p>
    </div>

<script src="/konnect/frontend/js/login.js"></script>
</body>
</html>
