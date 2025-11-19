<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "konnect";

    $conexao = mysqli_connect($servidor,$usuario,$senha,$banco);
    if(!$conexao){
        die("Falha na conexao com o Banco de Dados".mysqli_connect_error());
    }
?>