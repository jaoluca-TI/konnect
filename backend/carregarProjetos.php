<?php
include 'conexao.php';

$sql = "SELECT * FROM projetos";
$resultado = mysqli_query($conexao, $sql);

if (mysqli_num_rows($resultado) > 0) {
    while ($projeto = mysqli_fetch_assoc($resultado)) {
        $tecnologias = explode(',', $projeto['tecnologias']);
        $temas = explode(',', $projeto['temas'] ?? $projeto['tecnologias']);
        $buscando = explode(',', $projeto['buscando'] ?? '');
        $imagemPath = '/konnect/img/' . htmlspecialchars($projeto['imagem']);

        echo '
        <div class="card fade-in">
            <img src="' . $imagemPath . '" alt="' . htmlspecialchars($projeto['nome']) . '">
            <div class="conteudo-card fade-in">
                <h3>' . htmlspecialchars($projeto['nome']) . '</h3>
                <p>' . htmlspecialchars($projeto['descricao']) . '</p>

                <div class="tec fade-in">
                    <h5>Tecnologias</h5>
                    <div class="spantec fade-in">';
                        foreach ($tecnologias as $tec) {
                            echo '<span>' . htmlspecialchars(trim($tec)) . '</span>';
                        }
        echo        '</div>
                </div>

                <div class="topicos fade-in">
                    <h5>Temas</h5>
                    <div class="span-topicos fade-in">';
                        foreach ($temas as $tema) {
                            echo '<span>' . htmlspecialchars(trim($tema)) . '</span>';
                        }
        echo        '</div>
                </div>

                <div class="vagas fade-in">
                    <h5><i class="bi bi-people-fill fade-in"></i> Estamos buscando</h5>
                    <div class="vagas-span fade-in">';
                        foreach ($buscando as $vaga) {
                            if (trim($vaga) !== '') {
                                echo '<span>' . htmlspecialchars(trim($vaga)) . '</span>';
                            }
                        }
        echo        '</div>
                </div>

                <div class="data fade-in">
                    <span class="date">
                        <i class="bi bi-calendar"></i> Início: ' . date("d/m/Y", strtotime($projeto['data_inicio'])) . ' – 
                        <i class="bi bi-calendar"></i> Fim: ' . date("d/m/Y", strtotime($projeto['data_fim'])) . '
                    </span>
                </div>

                <div class="contato fade-in">
                    <button class="contato-btn"><i class="bi bi-envelope-fill"></i></button>
                    <div class="like">
                        <i class="bi bi-heart like-icon"></i>
                        <span class="like-count">0</span>
                    </div>
                </div>
            </div>
        </div>';
    }
} else {
    echo'<div class="container-nenhum">
            <div class="nenhum-projeto">
                <i class="bi bi-folder-plus"></i>
                <h1>Nenhum projeto por aqui… por enquanto.</h1>
                <p>Crie o primeiro e comece a organizar suas ideias.</p>
                <hr>
                <div class="nenhum-sugestoes">
                    <p>Sugestões do que você pode criar:</p>
                    <div class="nenhum-spans">
                        <span>Ideia inicial</span>
                        <span>Website</span>
                        <span>Portfolio</span>
                        <span>App Mobile</span>
                    </div>
                </div>
            </div>
        </div>';
}
?>

