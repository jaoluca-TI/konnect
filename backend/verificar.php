<?php
    session_start();
    include __DIR__ . '/conexao.php';

    // Aceitar somente requisições POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /konnect/frontend/html/login.php');
        exit();
    }

    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    // Verifica se os campos foram preenchidos
    if ($email === '' || $senha === '') {
        $_SESSION['login_error'] = 'Preencha email e senha.';
        header('Location: /konnect/frontend/html/login.php');
        exit();
    }

    // Preparação de consulta para evitar SQL Injection
    $sql = 'SELECT id, nome, email, senha FROM usuario WHERE email = ? LIMIT 1';
    
    // Verifica se a consulta foi preparada corretamente
    if ($stmt = $conexao->prepare($sql)) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verifica se encontrou o usuário
        if ($row = $result->fetch_assoc()) {
            
            // Verifica se a senha está correta usando o hash do banco
            if (password_verify($senha, $row['senha'])) {

                // Armazena informações do usuário na sessão
                $_SESSION['id'] = $row['id'];
                $_SESSION['nome'] = $row['nome'];

                // Mensagem de sucesso
                $_SESSION['login_success'] = 'Login realizado com sucesso.';

                // Redireciona para a página inicial após login
                header('Location: /konnect/frontend/html/home.php');
                exit();

            } else {
                $_SESSION['login_error'] = 'E-mail ou senha incorretos.';
                header('Location: /konnect/frontend/html/login.php');
                exit();
            }

        } else {
            $_SESSION['login_error'] = 'O E-mail digitado não está cadastrado.';
            header('Location: /konnect/frontend/html/login.php');
            exit();
        }

    } else {
        // Caso a consulta falhe
        $_SESSION['login_error'] = 'Erro interno. Tente novamente.';
        header('Location: /konnect/frontend/html/login.php');
        exit();
    }
?>