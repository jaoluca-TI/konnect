<?php
  include '../../backend/status.php';
  include __DIR__ . '/../../backend/protect.php';
?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="/konnect/frontend/css/profile.css">
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
     <main class="perfil-container">

    <section class="banner fade-in">
      <img id="bannerPreview" src="/konnect/img/bannerDefault.png" alt="Banner do perfil">
      <label for="bannerInput" class="btn-banner">Alterar Banner</label>
      <input type="file" id="bannerInput" accept="image/*">
    </section>

    <section class="dados-pessoais fade-in">
      <div class="foto-container">
        <img id="fotoPreview" src="/konnect/img/default.jpg"  class="foto-perfil">
        <label for="fotoInput" class="btn-foto">Alterar foto</label>
        <input type="file" id="fotoInput" accept="image/*">
      </div>

      <div class="info-basica fade-in">
        <label>Nome:</label>
        <input type="text" id="nome" placeholder="Digite seu nome completo">

        <label>Título Profissional:</label>
        <input type="text" id="titulo" placeholder="Ex: Desenvolvedor Full Stack">

        <label>Localização:</label>
        <input type="text" id="localizacao" placeholder="Ex: São Paulo, Brasil">

        <label>Disponibilidade:</label>
        <select id="disponibilidade">
          <option value="disponivel">Disponível</option>
          <option value="indisponivel">Indisponível</option>
        </select>
      </div>
    </section>


    <section class="redes-sociais fade-in">
      <h3>Redes Sociais</h3>
      <div class="grid-redes fade-in">
        <input type="url" placeholder="LinkedIn (ex: https://linkedin.com/in/seunome)">
        <input type="url" placeholder="GitHub (ex: https://github.com/seunome)">
        <input type="url" placeholder="Instagram (opcional)">
        <input type="url" placeholder="Portfólio pessoal (ex: https://seusite.dev)">
        <input type="url" placeholder="Behance (opcional)">
        <input type="url" placeholder="Dribbble (opcional)">
      </div>
    </section>


    <section class="biografia fade-in">
      <h3>Biografia</h3>
      <textarea id="bio" rows="4" placeholder="Conte um pouco sobre você, suas experiências e o que busca em projetos colaborativos..."></textarea>
    </section>


    <section class="habilidades fade-in">
      <h3>Habilidades e Áreas de Atuação</h3>
      <div class="add-habilidade">
        <input type="text" id="habilidade" placeholder="Digite uma habilidade...">
        <select id="nivel">
          <option value="Iniciante">Iniciante</option>
          <option value="Intermediário">Intermediário</option>
          <option value="Avançado">Avançado</option>
        </select>
        <button id="addHabilidade"><i class="bi bi-plus-lg"></i>Adicionar</button>
      </div>
      <div id="listaHabilidades" class="tags"></div>
    </section>

 <section class="interesses-objetivos fade-in">
  <h3>Interesses e Objetivos</h3>
  <div class="opcoes">
    <label><input type="checkbox"> Procurando equipe</label>
    <label><input type="checkbox"> Quer colaborar em um projeto existente</label>
    <label><input type="checkbox"> Quer mentorar alguém</label>
    <label><input type="checkbox"> Quer aprender com outros profissionais</label>
  </div>
</section>

<section class="portfolio fade-in">
  <h3>Projetos e Trabalhos anteriores</h3>
  <div class="container-portfolio">
    <button  id="openModalBtn"  ><i class="bi bi-plus-lg"></i>Adicionar Projetos</button>
    <div class="modal" id="myModal" >

        <div class="modal-content fade-in">

            <div class="topo">
                <h1 id="topoh1">Projeto 1</h1>
                <span class="close" >&times;</span>
            </div>

                <div class="img">
                    <label for="">Imagem-projeto</label>
                    <div class="content-img" id="content-img">
                      <i class="bi bi-upload" id="iconeImg"></i>
                      <p id="pImg">Clique para fazer upload da imagem</p>
                      <input type="file" name="" id="inputImg" class="input-img">
                    </div>
                </div>

                <div class="input-box">
                  <label for="nomeProjeto">Nome do projeto</label>
                  <input type="text" placeholder="Ex: konnect" name="nomeProjeto">
                </div>

                <div class="input-box">
                  <label for="">link do projeto</label>
                  <input type="url" name="linkProjeto" id="" placeholder="https://...">
                </div> 
            
                <div class="save">
                  <button id="salvar-modal" name="salvarModal">Salvar</button>
                  <button id="cancelar-modal" name="cancelarModal">Cancelar</button>
                </div>

            
        </div>
    </div>
</section>


  <section class="colaboracao fade-in">
  <h3>Preferências de Colaboração</h3>

  <div class="grupo fade-in">
    <div class="opcoes">
      <label><input type="checkbox"> Remota</label>
      <label><input type="checkbox"> Híbrida</label>
      <label><input type="checkbox"> Presencial</label>
    </div>
  </div>

  <h3>Modalidade de Compensação</h3>
  <div class="grupo fade-in">
    <div class="opcoes">
      <label><input type="checkbox"> Voluntária</label>
      <label><input type="checkbox"> Remunerada</label>
    </div>
  </div>

  <h3>Disponibilidade semanal</h3>
  <input type="text" placeholder="Ex: 10h/semana">
</section>


   <section class="salvarOrNo fade-in">
    <button id="salvarMudancas">Salvar</button>
    <button id="cancelar">Cancelar</button>
   </section>
  </main>

  
  <div class="mudancas" id="mudancas"><i class="bi bi-check2"></i></div>

  <div class="notificacao" id="notificacao"></div>


  
  <footer>
    <h1>konnect</h1>
    <p>&copy; 2025 konnect, Conectando pessoas para grandes</p>
</footer>

  <script src="/konnect/frontend/js/script.js"></script>
  <script src="/konnect/frontend/js/perfil.js"></script>

</body>
</html>

