<?php
    include '../../backend/status.php';
    include __DIR__ . '/../../backend/protect.php';
?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar projetos</title>
    <link rel="stylesheet" href="/konnect/frontend/css/criarProjeto.css">
    <link rel="shortcut icon" href="/img/konnect.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" integrity="sha512-t7Few9xlddEmgd3oKZQahkNI4dS6l80+eGEzFQiqtyVYdvcSG2D3Iub77R20BdotfRPA9caaRkg1tyaJiPmO0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <h1 class="fade-in">konnect</h1>
        <nav class="nav">
          <a href="home.php">Home</a>
          <a href="projeto.php">Projetos</a>
        </nav>
        <div class="botoes fade-in">
          <a href="/frontend/html/login.html"><button id="botaoLogin">Login<i class="bi bi-box-arrow-in-right"></i></button></a>
        </div>
    </header>

    <form action="/konnect/backend/criarProjetos.php" method="POST" enctype="multipart/form-data">
        <div class="container fade-in">
            <div class="conteudo-container fade-in">
                <h1>Criar Novo Projeto</h1>
                <p>Preencha os dados abaixo para cadastrar um novo projeto</p>
              <label class="label fade-in">Imagem-projeto
    <div class="img fade-in">
        <div class="icon"><i class="bi bi-upload"></i></div>
        <div class="texto-img">Clique para fazer upload da imagem</div>
        <input type="file" name="imagem" id="imagem" style="position:absolute; width:100%; height:100%; opacity:0; cursor:pointer;">
    </div>
        </label>

                <div class="nome fade-in ">
                    <label for="Nome do Projeto">Nome do Projeto</label>
                    <input type="text" placeholder="Ex: ideiaHub" name="nome" id="nome" required> 
                </div>
                <div class="descricao fade-in">
                    <label for="descricao">Descricao</label>
                    <input type="text" placeholder="Ex: Desenvolver um app de controle financeiro pessoal com foco em jovens."  name="descricao" id="descricao" required> 
                </div>
                <div class="buscando fade-in">
                    <label for="Estamos buscando">Estamos Buscando</label>
                    <input type="text" placeholder="Ex: Desenvolvedor Front-End com experiência em React." name="buscando" id="buscando">
                </div>
                <div class="tecnologias fade-in">
                    <label for="Tecnologias">Tecnologias</label>
                    <input type="text" placeholder="Ex: React, Node.js, PostgreSQL" name="tecnologias" id="tecnologias">
                </div>

                <div class="previsao fade-in">
                    <div class="inicio">
                        <label for="inicio">Data de inicio</label>
                        <input type="date" name="inicio" id="inicio" placeholder="Ex: 15/10/2025">
                    </div>
                    <div class="fim">
                        <label for="fim">Data de termino</label>
                        <input type="date" name="fim" id="fim" placeholder="Ex: 30/11/2025">
                    </div>
                </div>
       
                <div class="button fade-in">
                    <a href="/konnect/frontend/html/projeto.php"><button type="submit">Criar Projeto</button></a></a>
                </div>
            </div>
        </div>  
    
</form>
    <footer>
      <h1>konnect</h1>
      <p>&copy; 2025 konnect, Conectando pessoas para grandes</p>
    </footer>
</body>
</html>