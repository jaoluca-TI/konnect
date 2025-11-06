document.addEventListener("DOMContentLoaded", () => {
    const container = document.querySelector('.projeto-card');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    // ⚙ Configura o container como carrossel horizontal
    container.style.display = "flex";
    container.style.flexWrap = "nowrap";
    container.style.overflowX = "auto";
    container.style.scrollBehavior = "smooth";
    container.style.scrollSnapType = "x mandatory";
    container.style.gap = "20px";

    // Função para aplicar estilos em um card
    function aplicarEstiloCard(card) {
        card.style.scrollSnapAlign = "center";
        card.style.flex = "0 0 80%"; // ocupa 80% da largura
        card.style.maxWidth = "500px";
    }

    // Aplica estilo a todos os cards existentes
    const cardsExistentes = document.querySelectorAll('.card');
    cardsExistentes.forEach(card => aplicarEstiloCard(card));

    // 🧭 Rolagem lateral pelos botões
    const cardWidth = cardsExistentes[0] ? cardsExistentes[0].offsetWidth + 20 : 520;

    nextBtn.addEventListener('click', () => {
        container.scrollBy({ left: cardWidth, behavior: 'smooth' });
    });

    prevBtn.addEventListener('click', () => {
        container.scrollBy({ left: -cardWidth, behavior: 'smooth' });
    });

    // 🖱 Arraste com o mouse (efeito Tinder)
    let isDown = false;
    let startX;
    let scrollLeft;

    container.addEventListener('mousedown', (e) => {
        isDown = true;
        startX = e.pageX - container.offsetLeft;
        scrollLeft = container.scrollLeft;
    });

    container.addEventListener('mouseleave', () => isDown = false);
    container.addEventListener('mouseup', () => isDown = false);

    container.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - container.offsetLeft;
        const walk = (x - startX) * 1.5;
        container.scrollLeft = scrollLeft - walk;
    });

    // === Função para adicionar novos projetos dinamicamente ===
  window.adicionarProjeto = function(projeto) {
    const card = document.createElement('div');
    card.classList.add('card');
    card.innerHTML = `
        <img src="${projeto.imagem}" alt="">
        <div class="conteudo-card fade-in">
            <h3>${projeto.titulo}</h3>
            <p>${projeto.descricao}</p>
            <div class="tec fade-in">
                <h5>Tecnologias</h5>
                <div class="spantec fade-in">
                    ${projeto.tecnologias.map(tec => `<span>${tec}</span>`).join('')}
                </div>
            </div>
            <div class="topicos fade-in">
                <h5>Temas</h5>
                <div class="span-topicos fade-in">
                    ${projeto.temas.map(top => `<span>${top}</span>`).join('')}
                </div>
            </div>
            <div class="vagas fade-in">
                <h5><i class="bi bi-people-fill fade-in"></i>Estamos buscando</h5>
                <div class="vagas-span fade-in">
                    ${projeto.vagas.map(v => `<span>${v}</span>`).join('')}
                </div>
            </div>
            <div class="data fade-in">
                <span class="date"><i class="bi bi-calendar"></i> Início: ${projeto.inicio} – <i class="bi bi-calendar"></i> Fim: ${projeto.fim}</span>
            </div>
            <div class="contato">
                <button><i class="bi bi-envelope-fill"></i></button>
                <div class="like">
                    <i class="bi bi-heart"></i>
                </div>
            </div>
        </div>
    `;
    container.appendChild(card);
    aplicarEstiloCard(card);

  };
});
