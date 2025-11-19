const inputImagem = document.getElementById('imagemCriar');
const containerImagem = document.getElementById('cont');
const textoImg = document.getElementById('tex');
const icone = document.getElementById('icon');

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

    
      imgPreview.style.top = '0';
      imgPreview.style.left = '0';
      imgPreview.style.width = '100%';
      imgPreview.style.height = '250px';
      imgPreview.style.objectFit = 'cover';
      imgPreview.style.borderRadius = "12px";

     
      containerImagem.style.border = 'none';
      containerImagem.style.background = 'none';
    });

    leitor.readAsDataURL(arquivo);
    }
});


botaoProjeto = document.getElementById("criarProjeto");

botaoProjeto.addEventListener("click", function(){
  const notificacao = document.getElementById("alteracao");
  notificacao.textContent = "Projeto criado com sucesso!";
  notificacao.classList.add("clic");

  setTimeout(()=>{
        mudancas.classList.remove("clic");
    }, 3000)

})
