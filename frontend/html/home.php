<?php
    include '../../backend/status.php';
    $login_success = $_SESSION['login_success'] ?? null;
    unset($_SESSION['login_success']);

    include __DIR__ . '/../../backend/conexao.php';

    $fotoPerfil = "/konnect/img/default.jpg";

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
    <title>konnect</title>
    <link rel="stylesheet" href="/konnect/frontend/css/home.css">
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



        <?php else: ?>
            <div class="botoes fade-in">
                <a href="/konnect/frontend/html/login.php"><button id="botaoLogin">Login<i class="bi bi-box-arrow-in-right"></i></button></a>
            </div>
        <?php endif; ?>
    </header>
    

    <?php if ($login_success === "success"): ?>
        <div id="notificacaoSucesso" data-msg="Login realizado com sucesso"></div>
    <?php endif; ?>

    <main class="">

         <section class="section-comecar">
            <div class="comecar">
                <h1>Junte-se ao konnect</h1>
                <p>Escolha como você quer começar sua jornada no Konnect</p>
                <div class="cardComecar">
                    <div class="card-comecar">
                        <i class="bi bi-search"></i>
                        <h2>Explorar Projetos</h2>
                        <p>Descubra projetos incríveis e encontre oportunidades de colaboração que combinam com você</p>
                        <a href="/konnect/frontend/html/proj.php"><button>Explorar agora</button></a>
                    </div>
                    <?php if(!$logado): ?>
                    <div class="card-comecar">
                        <i class="bi bi-plus-lg"></i>
                        <h2>Criar Projeto</h2>
                        <p>Compartilhe sua ideia e forme um time de talentos para transformá-la em realidade</p>
                        <a href="/konnect/frontend/html/login.php"><button>Criar agora</button></a>
                    </div>
                    <?php else: ?>
                        <div class="card-comecar">
                        <i class="bi bi-plus-lg"></i>
                        <h2>Criar Projeto</h2>
                        <p>Compartilhe sua ideia e forme um time de talentos para transformá-la em realidade</p>
                        <a href="/konnect/frontend/html/criarProj.php"><button>Criar agora</button></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="beneficios-konnect">
                <h1>Benefícios de usar o Konnect</h1>
                <p>Descubra tudo o que você pode conquistar ao fazer parte da nossa comunidade</p>
                <div class="container-beneficios">
                    <div class="esquerda">
                       <div class="conteudo-esquerda">
                            <div class="card-esquerda">
                                <i class="bi bi-people-fill"></i>
                                <h2>Colaboração</h2>
                                <p>Trabalhe em equipe com profissionais de diferentes áreas e crie soluções inovadoras juntos.</p>
                            </div>
                            <div class="card-esquerda">
                                <i class="bi bi-diagram-3-fill"></i>
                                <h2>Networking</h2>
                                <p>Construa relacionamentos valiosos que podem abrir portas e criar oportunidades únicas.</p>
                            </div>
                        </div>
                    </div>
                    <div class="direita">
                        <div class="conteudo-direita">
                            <div class="card-direita">
                                <i class="bi bi-eye-fill"></i>
                                <h2>Visibilidade</h2>
                                <p>Mostre seu trabalho para uma comunidade global e ganhe reconhecimento por suas conquistas.</p>
                            </div>
                            <div class="card-direita">
                                <i class="bi bi-bullseye"></i>
                                <h2>Impacto Real</h2>
                                <p>Participe de projetos que transformam ideias em produtos e serviços que fazem diferença.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
        <section class="section">
            <div class="categoria">
                <h1>Categorias de Projeto</h1>
                <p>Explore projetos nas áreas que mais te interessam</p>
                <div class="container-categoria">
                    <div class="card-categoria">
                        <i class="bi bi-code"></i>
                        <p>Tecnologia</p>
                    </div>
                    <div class="card-categoria">
                        <i class="bi bi-mortarboard"></i>
                        <p>Educação</p>
                    </div>
                    <div class="card-categoria">
                        <i class="bi bi-leaf"></i>
                        <p>Sustentabilidade</p>
                    </div>
                    <div class="card-categoria">
                        <i class="bi bi-palette"></i>
                        <p>Design</p>
                    </div>
                    <div class="card-categoria">
                        <i class="bi bi-controller"></i>
                        <p>Games</p>
                    </div>
                    <div class="card-categoria">
                        <i class="bi bi-lightbulb"></i>
                        <p>Startups</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="section ">
            <div class="apresentacao ">
                <div class="apresentacao-titulo">
                    <h1>konnect</h1>
                    <p>Onde ideias encontram quem faz acontecer.</p>
                </div>
                <div class="apresentacao-texto">
                    <p>konnect é uma plataforma que une criadores, desenvolvedores e inovadores em um só lugar. Aqui, ideias ganham vida por meio da colaboração. Compartilhe sua visão, encontre pessoas talentosas e transforme conceitos em grandes projetos. Crie equipes, troque experiências e participe de comunidades que impulsionam a criatividade e o impacto.</p>
                    <p>No konnect, a inovação acontece quando pessoas com propósito se conectam. É onde mentes inquietas se encontram para cocriar soluções, acelerar ideias e construir o futuro. Seja para tirar um projeto do papel ou escalar uma iniciativa, o Konnect é o ponto de partida para quem quer fazer a diferença.</p>
                </div>
            </div>
        </section>

    </main>
    <footer>
        <div class="logo">
            <img src="/konnect/img/konnectIcon.png" alt="">
            <h1>onnect</h1>
        </div>
        <p>&copy; 2025 konnect, Conectando pessoas para grandes ideias</p>
    </footer>

    <script src="/konnect/frontend/js/home.js"></script>

    
</body>
</html>                