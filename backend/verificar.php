<?php
    session_start();
    include __DIR__ . '/conexao.php';

    // Only accept POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /konnect/frontend/html/login.php');
        exit();
    }

    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($email === '' || $senha === '') {
        $_SESSION['login_error'] = 'Preencha email e senha.';
        header('Location: /konnect/frontend/html/login.php');
        exit();
    }

    // Prepare statement to avoid SQL injection
    $sql = 'SELECT id, nome, email, senha FROM usuario WHERE email = ? LIMIT 1';
    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            // Verify password hash
            if (password_verify($senha, $row['senha'])) {
                    // Start session already done and store user info
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['nome'] = $row['nome'];
                    // Redirect to the public home page after successful login
                    header('Location: /konnect/frontend/html/home.php');
                    exit();
            } else {
                $_SESSION['login_error'] = 'E-mail ou senha incorretos.';
                header('Location: /konnect/frontend/html/login.php');
                exit();
            }
        } else {
            $_SESSION['login_error'] = 'E-mail não cadastrado.';
            header('Location: /konnect/frontend/html/login.php');
            exit();
        }
    } else {
        // Query prepare failed
        $_SESSION['login_error'] = 'Erro interno. Tente novamente.';
        header('Location: /konnect/frontend/html/login.php');
        exit();
    }
?>