<?php
    session_start();
    include __DIR__ . '/conexao.php';

    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if ($nome === '' || $email === '' || $senha === '') {
        $_SESSION['usuario_Existe'] = 'Preencha todos os campos.';
        header('Location: /konnect/frontend/html/cadastro.php');
        exit();
    }

    $checkSql = 'SELECT id FROM usuario WHERE email = ? LIMIT 1';
    if ($stmt = $conexao->prepare($checkSql)) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['usuario_Existe'] = true;
            $stmt->close();
            header('Location: /konnect/frontend/html/cadastro.php');
            exit();
        }
        $stmt->close();
    } else {
        $_SESSION['usuario_Existe'] = 'Erro interno.';
        header('Location: /konnect/frontend/html/cadastro.php');
        exit();
    }

    $hashed = password_hash($senha, PASSWORD_DEFAULT);
    $insertSql = 'INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)';
    if ($stmt = $conexao->prepare($insertSql)) {
        $stmt->bind_param('sss', $nome, $email, $hashed);
        if ($stmt->execute()) {
            $_SESSION['status_cadastro'] = 'Cadastro realizado com sucesso. Faça login.';
            $stmt->close();
            $conexao->close();
            header('Location: /konnect/frontend/html/login.php');
            exit();
        }
        $stmt->close();
    }

    $conexao->close();
    $_SESSION['usuario_Existe'] = 'Erro ao cadastrar.';
    header('Location: /konnect/frontend/html/cadastro.php');
    exit();
?>