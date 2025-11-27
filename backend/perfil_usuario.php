<?php
include __DIR__ . '/conexao.php';
include __DIR__ . '/protect.php';
session_start();

while (ob_get_level()) ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

$id_usuario = $_SESSION['id'] ?? null;
if (!$id_usuario) {
    echo json_encode(["status" => "error", "message" => "Usuário não autenticado."]);
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $sql = "SELECT * FROM perfil_usuario WHERE id_usuario = '$id_usuario'";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $perfil = mysqli_fetch_assoc($resultado);
        echo json_encode(["status" => "success", "data" => $perfil]);
    } else {
        echo json_encode(["status" => "empty"]);
    }
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    function sanitize($value) {
        global $conexao;
        return mysqli_real_escape_string($conexao, trim($value ?? ''));
    }

    $nome = sanitize($_POST['nome'] ?? '');
    $titulo_profissional = sanitize($_POST['titulo_profissional'] ?? ($_POST['titulo'] ?? ''));
    $localizacao = sanitize($_POST['localizacao'] ?? '');
    $disponibilidade = sanitize($_POST['disponibilidade'] ?? '');
    $linkedin = sanitize($_POST['linkedin'] ?? '');
    $github = sanitize($_POST['github'] ?? '');
    $instagram = sanitize($_POST['instagram'] ?? '');
    $portfolio = sanitize($_POST['portfolio'] ?? '');
    $behance = sanitize($_POST['behance'] ?? '');
    $dribbble = sanitize($_POST['dribbble'] ?? '');
    $bio = sanitize($_POST['bio'] ?? '');
    $habilidades = sanitize($_POST['habilidades'] ?? '');
    $disponibilidade_semanal = sanitize($_POST['disponibilidadeSemanal'] ?? '');

  
    $interesses = isset($_POST['interesses']) ? sanitize(implode(', ', $_POST['interesses'])) : '';
    $colaboracao = isset($_POST['colaboracao']) ? sanitize(implode(', ', $_POST['colaboracao'])) : '';
    $compensacao = isset($_POST['compensacao']) ? sanitize(implode(', ', $_POST['compensacao'])) : '';

 
    $projeto_titulo = sanitize($_POST['projetoTitulo'] ?? $_POST['projeto_titulo'] ?? '');
    $projeto_url = sanitize($_POST['projetoUrl'] ?? $_POST['projeto_url'] ?? '');

   
    $projeto_imagem_nome = sanitize($_POST['projetoImagemNome'] ?? '');

  
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/konnect/img/";

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    function salvarImagem($inputName, $uploadDir) {
        if (!empty($_FILES[$inputName]['name'])) {
            $nome = time() . "_" . basename($_FILES[$inputName]['name']);
            move_uploaded_file($_FILES[$inputName]['tmp_name'], $uploadDir . $nome);
            return $nome; 
        }
        return null;
    }

    $foto_perfil = salvarImagem("foto_perfil", $uploadDir);
    $banner = salvarImagem("banner", $uploadDir);
    $projeto_imagem = salvarImagem("projeto_imagem", $uploadDir);

   
    if (!$projeto_imagem && !empty($projeto_imagem_nome)) {
        if (file_exists($uploadDir . $projeto_imagem_nome)) {
            $projeto_imagem = $projeto_imagem_nome;
        }
    }


    $sql_check = "SELECT id FROM perfil_usuario WHERE id_usuario = '$id_usuario'";
    $resultado = mysqli_query($conexao, $sql_check);

    if (mysqli_num_rows($resultado) > 0) {
        
        $sql = "UPDATE perfil_usuario SET
            nome='$nome',
            titulo_profissional='$titulo_profissional',
            localizacao='$localizacao',
            disponibilidade='$disponibilidade',
            linkedin='$linkedin',
            github='$github',
            instagram='$instagram',
            portfolio='$portfolio',
            behance='$behance',
            dribbble='$dribbble',
            bio='$bio',
            habilidades='$habilidades',
            interesses='$interesses',
            colaboracao='$colaboracao',
            compensacao='$compensacao',
            disponibilidade_semanal='$disponibilidade_semanal',
            projeto_titulo='$projeto_titulo',
            projeto_url='$projeto_url'";

        if ($foto_perfil) $sql .= ", foto_perfil='$foto_perfil'";
        if ($banner) $sql .= ", banner='$banner'";
        if ($projeto_imagem) $sql .= ", projeto_imagem='$projeto_imagem'";

        $sql .= " WHERE id_usuario='$id_usuario'";

    } else {

        $sql = "INSERT INTO perfil_usuario 
        (id_usuario, nome, titulo_profissional, localizacao, disponibilidade, linkedin, github, instagram, portfolio, behance, dribbble, bio, habilidades, interesses, colaboracao, compensacao, disponibilidade_semanal, foto_perfil, banner, projeto_titulo, projeto_url, projeto_imagem)
        VALUES (
            '$id_usuario', '$nome', '$titulo_profissional', '$localizacao', '$disponibilidade',
            '$linkedin', '$github', '$instagram', '$portfolio', '$behance', '$dribbble',
            '$bio', '$habilidades', '$interesses', '$colaboracao', '$compensacao', '$disponibilidade_semanal',
            '$foto_perfil', '$banner', '$projeto_titulo', '$projeto_url', '$projeto_imagem')";
    }

    if (mysqli_query($conexao, $sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($conexao)]);
    }
    exit;
}

echo json_encode(["status" => "error", "message" => "Método inválido."]);
exit;