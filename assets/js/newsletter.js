//validar newsletter
if (document.getElementById("newsletterForm")) {
  const inputs = document.querySelectorAll("input");
  inputs.forEach((input) => {
    input.onfocus = () => {
      input.previousElementSibling.classList.add("top");
    };
    input.onblur = () => {
      input.value = input.value.trim();
      if (input.value.trim().length == 0) {
        input.previousElementSibling.classList.remove("top");
      }
    };
  });
  const textareas = document.querySelectorAll("textarea");
  textareas.forEach((textarea) => {
    textarea.onfocus = () => {
      textarea.previousElementSibling.classList.add("top");
    };
    textarea.onblur = () => {
      textarea.value = textarea.value.trim();
      if (textarea.value.trim().length == 0) {
        textarea.previousElementSibling.classList.remove("top");
      }
    };
  });

  const newsletterForm = document.getElementById("newsletterForm");
  newsletterForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const formulario = new FormData(newsletterForm);
    let asunto = formulario.get("asunto").trim();
    let mensaje = formulario.get("mensaje").trim();
    if (asunto == "" || mensaje == "") {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
    } else {
      if (asunto.length >= 3) {
        if (mensaje.length >= 3) {
          fetch("../assets/php/newsletter.php", {
            method: "POST",
            body: formulario,
          })
            .then((response) => response.json())
            .then((response) => {
              if (response == "correcto") {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Mensajes enviados",
                  showConfirmButton: false,
                  timer: 1500,
                });
                newsletterForm.reset();
              } else if (response == "vacio") {
                Swal.fire("Error!", "Datos vacíos", "error");
              } else if (response == "error") {
                Swal.fire("Error!", "Error en el servidor", "error");
              } else if (response == "nadie") {
                Swal.fire("Advertencia!", "No hay nadie suscrito", "warning");
              }
            });
        } else {
          Swal.fire("Aviso!", "Mensaje demasiado corto", "warning");
        }
      } else {
        Swal.fire("Aviso!", "El asunto no es válido", "warning");
      }
    }
  });
}
