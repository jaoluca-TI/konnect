<?php
    include '../../backend/status.php';
    include __DIR__ . '/../../backend/protect.php';

    include __DIR__ . '/../../backend/conexao.php';

$fotoPerfil = "/konnect/img/default.jpg"; // fallback

if ($logado && isset($_SESSION['id'])) {

    $id_usuario = $_SESSION['id'];

    $sqlFoto = "SELECT foto_perfil FROM perfil_usuario WHERE id_usuario = '$id_usuario'";
    $resFoto = mysqli_query($conexao, $sqlFoto);

    if ($resFoto && mysqli_num_rows($resFoto) > 0) {
        $dados = mysqli_fetch_assoc($resFoto);

        if (!empty($dados['foto_perfil'])) {
            $fotoPerfil = "/konnect/img/" . $dados['foto_perfil'];
        }
    }
}

$perfil = [];

if ($logado && isset($_SESSION['id'])) {

    $id_usuario = $_SESSION['id'];

    $sqlPerfil = "SELECT nome FROM perfil_usuario WHERE id_usuario = '$id_usuario' LIMIT 1";
    $resPerfil = mysqli_query($conexao, $sqlPerfil);

    if ($resPerfil && mysqli_num_rows($resPerfil) > 0) {
        $perfil = mysqli_fetch_assoc($resPerfil);
    }
}


$nomeUsuario = ($logado && !empty($perfil['nome'])) ? $perfil['nome'] : '';

?> 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar projetos</title>
    <link rel="stylesheet" href="/konnect/frontend/css/criarProj.css">
    <link rel="shortcut icon" href="/konnect/img/konnectFav.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css" integrity="sha512-t7Few9xlddEmgd3oKZQahkNI4dS6l80+eGEzFQiqtyVYdvcSG2D3Iub77R20BdotfRPA9caaRkg1tyaJiPmO0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="/konnect/img/konnectIcon.png" alt="">
            <h1>onnect</h1>
        </div>
        <nav class="nav fade-in">
            <a href="/konnect/frontend/html/home.php">Home</a>
            <a href="/konnect/frontend/html/proj.php">Projetos</a>
        </nav>
             
        <?php if($logado): ?>
            <div class="status">
                <div class="foto-area">
                    <img src="<?php echo $fotoPerfil; ?>" alt="perfil" class="img-header">

                <div class="dropdown">
                    <a href="/konnect/frontend/html/viewPerfil.php">Ver Perfil</a>
                    <a href="/konnect/backend/sair.php">Sair <i class="bi bi-box-arrow-in-right"></i></a>
                </div>
            </div>

        <span class="nome-header">
            <?php echo htmlspecialchars($nomeUsuario); ?>
        </span>
    </div>

       <?php else: ?>
            <div class="botoes fade-in">
                <a href="/konnect/frontend/html/login.php"><button id="botaoLogin">Login<i class="bi bi-box-arrow-in-right"></i></button></a>
            </div>
        <?php endif; ?>
    </header>

    <form action="/konnect/backend/criarBack.php" method="POST" enctype="multipart/form-data">
        <div class="container fade-in">
            <div class="conteudo-container fade-in">
                <h1>Criar Novo Projeto</h1>
                <p>Preencha os dados abaixo para cadastrar um novo projeto</p>
            <label class="label fade-in">Imagem-projeto
                <div class="img fade-in" id="cont">
                    <div class="icon" id="icon"><i class="bi bi-upload"></i></div>
                        <div class="texto-img" id="tex">Clique para fazer upload da imagem</div>
                        <input type="file" name="imagem" id="imagemCriar" accept="image/*">
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
                    <button type="submit">Criar Projeto</button>
                </div>
            </div>
        </div>  
    
</form>
<script src="/konnect/frontend/js/criar.js"></script>   
    <footer>
        <div class="logo">
            <img src="/konnect/img/konnectIcon.png" alt="">
            <h1>onnect</h1>
        </div>
        <p>&copy; 2025 konnect, Conectando pessoas para grandes ideias</p>
    </footer>
    
</body>
</html>
