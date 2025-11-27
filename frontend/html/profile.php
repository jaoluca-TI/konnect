<?php
include __DIR__ . '/../../backend/status.php';
include __DIR__ . '/../../backend/protect.php';
include __DIR__ . '/../../backend/conexao.php';

$fotoPerfil = "/konnect/img/default.jpg"; 
$bannerPerfil = "/konnect/img/bannerDefault.png";

$perfil = [
    "nome" => "",
    "titulo_profissional" => "",
    "localizacao" => "",
    "disponibilidade" => "disponivel",
    "linkedin" => "",
    "github" => "",
    "instagram" => "",
    "portfolio" => "",
    "behance" => "",
    "dribbble" => "",
    "bio" => "",
    "habilidades" => "",
    "interesses" => "",
    "colaboracao" => "",
    "compensacao" => "",
    "disponibilidade_semanal" => "",
    "projeto_titulo" => "",
    "projeto_url" => "",
    "projeto_imagem" => ""
];

if ($logado && isset($_SESSION['id'])) {

    $id_usuario = $_SESSION['id'];

    $sql = "SELECT * FROM perfil_usuario WHERE id_usuario = '$id_usuario'";
    $res = mysqli_query($conexao, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $perfil = mysqli_fetch_assoc($res);

        if (!empty($perfil["foto_perfil"])) {
            $fotoPerfil = "/konnect/img/" . $perfil["foto_perfil"];
        }
        if (!empty($perfil["banner"])) {
            $bannerPerfil = "/konnect/img/" . $perfil["banner"];
        }
    }
}
$nomeUsuario = ($logado && !empty($perfil['nome'])) ? $perfil['nome'] : '';


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
            <h1>Konnect</h1>
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

    <form id="formPerfil" action="/konnect/backend/perfil_usuario.php" method="POST" enctype="multipart/form-data">
        <main class="perfil-container">

           
            <section class="banner fade-in">
                <img id="bannerPreview" src="<?php echo $bannerPerfil; ?>" alt="Banner do perfil">
                <label for="bannerInput" class="btn-banner">Alterar Banner</label>
                <input type="file" id="bannerInput" name="banner" accept="image/*">
            </section>

           
            <section class="dados-pessoais fade-in">
                <div class="foto-container">
                    <img id="fotoPreview" src="<?php echo $fotoPerfil; ?>" class="foto-perfil" alt="Foto de perfil">
                    <label for="fotoInput" class="btn-foto">Alterar foto</label>
                    <input type="file" id="fotoInput" name="foto_perfil" accept="image/*">
                </div>

                <div class="info-basica fade-in">
                    <label>Nome:</label>
                    <input type="text" id="nome" name="nome"
                        value="<?php echo htmlspecialchars($perfil['nome']); ?>"
                        placeholder="Digite seu nome completo">

                    <label>Título Profissional:</label>
                    <input type="text" id="titulo" name="titulo_profissional"
                        value="<?php echo htmlspecialchars($perfil['titulo_profissional']); ?>"
                        placeholder="Ex: Desenvolvedor Full Stack">

                    <label>Localização:</label>
                    <input type="text" id="localizacao" name="localizacao"
                        value="<?php echo htmlspecialchars($perfil['localizacao']); ?>"
                        placeholder="Ex: São Paulo, Brasil">

                    <label>Disponibilidade:</label>
                    <select id="disponibilidade" name="disponibilidade">
                        <option value="disponivel" <?php if($perfil["disponibilidade"]=="disponivel") echo "selected"; ?>>Disponível</option>
                        <option value="indisponivel" <?php if($perfil["disponibilidade"]=="indisponivel") echo "selected"; ?>>Indisponível</option>
                    </select>
                </div>
            </section>

            
            <section class="redes-sociais fade-in">
                <h3>Redes Sociais</h3>
                <div class="grid-redes">
                    <input type="url" name="linkedin" value="<?php echo htmlspecialchars($perfil['linkedin']); ?>" placeholder="LinkedIn (ex: https://linkedin.com/in/seunome)">
                    <input type="url" name="github" value="<?php echo htmlspecialchars($perfil['github']); ?>" placeholder="GitHub (ex: https://github.com/seunome)">
                    <input type="url" name="instagram" value="<?php echo htmlspecialchars($perfil['instagram']); ?>" placeholder="Instagram (opcional)">
                    <input type="url" name="portfolio" value="<?php echo htmlspecialchars($perfil['portfolio']); ?>" placeholder="Portfólio pessoal">
                    <input type="url" name="behance" value="<?php echo htmlspecialchars($perfil['behance']); ?>" placeholder="Behance (opcional)">
                    <input type="url" name="dribbble" value="<?php echo htmlspecialchars($perfil['dribbble']); ?>" placeholder="Dribbble (opcional)">
                </div>
            </section>

       
            <section class="biografia fade-in">
                <h3>Biografia</h3>
                <textarea id="bio" name="bio" rows="4"><?php echo htmlspecialchars($perfil['bio']); ?></textarea>
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
                    <button type="button" id="addHabilidade"><i class="bi bi-plus-lg"></i> Adicionar</button>
                </div>

                <input type="hidden" id="listaHabilidadesInput" name="habilidades"
                    value="<?php echo htmlspecialchars($perfil['habilidades']); ?>">

                <div id="listaHabilidades" class="tags"></div>
            </section>

            <?php $interessesMarcados = explode(", ", $perfil["interesses"]); ?>

            <section class="interesses-objetivos fade-in">
                <h3>Interesses e Objetivos</h3>
                <div class="opcoes">
                    <label><input type="checkbox" name="interesses[]" value="Procurando equipe" <?php if(in_array("Procurando equipe", $interessesMarcados)) echo "checked"; ?>> Procurando equipe</label>
                    <label><input type="checkbox" name="interesses[]" value="Colaborar em projeto existente" <?php if(in_array("Colaborar em projeto existente", $interessesMarcados)) echo "checked"; ?>> Colaborar em projeto</label>
                    <label><input type="checkbox" name="interesses[]" value="Mentorar alguém" <?php if(in_array("Mentorar alguém", $interessesMarcados)) echo "checked"; ?>> Mentorar alguém</label>
                    <label><input type="checkbox" name="interesses[]" value="Aprender com outros profissionais" <?php if(in_array("Aprender com outros profissionais", $interessesMarcados)) echo "checked"; ?>> Aprender com outros profissionais</label>
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
                                <label>Nome do projeto</label>
                                <input type="text" id="projetoTituloInput" name="projetoTitulo"
                                value="<?php echo htmlspecialchars($perfil['projeto_titulo']); ?>">
                            </div>

                            <div class="input-box">
                                <label>Link do projeto</label>
                                <input type="url" id="projetoUrlInput" name="projetoUrl"
                                value="<?php echo htmlspecialchars($perfil['projeto_url']); ?>">
                            </div>

                            <div class="save">
                                <button type="button" id="salvar-modal">Salvar</button>
                                <button type="button" id="cancelar-modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

           
            <input type="hidden" id="hiddenTitulo" name="projetoTitulo" value="<?php echo htmlspecialchars($perfil['projeto_titulo']); ?>">
            <input type="hidden" id="hiddenUrl" name="projetoUrl" value="<?php echo htmlspecialchars($perfil['projeto_url']); ?>">
            <input type="hidden" id="hiddenImagemNome" name="projetoImagemNome" value="<?php echo htmlspecialchars($perfil['projeto_imagem']); ?>">

      
            <?php 
                $colabMarcado = explode(", ", $perfil["colaboracao"]);
                $compMarcado = explode(", ", $perfil["compensacao"]);
            ?>

            <section class="colaboracao fade-in">
                <h3>Preferências de Colaboração</h3>
                <div class="opcoes">
                    <label><input type="checkbox" name="colaboracao[]" value="Remota" <?php if(in_array("Remota",$colabMarcado)) echo "checked"; ?>> Remota</label>
                    <label><input type="checkbox" name="colaboracao[]" value="Híbrida" <?php if(in_array("Híbrida",$colabMarcado)) echo "checked"; ?>> Híbrida</label>
                    <label><input type="checkbox" name="colaboracao[]" value="Presencial" <?php if(in_array("Presencial",$colabMarcado)) echo "checked"; ?>> Presencial</label>
                </div>

                <h3>Modalidade de Compensação</h3>
                <div class="opcoes">
                    <label><input type="checkbox" name="compensacao[]" value="Voluntária" <?php if(in_array("Voluntária",$compMarcado)) echo "checked"; ?>> Voluntária</label>
                    <label><input type="checkbox" name="compensacao[]" value="Remunerada" <?php if(in_array("Remunerada",$compMarcado)) echo "checked"; ?>> Remunerada</label>
                </div>

                <h3>Disponibilidade semanal</h3>
                <input type="text" name="disponibilidadeSemanal"
                       value="<?php echo htmlspecialchars($perfil['disponibilidade_semanal']); ?>"
                       placeholder="Ex: 10h/semana">
            </section>

            <section class="salvarOrNo fade-in">
                <a href="/konnect/frontend/html/viewPerfil.php"><button type="submit" id="salvarMudancas">Salvar</button></a>
                <button type="button" id="cancelar">Cancelar</button>
            </section>

        </main>

        <div class="notificacao" id="notificacao"></div>
        <div class="mudancas" id="mudancas"></div>
    </form>



    <footer>
        <div class="logo">
            <img src="/konnect/img/konnectIcon.png" alt="">
            <h1>onnect</h1>
        </div>
        <p>&copy; 2025 konnect, Conectando pessoas para grandes ideias</p>
    </footer>
        
    <script src="/konnect/frontend/js/profile.js"></script>

</body>
</html>