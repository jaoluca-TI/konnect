<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "konnect";

   $conexao = mysqli_connect($servidor,$usuario,$senha,$banco);
    if(!$conexao){
        die("Falha na conexao com o Banco de Dados".mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $buscando = $_POST['buscando'];
    $tecnologias = $_POST['tecnologias'];
    $inicio = $_POST['inicio'];
    $fim = $_POST['fim'];

    
    $imagem_nome = "";
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $pasta = __DIR__ . "/../img/";
        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagem_nome = uniqid() . "." . $extensao;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $pasta . $imagem_nome);
    }

    
    $sql = "INSERT INTO projetos (nome, descricao, buscando, tecnologias, data_inicio, data_fim, imagem)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssssss", $nome, $descricao, $buscando, $tecnologias, $inicio, $fim, $imagem_nome);

    if ($stmt->execute()) {
        $stmt->close();
        $conexao->close();
        header("Location: /konnect/frontend/html/proj.php?msg=sucesso");
        exit();
    } else {
        $stmt->close();
        $conexao->close();
        header("Location: /konnect/frontend/html/criarProj.php?msg=erro");
        exit();
    }
}
?>



