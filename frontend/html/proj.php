<?php
include '../../backend/status.php';
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
    <title>Projetos</title>
    <link rel="stylesheet" href="/konnect/frontend/css/proj.css">
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

    <div class="container fade-in">
        <div class="projetos fade-in">
            <h2>Projetos</h2>
            <p>Crie ou colabore. Sua ideia pode mudar tudo.</p>
        </div>

        <div class="button-projeto fade-in">
            <div class="filtrar">
                <button id="filtrarBtn"><i class="bi bi-funnel"></i>Filtrar</button>
            </div>
            <a href="criarProj.php"><button class="fade-in"><i class="bi bi-plus-lg fade-in"></i> Criar Projeto</button></a>
        </div>

            <div class="modal-conteudo" id="modal">
                <div class="close">
                    <h1>Filtro</h1>
                    <span id="fechar">&times;</span>
                </div>
            
            <div class="filtro-modal">
                <div class="filtro">
                    <label id="tipoLabel"><i class="bi bi-layers"></i>Tipo de Projeto</label>
                     <select class="select" id="tipo">
                        <option value="">App</option>
                        <option value="">Site</option>
                        <option value="">Jogo</option>
                        <option value="">Startup</option>
                        <option value="">E-commerce</option>
                        <option value="">Bot</option>
                        <option value="">API</option>
                        <option value="">Automação</option>
                     </select>
                </div>

                <div class="filtro">
                    <label for=""><i class="bi bi-code-slash"></i>Funções</label>
                    <select class="select" id="funcoes">
                        <option value="">Front-end</option>
                        <option value="">Back-end</option>
                        <option value="">Mobile</option>
                        <option value="">DevOps</option>
                        <option value="">DevOps</option>
                        <option value="">QA</option>
                        <option value="">Data</option>
                        <option value="">Game Dev</option>
                    </select>
                </div>

                <div class="filtro">
                    <label for=""><i class="bi bi-graph-up-arrow"></i>Nivel Desejado</label>
                    <select class="select" id="nivel">
                        <option value="">Iniciante</option>
                        <option value="">Intermediário</option>
                        <option value="">Avançado</option>
                        <option value="">Sênior</option>
                    </select>
                </div>

                <div class="filtro">
                    <label for=""><i class="bi bi-clock"></i>Dedicação Semanal</label>
                    <select class="select" id="dedicacao">
                        <option value="">1-3h</option>
                        <option value="">4-8h</option>
                        <option value="">10-20h</option>
                        <option value="">20h+</option>
                    </select>
                </div>

                <div class="filtro">
                    <label for=""><i class="bi bi-record-circle"></i>Estágio do Projeto</label>
                    <select class="select" id="estagio">
                        <option value="">Levamento</option>
                        <option value="">Análise</option>
                        <option value="">Projeto</option>
                        <option value="">Implementação</option>
                        <option value="">Testes</option>
                        <option value="">Implantação</option>
                        <option value="">Manutenção</option>
                    </select>
                </div>

            </div>
            <div class="botao-limpar">
                <button id="limpar"><i class="bi bi-eraser"></i>Limpar Filtros</button>
            </div>
            </div>

            </div>
       
            <div class="projeto-card fade-in">
            <?php
                include __DIR__. '/../../backend/carregarProjetos.php'
            ?>
 
    </div>

    <div class="voltar-proximo">
        <button id="prevBtn"><i class="bi bi-arrow-left"></i></button>
        <span>ou</span>
        <button id="nextBtn"><i class="bi bi-arrow-right"></i></button>
    </div>
          
    <div class="alteracao" id="alteracao"></div>
    
    <footer>
        <div class="logo">
            <img src="/konnect/img/konnectIcon.png" alt="">
            <h1>onnect</h1>
        </div>
        <p>&copy; 2025 konnect, Conectando pessoas para grandes ideias</p>
    </footer>

    <script src="/konnect/frontend/js/projetos.js"></script>
</body>
</html>
