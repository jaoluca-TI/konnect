<?php
// Ensure session started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If not logged in, redirect to login (preserve requested page via next)
if (!isset($_SESSION['id'])) {
    // Try to detect the requested URL to pass as next
    $current = $_SERVER['REQUEST_URI'] ?? '/konnect/frontend/html/home.php';
    header('Location: /konnect/frontend/html/login.php?next=' . urlencode($current));
    exit();
}

?>