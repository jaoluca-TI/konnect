<?php
session_start();
include __DIR__ . '/conexao.php';

// Aceita apenas POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /konnect/frontend/html/login.php');
    exit();
}

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

// Validação
if ($email === '' || $senha === '') {
    $_SESSION['login_error'] = 'Preencha e-mail e senha.';
    header('Location: /konnect/frontend/html/login.php');
    exit();
}

$sql = "SELECT id, nome, email, senha FROM usuario WHERE email = ? LIMIT 1";
$stmt = $conexao->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($usuario = $result->fetch_assoc()) {
        if (password_verify($senha, $usuario['senha'])) {

            // Login OK
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['login_success'] = "success";

            header('Location: /konnect/frontend/html/home.php');
            exit();
        } else {
            $_SESSION['login_error'] = 'E-mail ou senha incorretos.';
        }
    } else {
        $_SESSION['login_error'] = 'O e-mail digitado não está cadastrado.';
    }

    $stmt->close();
} else {
    $_SESSION['login_error'] = 'Erro interno! Tente novamente.';
}

// Caso dê erro, volta para login
header('Location: /konnect/frontend/html/login.php');
exit();
