<?php
include __DIR__ . '/../../backend/status.php';
include __DIR__ . '/../../backend/protect.php';
include __DIR__ . '/../../backend/conexao.php';

$id_usuario = $_SESSION['id'] ?? null;

if (!$id_usuario) {
    header("Location: /konnect/frontend/html/login.php");
    exit;
}


$sql = "SELECT * FROM perfil_usuario WHERE id_usuario = '$id_usuario'";
$resultado = mysqli_query($conexao, $sql);
$perfil = mysqli_fetch_assoc($resultado);


$perfil = is_array($perfil) ? $perfil : [];

$banner = !empty($perfil['banner']) ? "/konnect/img/" . $perfil['banner'] : "/konnect/img/bannerDefault.png";
$foto = !empty($perfil['foto_perfil']) ? "/konnect/img/" . $perfil['foto_perfil'] : "/konnect/img/default.jpg";

$nome = $perfil['nome'] ?? "Nome não definido";
$titulo_profissional = $perfil['titulo_profissional'] ?? "Título não definido";
$localizacao = $perfil['localizacao'] ?? "Localização não informada";
$disponibilidade = $perfil['disponibilidade'] ?? "indisponivel";

$linkedin = $perfil['linkedin'] ?? "";
$github = $perfil['github'] ?? "";
$instagram = $perfil['instagram'] ?? "";
$portfolio = $perfil['portfolio'] ?? "";

$bio = $perfil['bio'] ?? "Nenhuma biografia foi informada ainda.";

$habilidades = !empty($perfil['habilidades']) ? explode(",", $perfil['habilidades']) : [];
$interesses = !empty($perfil['interesses']) ? explode(",", $perfil['interesses']) : [];
$colaboracao = !empty($perfil['colaboracao']) ? explode(",", $perfil['colaboracao']) : [];
$compensacao = !empty($perfil['compensacao']) ? explode(",", $perfil['compensacao']) : [];

$projeto_imagem = !empty($perfil['projeto_imagem']) ? "/konnect/img/" . $perfil['projeto_imagem'] : "";
$projeto_titulo = $perfil['projeto_titulo'] ?? "";
$projeto_url = $perfil['projeto_url'] ?? "";

$disponibilidade_semanal = $perfil['disponibilidade_semanal'] ?? "";


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


$nomeUsuario = ($logado && !empty($perfil['nome'])) ? $perfil['nome'] : '';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>konnect</title>
    <link rel="stylesheet" href="/konnect/frontend/css/viewPerfil.css">
    <link rel="shortcut icon" href="/konnect/img/konnectFav.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">
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

<main class="perfil-container fade-in">

    
    <div class="banner">
        <img src="<?php echo $banner; ?>" alt="Banner do perfil">
        <a href="/konnect/frontend/html/profile.php"><button>Editar perfil</button></a>
    </div>

    <section class="perfil-info">
        <div class="foto">
            <img src="<?php echo $foto; ?>" alt="Foto de perfil">
        </div>

        <div class="dados">
            <h2><?php echo $nome; ?></h2>
            <h3><?php echo $titulo_profissional; ?></h3>

            <p class="localizacao"><i class="bi bi-geo-alt-fill"></i> <?php echo $localizacao; ?></p>

            <?php if ($disponibilidade == "disponivel"): ?>
                <span class="profile-status">🟢 Disponível para novos projetos</span>
            <?php else: ?>
                <span class="profile-status" style="color:red;">🔴 Indisponível no momento</span>
            <?php endif; ?>
        </div>
    </section>

  
    <section class="redes">
        <h3>Redes e Contatos</h3>
        <div class="links">
            <?php if($linkedin): ?><a href="<?php echo $linkedin; ?>"><i class="bi bi-linkedin"></i> LinkedIn</a><?php endif; ?>
            <?php if($github): ?><a href="<?php echo $github; ?>"><i class="bi bi-github"></i> GitHub</a><?php endif; ?>
            <?php if($instagram): ?><a href="<?php echo $instagram; ?>"><i class="bi bi-instagram"></i> Instagram</a><?php endif; ?>
            <?php if($portfolio): ?><a href="<?php echo $portfolio; ?>"><i class="bi bi-globe"></i> Portfólio</a><?php endif; ?>
        </div>
    </section>

  
    <section class="biografia">
        <h3>Sobre mim</h3>
        <p><?php echo nl2br($bio); ?></p>
    </section>

    
    <section class="habilidades">
        <h3>Habilidades e Ferramentas</h3>
        <div class="tags">
            <?php 
                foreach($habilidades as $hab) {
                    if(trim($hab) !== "") echo "<span>" . trim($hab) . "</span>";
                }
            ?>
        </div>
    </section>

   
    <section class="interesses">
        <h3>O que estou buscando</h3>
        <ul>
            <?php foreach($interesses as $item): ?>
                <li>✔ <?php echo trim($item); ?></li>
            <?php endforeach; ?>
        </ul>
    </section>

  
    <section class="portfolio">
        <h3>Projetos Recentes</h3>

        <?php if($projeto_titulo || $projeto_imagem): ?>
        <div class="projetos">
            <div class="projeto-card">
                <?php if($projeto_imagem): ?>
                    <img src="<?php echo $projeto_imagem; ?>" alt="">
                <?php endif; ?>

                <h4><?php echo $projeto_titulo ?: "Projeto sem título"; ?></h4>

                <?php if($projeto_url): ?>
                    <a href="<?php echo $projeto_url; ?>" target="_blank">Ver projeto <i class="bi bi-box-arrow-up-right"></i></a>
                <?php endif; ?>
            </div>
        </div>
        <?php else: ?>
            <p>Nenhum projeto cadastrado ainda.</p>
        <?php endif; ?>
    </section>

 
    <section class="preferencias">
        <h3>Forma de Trabalho</h3>
        <div class="opcoes">
            <?php foreach($colaboracao as $op): ?>
                <span><?php echo trim($op); ?></span>
            <?php endforeach; ?>
        </div>
    </section>

   
    <section class="compensacao">
        <h3>Tipo de Colaboração</h3>
        <div class="opcoes">
            <?php foreach($compensacao as $op): ?>
                <span><?php echo trim($op); ?></span>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="disponibilidade-semanal">
        <h3>Disponibilidade semanal</h3>

        <?php if (!empty($disponibilidade_semanal)): ?>
            <p><?php echo htmlspecialchars($disponibilidade_semanal); ?> horas/semana</p>
        <?php else: ?>
            <p>Não informado</p>
        <?php endif; ?>
    </section>
   

</main>

<footer>
    <h1>konnect</h1>
    <p>&copy; 2025 konnect, Conectando pessoas para grandes ideias</p>
</footer>

    <script src="/konnect/frontend/js/viewPerfil.js"></script>

</body>
</html>