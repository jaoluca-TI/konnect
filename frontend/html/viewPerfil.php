<?php
  include '../../backend/status.php';
  include './../../backend/protect.php';
?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>konnect</title>
    <link rel="stylesheet" href="/konnect/frontend/css/viewPerfil.css">
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

  <main class="perfil-container fade-in">
    <div class="banner">
      <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c" alt="Banner do perfil">
      <a href="/konnect/frontend/html/profile.php"><button>Editar perfil</button></a>
    </div>

    <section class="perfil-info">
      <div class="foto">
        <img src="https://avatars.githubusercontent.com/u/9919?s=200&v=4" alt="Foto de perfil">
      </div>
      <div class="dados">
        <h2>João Lucas Amaral</h2>
        <h3>Desenvolvedor Full Stack</h3>
        <p class="localizacao"><i class="bi bi-geo-alt-fill"></i> São Paulo, Brasil</p>
  <span class="profile-status">🟢 Disponível para novos projetos</span>

        <div class="seguidores">
          <i class="bi bi-people-fill"></i>
          <span><strong>1.284</strong> seguidores</span>
        </div>
      </div>
    </section>

    <section class="redes">
      <h3>Redes e Contatos</h3>
      <div class="links">
        <a href="#"><i class="bi bi-linkedin"></i> LinkedIn</a>
        <a href="#"><i class="bi bi-github"></i> GitHub</a>
        <a href="#"><i class="bi bi-instagram"></i> Instagram</a>
        <a href="#"><i class="bi bi-globe"></i> Portfólio</a>
      </div>
    </section>

    <section class="biografia">
      <h3>Sobre mim</h3>
      <p>
        Olá! Sou um desenvolvedor apaixonado por tecnologia e design digital.
        Tenho experiência em desenvolvimento web, com foco em criar interfaces simples,
        acessíveis e com propósito. Acredito que boas ideias nascem da colaboração entre pessoas.
      </p>
    </section>

    <section class="habilidades">
      <h3>Habilidades e Ferramentas</h3>
      <div class="tags">
        <span>HTML — Avançado</span>
        <span>CSS — Intermediário</span>
        <span>PHP — Avançado</span>
        <span>JavaScript — Intermediário</span>
        <span>MySQL — Intermediário</span>
      </div>
    </section>

    <section class="interesses">
      <h3>O que estou buscando</h3>
      <ul>
        <li>✔ Participar de projetos colaborativos</li>
        <li>✔ Aprimorar minhas habilidades com outros devs</li>
        <li>✔ Contribuir com ideias e soluções criativas</li>
      </ul>
    </section>

    <section class="portfolio">
      <h3>Projetos Recentes</h3>
      <div class="projetos">
        <div class="projeto-card">
          <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085" alt="">
          <h4>Landing Page Responsiva</h4>
          <a href="#">Ver projeto <i class="bi bi-box-arrow-up-right"></i></a>
        </div>
        <div class="projeto-card">
          <img src="https://images.unsplash.com/photo-1551033406-611cf9a28f67" alt="">
          <h4>Aplicativo de Tarefas</h4>
          <a href="#">Ver projeto <i class="bi bi-box-arrow-up-right"></i></a>
        </div>
      </div>
    </section>

    <section class="preferencias">
      <h3>Forma de Trabalho</h3>
      <div class="opcoes">
        <span>Remota</span>
        <span>Híbrida</span>
        <span>Presencial (São Paulo)</span>
      </div>
    </section>

    <section class="compensacao">
      <h3>Tipo de Colaboração</h3>
      <div class="opcoes">
        <span>Freelancer</span>
        <span>Voluntária</span>
        <span>Remunerada</span>
      </div>
    </section>
  </main>
  <footer>
        <h1>konnect</h1>
        <p>&copy; 2025 konnect, Conectando pessoas para grandes ideias</p>
    </footer>
</body>
</html>

