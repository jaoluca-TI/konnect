<?php
 session_start(); // Vou iniciar a sessao, pq se nao tiver isso o servidor nao sabe qual sessao encerrar

 session_unset(); // Limpa todas as variaveis da sessao, Esvaziando os dados
 
 session_destroy(); // destroi Completamente a sessao do servidor, Aqui o usuario fica deslogado

 header("Location: /konnect/frontend/html/login.php"); // redireciona o usuario para a tela de login quando deslogado

 exit(); // encerrar o codigo


?>