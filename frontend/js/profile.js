  // ======================
  // PREVIEW DO BANNER
  // ======================
  const bannerInput = document.getElementById("bannerInput");
  const bannerPreview = document.getElementById("bannerPreview");

  if (bannerInput && bannerPreview) {
      bannerInput.addEventListener("change", function () {
          const file = this.files[0];
          if (!file) return;

          bannerPreview.src = URL.createObjectURL(file);
      });
  };

  // ======================
  //  FIM DO PREVIEW DO BANNER
  // ======================
  
  
  
  // ==========================
  // PREVIEW DA FOTO DE PERFIL
  // ==========================
  const fotoInput = document.getElementById("fotoInput");
  const fotoPreview = document.getElementById("fotoPreview");

  if (fotoInput && fotoPreview) {
      fotoInput.addEventListener("change", function () {
          const file = this.files[0];
          if (!file) return;

          fotoPreview.src = URL.createObjectURL(file);
      });
  }
  // ==========================
  //  FIM DO PREVIEW DA FOTO DE PERFIL
  // ==========================


// ==========================
// HABILIDADES
// ==========================

const addHabilidadeBtn = document.getElementById("addHabilidade");
const habilidadeInput = document.getElementById("habilidade");
const nivelSelect = document.getElementById("nivel");
const listaHabilidades = document.getElementById("listaHabilidades");
const listaHabilidadesInput = document.getElementById("listaHabilidadesInput");

let habilidadesArray = [];

function atualizarHidden() {
    const texto = habilidadesArray
        .map(h => `${h.habilidade} (${h.nivel})`)
        .join(", ");

    listaHabilidadesInput.value = texto;
}


addHabilidadeBtn.addEventListener("click", () => {
    const habilidade = habilidadeInput.value.trim();
    const nivel = nivelSelect.value;

    if (!habilidade) return;

    // ====== ADICIONANDO NO ARRAY (ESSENCIAL) ======
    habilidadesArray.push({ habilidade, nivel });
    atualizarHidden();

    const tag = document.createElement("div");
    tag.classList.add("tag");

    if (nivel === "Iniciante") tag.classList.add("iniciante");
    if (nivel === "Intermediário") tag.classList.add("intermediario");
    if (nivel === "Avançado") tag.classList.add("avancado");

    tag.innerHTML = `
      <span>${habilidade} <small>(${nivel})</small></span>
      <button class="remove-tag">x</button>
    `;

    // ====== REMOVER DO ARRAY E DO HIDDEN ======
    tag.querySelector(".remove-tag").addEventListener("click", () => {
        const index = habilidadesArray.findIndex(
            h => h.habilidade === habilidade && h.nivel === nivel
        );
        if (index > -1) habilidadesArray.splice(index, 1);

        atualizarHidden();
        tag.remove();
    });

    listaHabilidades.appendChild(tag);
    habilidadeInput.value = "";
});

// ==========================
//  FIM DAS HABILIDADES
// ==========================


// MODAL ADICONAR PROJETO
const btn = document.getElementById("openModalBtn");
const modal = document.getElementById("myModal");
const span = document.getElementsByClassName("close")[0];

btn.addEventListener("click", function() {
  modal.style.display = "flex";
});

span.addEventListener("click", function() {
  modal.style.display = "none";
});

window.addEventListener("click", function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
});


// Fechar o modal ao clicar em cancelar
const cancelarModal = document.getElementById("cancelar-modal");
cancelarModal.addEventListener("click", function(){
    modal.style.display = "none";
})


// salvar o modal e mostrar notificação
const salvarModal = document.getElementById("salvar-modal");

salvarModal.onclick = function(){
    const notificacao = document.getElementById("notificacao");
    notificacao.textContent = "Projeto salvo com sucesso";
    notificacao.classList.add("ativa");

    setTimeout(()=>{
        notificacao.classList.remove("ativa");
    }, 3000);
}

// Quando o usuário clicar em salvar, Verificar se os campos estão preenchidos
const modalTitulo = document.getElementById("projetoTituloInput");
const modalUrl = document.getElementById("projetoUrlInput");
const modalImagem = document.getElementById("projetoImagemInput");

salvarModal.addEventListener("click", () => {
      if (!modalTitulo.value.trim() || !modalUrl.value.trim()) {
          alert("Preencha o título e a URL do projeto.");
          return;
      }

      hiddenTitulo.value = modalTitulo.value.trim();
      hiddenUrl.value = modalUrl.value.trim();

      if (modalImagem.files.length > 0) {
          hiddenImagemNome.value = modalImagem.files[0].name;
      }

      modal.style.display = "none";
  });

  // Fim do salvar o modal e mostrar notificação


//imagem preview no modal
const inputImagem = document.getElementById('projetoImagemInput');
const containerImagem = document.getElementById('content-img');
const textoImg = document.getElementById('pImg');
const icone = document.getElementById('iconeImg');

inputImagem.addEventListener("change", function () {
  const arquivo = this.files[0];
  if (arquivo) {
    const leitor = new FileReader();

    leitor.addEventListener('load', function () {
      textoImg.style.display = 'none';
      icone.style.display = 'none';

      let imgPreview = containerImagem.querySelector('img');
      if (!imgPreview) {
        imgPreview = document.createElement('img');
        containerImagem.appendChild(imgPreview);
      }

      imgPreview.src = this.result;

    
      imgPreview.style.position = 'absolute';
      imgPreview.style.top = '0';
      imgPreview.style.left = '0';
      imgPreview.style.width = '100%';
      imgPreview.style.height = '100%';
      imgPreview.style.objectFit = 'cover';
      imgPreview.style.borderRadius = 'inherit';
      imgPreview.style.zIndex = '0';

     
      containerImagem.style.border = 'none';
      containerImagem.style.background = 'none';
    });

    leitor.readAsDataURL(arquivo);
    }

    // fim imagem preview no modal
});

// Fim do modal



// ==========================
// Formulário de perfil
// ==========================
const formPerfil = document.getElementById("formPerfil");

formPerfil.addEventListener("submit", async (e) => {
      e.preventDefault();

      hiddenTitulo.value = modalTitulo.value.trim();
      hiddenUrl.value = modalUrl.value.trim();

      if (modalImagem.files.length > 0) {
          hiddenImagemNome.value = modalImagem.files[0].name;
      }

      const formData = new FormData(formPerfil);

      try {
          const resp = await fetch(formPerfil.action, {
              method: "POST",
              body: formData
          });

          const result = await resp.json();

          if (result.status === "success") {
              notificacao.innerText = "Perfil atualizado!";
              notificacao.style.display = "block";
              setTimeout(() => notificacao.style.display = "none", 3000);
          } else {
              alert("Erro ao salvar: " + result.message);
          }

      } catch (err) {
          alert("Erro interno.");
      }
  });

// ==========================
// Fim do Formulário de perfil
// ==========================


// Salvar Perfil
const salvarMudancasBtn = document.getElementById("salvarMudancas");
salvarMudancasBtn.onclick = function() {


    const mudancas = document.getElementById("mudancas");
    mudancas.textContent = "Alterações salvas com sucesso";
    mudancas.classList.add("clic");

    setTimeout(()=>{
        mudancas.classList.remove("clic");
    }, 3000);

    formPerfil.requestSubmit();
    // Salva notificação na sessionStorage antes de redirecionar
    sessionStorage.setItem('notificacaoPerfil', 'Alterações salvas com sucesso');
    window.location.href = "/konnect/frontend/html/viewPerfil.php";



    
};



