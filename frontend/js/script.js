const btn = document.getElementById("openModalBtn");
const modal = document.getElementById("myModal");
const span = document.getElementsByClassName("close")[0];
const topoh1 = document.getElementById("topoh1");

btn.addEventListener("click",() =>{
    modal.style.display = "flex";
    const content = document.getElementsByClassName("modal-content");
    const totalProjeto = content.querySelectorAll("#myModal").lenght;
    const novo = totalProjeto + 1;
    const novoProjeto = document.createElement("div");
    novoProjeto.classList.add(".modal");
    novoProjeto.innerHTML = `
            <div class="topo">
                <h1 id="topoh1">Projeto ${novo}</h1>
                <span class="close" >&times;</span>
            </div>

            <div class="input-box">
                <label for="nomeProjeto">Nome do projeto</label>
                <input type="text" placeholder="Ex: konnect">

            <div class="input-box">
                <label for="">link do projeto</label>
                <input type="url" name="" id="" placeholder="https://...">
            </div>
            
            <div class="img">
                <label for="">Imagem-projeto</label>
                <div class="content-img">
                    <input type="file" name="" id="">
                    <div class="icon"><i class="bi bi-upload"></i></div>
                    <div class="texto-img">Clique para fazer upload da imagem</div>
                    <input type="file" name="imagem" id="imagem" style="position:absolute; width:100%; height:100%; opacity:0; cursor:pointer;">
                </div>
            </div>
    `
    content.appendChild(novoProjeto);
});

span.addEventListener("click",() =>{
    modal.style.display = "none";
})

window.addEventListener("click",(event)=>{
    if(event.target == modal){
        modal.style.display = "none"
    }
})

