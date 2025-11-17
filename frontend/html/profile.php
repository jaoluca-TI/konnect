<?php
include __DIR__ . '/../../backend/status.php';
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


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Perfil</title>
    <link rel="stylesheet" href="/konnect/frontend/css/profile.css">
    <link rel="shortcut icon" href="/konnect/img/konnectFav.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                    <img src="<?php echo $fotoPerfil; ?>" alt="perfil">
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

    <form id="formPerfil" action="/konnect/backend/perfil_usuario.php" method="POST" enctype="multipart/form-data">
        <main class="perfil-container">

            <section class="banner fade-in">
                <img id="bannerPreview" src="/konnect/img/bannerDefault.png" alt="Banner do perfil">
                <label for="bannerInput" class="btn-banner">Alterar Banner</label>
                <input type="file" id="bannerInput" name="banner" accept="image/*">
            </section>

            <section class="dados-pessoais fade-in">
                <div class="foto-container">
                    <img id="fotoPreview" src="/konnect/img/default.jpg" class="foto-perfil" alt="Foto de perfil">
                    <label for="fotoInput" class="btn-foto">Alterar foto</label>
                    <input type="file" id="fotoInput" name="foto_perfil" accept="image/*">
                </div>

                <div class="info-basica fade-in">
                    <label>Nome:</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo">

                    <label>Título Profissional:</label>
                    <input type="text" id="titulo" name="titulo_profissional" placeholder="Ex: Desenvolvedor Full Stack">

                    <label>Localização:</label>
                    <input type="text" id="localizacao" name="localizacao" placeholder="Ex: São Paulo, Brasil">

                    <label>Disponibilidade:</label>
                    <select id="disponibilidade" name="disponibilidade">
                        <option value="disponivel">Disponível</option>
                        <option value="indisponivel">Indisponível</option>
                    </select>
                </div>
            </section>

            <section class="redes-sociais fade-in">
                <h3>Redes Sociais</h3>
                <div class="grid-redes">
                    <input type="url" name="linkedin" placeholder="LinkedIn (ex: https://linkedin.com/in/seunome)">
                    <input type="url" name="github" placeholder="GitHub (ex: https://github.com/seunome)">
                    <input type="url" name="instagram" placeholder="Instagram (opcional)">
                    <input type="url" name="portfolio" placeholder="Portfólio pessoal (ex: https://seusite.dev)">
                    <input type="url" name="behance" placeholder="Behance (opcional)">
                    <input type="url" name="dribbble" placeholder="Dribbble (opcional)">
                </div>
            </section>

            <section class="biografia fade-in">
                <h3>Biografia</h3>
                <textarea id="bio" name="bio" rows="4" placeholder="Conte um pouco sobre você..."></textarea>
            </section>

            <section class="habilidades fade-in">
                <h3>Habilidades e Áreas de Atuação</h3>
                <div class="add-habilidade">
                    <input type="text" id="habilidade"  placeholder="Digite uma habilidade...">
                    <select id="nivel">
                        <option value="Iniciante">Iniciante</option>
                        <option value="Intermediário">Intermediário</option>
                        <option value="Avançado">Avançado</option>
                    </select>
                    <button type="button" id="addHabilidade"><i class="bi bi-plus-lg"></i> Adicionar</button>
                </div>
                <input type="hidden" id="listaHabilidadesInput" name="habilidades">
                <div id="listaHabilidades" class="tags"></div>
            </section>

            <section class="interesses-objetivos fade-in">
                <h3>Interesses e Objetivos</h3>
                <div class="opcoes">
                    <label><input type="checkbox" name="interesses[]" value="Procurando equipe"> Procurando equipe</label>
                    <label><input type="checkbox" name="interesses[]" value="Colaborar em projeto existente"> Colaborar em projeto</label>
                    <label><input type="checkbox" name="interesses[]" value="Mentorar alguém"> Mentorar alguém</label>
                    <label><input type="checkbox" name="interesses[]" value="Aprender com outros profissionais"> Aprender com outros profissionais</label>
                </div>
            </section>

            <section class="portfolio fade-in">
                <h3>Projetos e Trabalhos anteriores</h3>
                <div class="container-portfolio">
                    <button type="button" id="openModalBtn"><i class="bi bi-plus-lg"></i>Adicionar Projetos</button>

                    <div class="modal" id="myModal">
                        <div class="modal-content fade-in">
                            <div class="topo">
                                <h1 id="topoh1">Projeto 1</h1>
                                <span class="close">&times;</span>
                            </div>

                            <div class="img">
                                <label for="projeto_imagem">Imagem-projeto</label>
                                <div class="content-img" id="content-img">
                                    <i class="bi bi-upload" id="iconeImg"></i>
                                    <p id="pImg">Clique para fazer upload da imagem</p>
                                    <input type="file" id="projetoImagemInput" name="projeto_imagem" class="input-img" accept="image/*">
                                </div>
                            </div>

                            <div class="input-box">
                              <label for="projeto_titulo">Nome do projeto</label>
                              <input type="text" placeholder="Ex: konnect"  id="projetoTituloInput" name="projetoTitulo">
                            </div>

                            <div class="input-box">
                              <label for="projeto_url">Link do projeto</label>
                              <input type="url" id="projetoUrlInput" name="projetoUrl" placeholder="https://...">
                            </div>

                            <div class="save">
                              <button type="button" id="salvar-modal">Salvar</button>
                              <button type="button" id="cancelar-modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

                        <!-- Hidden fields usados pelo JS/PHP para enviar dados do modal -->
                        <input type="hidden" id="hiddenTitulo" name="projetoTitulo" value="">
                        <input type="hidden" id="hiddenUrl" name="projetoUrl" value="">
                        <input type="hidden" id="hiddenImagemNome" name="projetoImagemNome" value="">

            <section class="colaboracao fade-in">
                <h3>Preferências de Colaboração</h3>
                <div class="opcoes">
                    <label><input type="checkbox" name="colaboracao[]" value="Remota"> Remota</label>
                    <label><input type="checkbox" name="colaboracao[]" value="Híbrida"> Híbrida</label>
                    <label><input type="checkbox" name="colaboracao[]" value="Presencial"> Presencial</label>
                </div>

                <h3>Modalidade de Compensação</h3>
                <div class="opcoes">
                    <label><input type="checkbox" name="compensacao[]" value="Voluntária"> Voluntária</label>
                    <label><input type="checkbox" name="compensacao[]" value="Remunerada"> Remunerada</label>
                </div>

                <h3>Disponibilidade semanal</h3>
                <input type="text" name="disponibilidadeSemanal" placeholder="Ex: 10h/semana">
            </section>

            <section class="salvarOrNo fade-in">
                <button type="submit" id="salvarMudancas">Salvar</button>
                <button type="button" id="cancelar">Cancelar</button>
            </section>

        </main>

        <div class="notificacao" id="notificacao"></div>
        <div class="mudancas" id="mudancas"></div>
    </form>

    <script src="/konnect/frontend/js/profile.js"></script>

    <footer>
        <div class="logo">
            <img src="/konnect/img/konnectIcon.png" alt="">
            <h1>onnect</h1>
        </div>
        <p>&copy; 2025 konnect, Conectando pessoas para grandes ideias</p>
    </footer>

</body>
</html>