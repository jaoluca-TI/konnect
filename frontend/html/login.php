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
        header('Location: /konnect/frontend/html/home.php');
        exit();
    }

    $login_error = $_SESSION['login_error'] ?? null;
    if (isset($_SESSION['login_error'])) unset($_SESSION['login_error']);
    $register_success = $_SESSION['login_success'] ?? null;
    if (isset($_SESSION['login_success'])) unset($_SESSION['login_success']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/konnect/frontend/css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="login-box">
        <?php if ($register_success): ?>
            <div class="notificacaoSucesso" id="notificacaoSucesso"><?= htmlspecialchars($register_success)?></div>
        <?php endif; ?>
        <?php if ($login_error): ?>
            <div class="notificacaoError" id="notificacaoError"><?= htmlspecialchars($login_error)?></div>
        <?php endif; ?>

        <h1>konnect</h1>
        <form action="/konnect/backend/verificar.php" method="post">
            <input type="email" placeholder="E-mail" name="email" required>
            <input type="password" placeholder="Senha" name="senha" required>
            <a href="#" class="senha">Esqueceu a Senha</a>
            <button type="submit" placeholder="Entrar" id="entrar">Entrar</button>
        </form>
        
        <p>Não possui conta? <a href="/konnect/frontend/html/cadastro.php">Crie uma</a></p>
    </div>

    <script src="/konnect/frontend/js/login.js"></script>
</body>
</html>

