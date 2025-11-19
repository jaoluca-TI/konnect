<?php 
    // Essa pagina vai verificar se o usuario esta logado

    session_start();
    if(isset($_SESSION['id'])){ //verifica se o usuario esta logado
        $logado = true;
        if(isset($_SESSION['img'])){ //Se existir a imagem do usuario ele usa a dele 
            $foto = $_SESSION['img'];

        }else{  //senao ele usa a padrao
            $foto = '/konnect/img/userimg.png'; 
        }
    } else{
        $logado = false; 
    }
?>