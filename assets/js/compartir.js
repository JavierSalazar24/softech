if (document.getElementById("compartirForm")) {
  const compartirForm = document.getElementById("compartirForm");
  compartirForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const formulario = new FormData(compartirForm);
    let id = formulario.get("id_share").trim();
    let redSocial = formulario.get("social").trim();
    if (redSocial == "S" || redSocial.length == 0 || redSocial == "") {
      Swal.fire("Aviso!", "Debe de elegir una red social", "warning");
    } else {
      if (redSocial == "F") {
        window.open(
          "https://www.facebook.com/sharer.php?u=https://softech.cesenas.com/menu/publicacion?id=" +
            id,
          "_blank"
        );
      } else if (redSocial == "T") {
        window.open(
          "https://twitter.com/intent/tweet?text=Nueva%20noticia%20amigos%F0%9F%98%81&url=https://softech.cesenas.com/menu/publicacion?id=" +
            id,
          "_blank"
        );
      } else if (redSocial == "W") {
        window.open(
          "https://api.whatsapp.com/send?text=https://softech.cesenas.com/menu/publicacion?id=" +
            id,
          "_blank"
        );
      } else {
        Swal.fire("Aviso!", "Debe de elegir una red social", "warning");
      }
    }
  });
}
