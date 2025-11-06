<?php
    session_start();
    $usuario_existe = $_SESSION['usuario_Existe'] ?? null;
    if (isset($_SESSION['usuario_Existe'])) unset($_SESSION['usuario_Existe']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="/konnect/frontend/css/cadastro.css">
    <link rel="shortcut icon" href="/konnect/img/konnectFav.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <form action="/konnect/backend/cadastrar.php" method="post" class="form">
            <h1>konnect</h1>
            <?php if ($usuario_existe): ?>
                <div style="color:crimson; padding:8px;">Email já cadastrado. Tente outro ou faça login.</div>
            <?php endif; ?>
            <div class="input-box">
                <input type="text" name="nome" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="senha" placeholder="Password" required>
            </div>
            <div class="input-box">
                <button type="submit">Cadastrar</button>
            </div>
            <div class="nao-conta">
                <p>Já tem uma conta?<a href="/konnect/frontend/html/login.php">Entrar</a></p>
            </div>
        </form>
    </div>
</body>
</html>