document.addEventListener("DOMContentLoaded", () => {
  const bannerInput = document.getElementById("bannerInput");
  const bannerPreview = document.getElementById("bannerPreview");
  bannerInput.addEventListener("change", e => {
    const file = e.target.files[0];
    if (file) bannerPreview.src = URL.createObjectURL(file);
  });

  const fotoInput = document.getElementById("fotoInput");
  const fotoPreview = document.getElementById("fotoPreview");
  fotoInput.addEventListener("change", e => {
    const file = e.target.files[0];
    if (file) fotoPreview.src = URL.createObjectURL(file);
  });

  const addHabilidadeBtn = document.getElementById("addHabilidade");
  const habilidadeInput = document.getElementById("habilidade");
  const nivelSelect = document.getElementById("nivel");
  const listaHabilidades = document.getElementById("listaHabilidades");

  addHabilidadeBtn.addEventListener("click", () => {
    const habilidade = habilidadeInput.value.trim();
    const nivel = nivelSelect.value;

    if (!habilidade) return;

    const tag = document.createElement("div");
    tag.classList.add("tag");


    if (nivel === "Iniciante") tag.classList.add("iniciante");
    if (nivel === "Intermediário") tag.classList.add("intermediario");
    if (nivel === "Avançado") tag.classList.add("avancado");

    tag.innerHTML = `
      <span>${habilidade} <small>(${nivel})</small></span>
      <button class="remove-tag">×</button>
    `;


    tag.querySelector(".remove-tag").addEventListener("click", () => tag.remove());

    listaHabilidades.appendChild(tag);
    habilidadeInput.value = "";
  });

  const addProjetoBtn = document.getElementById("addProjeto");
  const nomeProjetoInput = document.getElementById("nomeProjeto");
  const linkProjetoInput = document.getElementById("linkProjeto");
  const imagemProjetoInput = document.getElementById("imagemProjeto");
  const listaProjetos = document.getElementById("listaProjetos");

  addProjetoBtn.addEventListener("click", () => {
    const nome = nomeProjetoInput.value.trim();
    const link = linkProjetoInput.value.trim();
    const file = imagemProjetoInput.files[0];

    if (nome && link && file) {
      const card = document.createElement("div");
      const imgURL = URL.createObjectURL(file);
      card.innerHTML = `
        <img src="${imgURL}" alt="${nome}">
        <p><strong>${nome}</strong></p>
        <a href="${link}" target="_blank">Ver projeto</a>
      `;
      listaProjetos.appendChild(card);

      nomeProjetoInput.value = "";
      linkProjetoInput.value = "";
      imagemProjetoInput.value = "";
    } else {
      alert("Preencha todos os campos do projeto!");
    }
  });


  function resetarFormulario() {
    document.querySelectorAll('input[type="text"], input[type="url"], textarea').forEach(input => input.value = '');
    document.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => checkbox.checked = false);
    document.getElementById("bannerPreview").src = "banner.jpg";
    document.getElementById("fotoPreview").src = "perfil.png";
    document.getElementById("listaHabilidades").innerHTML = '';
    document.getElementById("listaProjetos").innerHTML = '';
  }

  const deletarBtn = document.getElementById("deletar");
  deletarBtn.addEventListener("click", () => {
    if (confirm("Tem certeza que deseja deletar sua conta?")) {
      resetarFormulario();
      alert("Todos os dados foram deletados!");
    }
  });


  const salvarBtn = document.getElementById("salvar");
  salvarBtn.addEventListener("click", () => {
    if (confirm("Deseja salvar as alterações?")) {
      resetarFormulario();
      alert("Alterações salvas com sucesso!");
    }
  });
});
