const areaBotao = document.querySelector('.botoes');
const botaoLogin = document.getElementById('botaoLogin');
const fotoSalva = localStorage.getItem('fotoUsuario');

if (fotoSalva && botaoLogin && areaBotao) {
    
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
    // Não mostrar notificação automaticamente; mostrar apenas se o servidor deixou
    // o elemento `#notificacaoSucesso` (renderizado quando login foi bem-sucedido).
    const sucessoEl = document.getElementById("notificacaoSucesso");
    if (sucessoEl) {
        // pega a mensagem do atributo data-msg (se houver)
        const mensagem = sucessoEl.dataset.msg || 'Login realizado com sucesso';

        (function(){
            let div = document.createElement('div');
            div.className = 'notificacao notificacao-animada';
            div.textContent = mensagem;
            document.body.appendChild(div);

            // Força reflow para garantir que a animação será aplicada
            void div.offsetWidth;
            div.classList.add('entrada-cima');

            setTimeout(function() {
                div.classList.remove('entrada-cima');
                div.classList.add('saida-baixo');
                setTimeout(function() {
                    div.remove();
                }, 900);
            }, 3100);
        })();

        // Adiciona o CSS da animação (apenas quando necessário)
        (function(){
            if (document.getElementById('notificacao-animada-home')) return;
            const style = document.createElement('style');
            style.id = 'notificacao-animada-home';
            style.innerHTML = `
.notificacao-animada {
    position: fixed;
    top: 20px;
    left: 20;
    margin-top: 80px;
    margin-left: 30px;
    width: 390px;
    background: #28a745;
    color: #fff;
    padding: 5px;
    z-index: 9999;
    font-size: 20px;
    text-align: center;
    border-radius: 14px;
    opacity: 0;
    transform: translateY(-100%);
    transition: none;
}
.notificacao-animada.entrada-cima {
    animation: slideDownIn 0.9s cubic-bezier(.77,0,.18,1) forwards;
}
.notificacao-animada.saida-baixo {
    animation: slideUpOut 0.9s cubic-bezier(.77,0,.18,1) forwards;
}
@keyframes slideDownIn {
    0% { opacity: 0; transform: translateY(-100%); }
    60% { opacity: 1; transform: translateY(10%); }
    100% { opacity: 1; transform: translateY(0); }
}
@keyframes slideUpOut {
    0% { opacity: 1; transform: translateY(0); }
    100% { opacity: 0; transform: translateY(-100%); }
}
            `;
            document.head.appendChild(style);
        })();

        // oculta o marcador para evitar conflitos visuais
        sucessoEl.style.display = 'none';
    }
});
        




