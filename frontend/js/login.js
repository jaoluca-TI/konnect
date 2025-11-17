document.addEventListener("DOMContentLoaded", () => {
    const sucesso = document.getElementById("notificacaoSucesso");
    const erro = document.getElementById("notificacaoError");

    if (sucesso) {
        sucesso.style.display = "flex";
        // Espera o usuário ver a mensagem e redireciona para a home
        setTimeout(() => {
            window.location.href = "/konnect/frontend/html/home.php";
        }, 2000);

        return;
    }

    if (erro) {
        erro.style.display = "flex";
        setTimeout(() => {
            erro.style.opacity = 0;
            setTimeout(() => {
                erro.style.display = "none";
            }, 500);
        }, 4000);
    }
});
