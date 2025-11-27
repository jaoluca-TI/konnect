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
    $msg = 'Preencha e-mail e senha.';
    // Resposta AJAX
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['status' => 'error', 'message' => $msg]);
        exit();
    }

    $_SESSION['login_error'] = $msg;
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

            // Se for requisição AJAX, devolve JSON em vez de redirecionar
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['status' => 'success']);
                exit();
            }

            header('Location: /konnect/frontend/html/home.php');
            exit();
        } else {
            $msg = 'E-mail ou senha incorretos.';
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(['status' => 'error', 'message' => $msg]);
                exit();
            }
            $_SESSION['login_error'] = $msg;
        }
    } else {
        $msg = 'O e-mail digitado não está cadastrado.';
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['status' => 'error', 'message' => $msg]);
            exit();
        }
        $_SESSION['login_error'] = $msg;
    }

    $stmt->close();
} else {
    $msg = 'Erro interno! Tente novamente.';
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['status' => 'error', 'message' => $msg]);
        exit();
    }
    $_SESSION['login_error'] = $msg;
}

// Caso dê erro, volta para login
header('Location: /konnect/frontend/html/login.php');
exit();
