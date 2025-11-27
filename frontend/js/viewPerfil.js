document.addEventListener('DOMContentLoaded', function() {
        var msg = sessionStorage.getItem('notificacaoPerfil');
        if (msg) {
                let div = document.createElement('div');
                div.className = 'notificacao notificacao-animada';
                div.textContent = msg;
                document.body.appendChild(div);

                // Força reflow para garantir que a animação será aplicada
                void div.offsetWidth;
                div.classList.add('entrada-cima');

                setTimeout(function() {
                    div.classList.remove('entrada-cima');
                    div.classList.add('saida-baixo');
                    setTimeout(function() {
                        div.remove();
                    }, 900); // tempo igual ao da animação de saída
                }, 3100);
                sessionStorage.removeItem('notificacaoPerfil');
        }
});
// CSS da animação
const style = document.createElement('style');
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
`

document.head.appendChild(style);
;