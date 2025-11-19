const areaBotao = document.querySelector('.botoes');
const botaoLogin = document.getElementById('botaoLogin');
const fotoSalva = localStorage.getItem('fotoUsuario');

if (fotoSalva && botaoLogin && areaBotao) {
    // hide the login link when we have a saved profile picture
    botaoLogin.style.display = 'none';

    const img = document.createElement('img');
    img.src = fotoSalva;
    img.alt = 'Foto de perfil';
    img.classList.add('foto-perfil');

    const fotoPreview = document.getElementById('fotoPreview');
    if (fotoPreview) fotoPreview.src = fotoSalva;

    areaBotao.appendChild(img);
}


document.addEventListener("DOMContentLoaded", () => {
    const sucesso = document.getElementById("notificacaoSucesso");

    function mostrarNotificacao(mensagem, redirectUrl) {
        sucesso.hidden = false;
        sucesso.innerHTML = `
            <div class="icon">✓</div>
            <span>${mensagem}</span>
        `;

        // Força o estado inicial antes de animar
        sucesso.classList.remove("entrada", "saida");

        requestAnimationFrame(() => {
            sucesso.classList.add("entrada");

            // Sai após 2,5s
            setTimeout(() => {
                sucesso.classList.remove("entrada");
                sucesso.classList.add("saida");
            }, 2500);
        });

        // Depois que a animação terminar → redireciona
        sucesso.addEventListener("transitionend", function end(e) {
            if (e.propertyName !== "transform") return;
            if (!sucesso.classList.contains("saida")) return;

            sucesso.hidden = true;
            sucesso.classList.remove("saida");
            sucesso.removeEventListener("transitionend", end);

            if (redirectUrl) {
                window.location.assign(redirectUrl);
            }
        });
    }

    // Exemplo: mostra ao carregar a página
    // Ajuste para seu fluxo de login
    mostrarNotificacao("Login realizado com sucesso!", "/konnect/frontend/html/home.php");
});




