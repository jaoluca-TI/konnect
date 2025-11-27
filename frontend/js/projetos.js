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
            <div class="contato fade-in">
                <button class="contato-btn"><i class="bi bi-envelope-fill"></i></button>
                <div class="like">
                    <i class="bi bi-heart like-icon"></i>
                    <span class="like-count">0</span>
                </div>
            </div>
        </div>
    `;
    container.appendChild(card);
    aplicarEstiloCard(card);

    // Adiciona listener para o like do novo card
    const btnLike = card.querySelector('.like');
    if (btnLike) {
        const likeIcon = btnLike.querySelector('.like-icon');
        const contador = btnLike.querySelector('.like-count');
        let liked = false;

        if (likeIcon && contador) {
            btnLike.addEventListener('click', function() {
                liked = !liked;
                const count = parseInt(contador.textContent || '0');

                if(liked) {
                    likeIcon.classList.remove('bi-heart');
                    likeIcon.classList.add('bi-heart-fill');
                    likeIcon.style.color = 'red';
                    contador.textContent = count + 1;
                } else {
                    likeIcon.classList.remove('bi-heart-fill');
                    likeIcon.classList.add('bi-heart');
                    likeIcon.style.color = 'red';
                    contador.textContent = Math.max(0, count - 1);
                }
            });
        }
    }
  };
});
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const msg = urlParams.get('msg');
    const notificacao = document.getElementById('alteracao');

    if (msg === 'sucesso') {
        notificacao.textContent = 'Projeto criado com sucesso!';
        notificacao.classList.add('clic');

        setTimeout(() => {
            notificacao.classList.remove('clic');
            window.history.replaceState({}, document.title, window.location.pathname);
        }, 3000);
    }

    if (msg === 'erro') {
        notificacao.textContent = 'Erro ao criar projeto!';
        notificacao.classList.add('clic-erro');

        setTimeout(() => {
            notificacao.classList.remove('clic-erro');
            window.history.replaceState({}, document.title, window.location.pathname);
        }, 3000);
    }

        //Botao de Curtidas

    const Likes = document.querySelectorAll('.like'); 
    Likes.forEach((likes) => { // vou percore esse meu array que eu fiz a constante likes receber
        const likeIcon = likes.querySelector('.like-icon'); //pegando o icone
        const contador = likes.querySelector('.like-count'); // pegando o contador
        let liked = false; //Criei uma variavel like que recebe false

        if (!likeIcon || !contador) return;

        likes.addEventListener('click', function() { // quando clicar no botao de curtir vai executar uma funcao 
            liked = !liked;  // a minha variavel liked recebe true agora
            const count = parseInt(contador.textContent || '0');

            if(liked) {
                likeIcon.classList.remove('bi-heart');
                likeIcon.classList.add('bi-heart-fill');
                likeIcon.style.color = 'red';
                contador.textContent = count + 1;
            } else {
                likeIcon.classList.remove('bi-heart-fill');
                likeIcon.classList.add('bi-heart');
                likeIcon.style.color = 'red';
                contador.textContent = Math.max(0, count - 1);
            }
        });


    });

    //modal de filtro
    const filtrarBtn = document.getElementById("filtrarBtn");
    const modal = document.getElementById("modal");
    const fechar = document.getElementById("fechar");

    filtrarBtn.addEventListener("click", function(){
        modal.style.display = "flex";
    });

    fechar.addEventListener("click", function(){
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
});


    // filtro

    const tipoLabel = document.getElementById("tipoLabel");
    const tipoSelect = document.getElementById("tipo");
    tipoLabel.addEventListener("click", function(){
        tipoSelect.style.display = "flex"
    })


    //limpar o Filtro

    const limpar = document.getElementById("limpar"); 
    const seletor = document.querySelectorAll(".select");

    limpar.addEventListener("click", function(){
        seletor.forEach(select =>{
            select.value = "";
        })
    })
    
});


