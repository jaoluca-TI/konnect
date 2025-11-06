<?php
    include '../../backend/status.php';
?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>konnect</title>
    <link rel="stylesheet" href="/konnect/frontend/css/projeto.css">
    <link rel="shortcut icon" href="/konnect/img/konnectFav.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" integrity="sha512-t7Few9xlddEmgd3oKZQahkNI4dS6l80+eGEzFQiqtyVYdvcSG2D3Iub77R20BdotfRPA9caaRkg1tyaJiPmO0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <h1 class="fade-in">konnect</h1>
            <nav class="nav fade-in">
                <a href="/konnect/frontend/html/home.php">Home</a>
                <a href="/konnect/frontend/html/projeto.php">Projetos</a>
            </nav>

            <?php if($logado): ?>
                <div class="status">
                    <img src="/konnect/img/default.jpg" alt="imagem padrao">
                    <div class="dropdown">
                        <a href="/konnect/frontend/html/viewPerfil.php">Ver Perfil</a>
                        <a href="/konnect/backend/sair.php">Sair<i class="bi bi-box-arrow-in-right"></i></a>
                    </div>
                </div>

            <?php else: ?>
                <div class="botoes fade-in">
                    <a href="/konnect/frontend/html/login.php"><button id="botaoLogin">Login<i class="bi bi-box-arrow-in-right"></i></button></a>
                </div>
            <?php endif; ?>
    </header>

    <div class="container fade-in">
        <div class="projetos fade-in">
            <h2>Projetos</h2>
            <p>Crie ou colabore. Sua ideia pode mudar tudo.</p>
        </div>

        <div class="button-projeto fade-in">
            <a href="criarProjeto.php">
                <button class="fade-in"><i class="bi bi-plus-lg fade-in"></i> Criar Projeto</button>
            </a>
        </div>
       
        <div class="projeto-card fade-in">
            <?php
                include __DIR__ . '/../../backend/carregarProjetos.php'
            ?>
        </div>   
    </div>

    <div class="voltar-proximo">
        <button id="prevBtn"><i class="bi bi-arrow-left"></i></button>
        <span>ou</span>
        <button id="nextBtn"><i class="bi bi-arrow-right"></i></button>
    </div>

    <footer>
        <h1>konnect</h1>
        <p>&copy; 2025 konnect, Conectando pessoas para grandes ideias</p>
    </footer>

    <script src="/konnect/frontend/js/projetos.js"></script>
</body>
</html>
