const areaBotao = document.querySelector("botoes");
const botaoLogin = document.getElementById("botaoLogin");
const fotoSalva = localStorage.getItem("fotoUsuario");

if(fotoSalva){
    botaoLogin.style.display = "none";

    const img = document.createElement("img");

    img.src = fotoSalva;
    img.alt = "Foto de perfil"
    img.classList.add("foto-perfil");

    document.getElementById("fotoPreview").src = fotoSalva

    areaBotao.appendChild(img)
}

