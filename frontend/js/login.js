document.addEventListener("DOMContentLoaded", () => {
    const erroEl = document.getElementById("notificacaoError");

    function mostrarNotificacaoErro(mensagem) {
        if (!erroEl) return;
        erroEl.hidden = false;
        erroEl.innerHTML = `\n            <div class="icon">✖</div>\n            <span>${mensagem}</span>\n        `;

        erroEl.classList.remove("entrada", "saida");
        requestAnimationFrame(() => erroEl.classList.add("entrada"));

        setTimeout(() => {
            erroEl.classList.remove("entrada");
            erroEl.classList.add("saida");
        }, 2500);

        erroEl.addEventListener("transitionend", function end(e) {
            if (e.propertyName !== "transform") return;
            if (!erroEl.classList.contains("saida")) return;

            erroEl.hidden = true;
            erroEl.classList.remove("saida");
            erroEl.removeEventListener("transitionend", end);
        });
    }

    function redirecionarHome() {
        // Apenas redireciona para a home — a notificação de sucesso é exibida lá pelo servidor
        window.location.assign('/konnect/frontend/html/home.php');
    }

    // Se o servidor já deixou uma mensagem (render server-side), mostra-a
    if (erroEl && erroEl.textContent.trim() !== '') {
        mostrarNotificacaoErro(erroEl.textContent.trim());
    }

    // Intercepta o submit do formulário para usar fetch (AJAX)
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            try {
                const resp = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const data = await resp.json();
                if (data.status === 'success') {
                    redirecionarHome();
                } else {
                    mostrarNotificacaoErro(data.message || 'Erro no login');
                }
            } catch (err) {
                mostrarNotificacaoErro('Erro interno.');
            }
        });
    }

});


