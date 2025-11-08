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


const inputImagem = document.getElementById('inputImg');
const containerImagem = document.getElementById('content-img');
const textoImg = document.getElementById('pImg');
const icone = document.getElementById('iconeImg');

inputImagem.addEventListener('change', function () {
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
});


const cancelarModal = document.getElementById("cancelar-modal");
cancelarModal.addEventListener("click", function(){
    modal.style.display = "none";
})

const salvarModal = document.getElementById("salvar-modal");

salvarModal.onclick = function(){
    const notificacao = document.getElementById("notificacao");
    notificacao.textContent = "Projeto salvo com sucesso";
    notificacao.classList.add("ativa");

    setTimeout(()=>{
        notificacao.classList.remove("ativa");
    }, 3000);
}


const salvarMudancas = document.getElementById("salvarMudancas");

salvarMudancas.onclick = function(){
    const mudancas = document.getElementById("mudancas");
    mudancas.textContent = "Alterações realizadas com sucesso";
    mudancas.classList.add("clic");

    setTimeout(()=>{
        mudancas.classList.remove("clic");
    }, 3000)
}

