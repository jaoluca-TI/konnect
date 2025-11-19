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
    <div class="login-box">
        <h1>Konnect</h1>
        <form action="/konnect/backend/cadastrar.php" method="post" class="form">

            <?php if ($usuario_existe): ?>
                <div class="notificacaoError">Email já cadastrado. Tente outro ou faça login.</div>
            <?php else: ?>
                <div class="notificacaoSucesso">Cadastro Realizado com sucesso</div>
            <?php endif; ?>

            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Criar conta</button>
        </form>
        
        <p>Já possuí uma conta? <a href="/konnect/frontend/html/login.php">Entrar</a></p>
    </div>
</body>
</html>



