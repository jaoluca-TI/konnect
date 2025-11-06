<?php
    session_start();
    // If user is already logged in, forward them to next (if provided) or home
    $next = $_GET['next'] ?? '';
    // normalize
    if ($next && strpos($next, '/konnect/') !== 0) {
        // ignore invalid external next
        $next = '';
    }
    if (isset($_SESSION['id']) && $_SESSION['id']) {
        if ($next) {
            header('Location: ' . $next);
            exit();
        }
        header('Location: /konnect/frontend/html/home.html');
        exit();
    }

    $login_error = $_SESSION['login_error'] ?? null;
    if (isset($_SESSION['login_error'])) unset($_SESSION['login_error']);
    $register_success = $_SESSION['status_cadastro'] ?? null;
    if (isset($_SESSION['status_cadastro'])) unset($_SESSION['status_cadastro']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/konnect/frontend/css/login.css">
    <link rel="shortcut icon" href="/konnect/img/konnectFav.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <?php if ($register_success): ?>
            <div class="alert" style="color:green; padding:8px;"><?= htmlspecialchars($register_success) ?></div>
        <?php endif; ?>
        <?php if ($login_error): ?>
            <div class="alert" style="color:crimson; padding:8px;"><?= htmlspecialchars($login_error) ?></div>
        <?php endif; ?>
        <form action="/konnect/backend/verificar.php" method="post" class="form">
            <h1>konnect</h1>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="senha" placeholder="Senha" required>
            </div>
            <div class="esqueceu-senha">
                <a href="">Esqueceu a senha?</a>
            </div>
            <div class="input-box">
                <button type="submit">Entrar</button>
            </div>
            <div class="nao-conta">
                <p>Não tem uma conta? <a href="/konnect/frontend/html/cadastro.php">Crie uma</a></p>
            </div>
        </form>
    </div>
</body>
</html>