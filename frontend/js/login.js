document.addEventListener("DOMContentLoaded", () => {
    const erro = document.getElementById("notificacaoError");

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

document.addEventListener("DOMContentLoaded", () => {
    const erro = document.getElementById("notificacaoError");

    function mostrarNotificacao(mensagem, redirectUrl) {
        erro.hidden = false;
        erro.innerHTML = `
            <div class="icon">✖</div>
            <span>${mensagem}</span>
        `;

        // Força o estado inicial antes de animar
        erro.classList.remove("entrada", "saida");

        requestAnimationFrame(() => {
            erro.classList.add("entrada");

            // Sai após 2,5s
            setTimeout(() => {
                erro.classList.remove("entrada");
                erro.classList.add("saida");
            }, 2500);
        });

        // Depois que a animação terminar → redireciona
        erro.addEventListener("transitionend", function end(e) {
            if (e.propertyName !== "transform") return;
            if (!erro.classList.contains("saida")) return;

            erro.hidden = true;
            erro.classList.remove("saida");
            erro.removeEventListener("transitionend", end);

            if (redirectUrl) {
                window.location.assign(redirectUrl);
            }
        });
    }

    // Exemplo: mostra ao carregar a página
    // Ajuste para seu fluxo de login
    mostrarNotificacao("Email ou senha inválidos!", "/konnect/frontend/html/login.php");

});
