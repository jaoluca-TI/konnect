const areaBotao = document.querySelector('.botoes');
const botaoLogin = document.getElementById('botaoLogin');
const fotoSalva = localStorage.getItem('fotoUsuario');

if (fotoSalva && botaoLogin && areaBotao) {
    // hide the login link when we have a saved profile picture
    botaoLogin.style.display = 'none';

    const img = document.createElement('img');
    img.src = fotoSalva;
    img.alt = 'Foto de perfil';
    img.classList.add('foto-perfil');

    const fotoPreview = document.getElementById('fotoPreview');
    if (fotoPreview) fotoPreview.src = fotoSalva;

    areaBotao.appendChild(img);
}

