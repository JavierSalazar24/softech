//validar contactanos
if (document.getElementById("contactForm")) {
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

  const csubmit = document.getElementById("csubmit");
  const terminos = document.getElementById("cterms");
  terminos.addEventListener("change", function () {
    if (this.checked == true) {
      csubmit.disabled = false;
    } else {
      csubmit.disabled = true;
      Swal.fire({
        title: "Advertencia",
        text: "Debe de aceptar los terminos de privacidad",
        icon: "warning",
        position: "center",
      });
    }
  });
  const contactForm = document.getElementById("contactForm");
  contactForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const formulario = new FormData(contactForm);
    let nombre = formulario.get("cname").trim();
    let correo = formulario.get("cemail").trim();
    let mensaje = formulario.get("cmessage").trim();
    let nombreValidado = validarSoloLetras(nombre);
    let correoValidado = validarCorreo(correo);
    if (nombre == "" || correo == "" || mensaje == "") {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
    } else {
      if (nombre.length >= 3 && nombreValidado) {
        if (correoValidado) {
          if (mensaje.length >= 3) {
            fetch("assets/php/contactanos.php", {
              method: "POST",
              body: formulario,
            })
              .then((response) => response.json())
              .then((response) => {
                if (response == "correcto") {
                  Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Mensaje enviado",
                    showConfirmButton: false,
                    timer: 1500,
                  });
                  contactForm.reset();
                } else if (response == "vacio") {
                  Swal.fire("Error!", "Datos vacíos", "error");
                } else if (response == "error") {
                  Swal.fire("Error!", "Error en el servidor", "error");
                }
              });
          } else {
            Swal.fire("Aviso!", "Mensaje demasiado corto", "warning");
          }
        } else {
          Swal.fire(
            "Aviso!",
            "El correo debe tener formato de email (@example.com)",
            "warning"
          );
        }
      } else {
        Swal.fire("Aviso!", "El nombre no es válido", "warning");
      }
    }
  });
}

if (document.getElementById("newsletterForm")) {
  const newsletterForm = document.getElementById("newsletterForm");
  newsletterForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const formulario = new FormData(newsletterForm);
    let correo = formulario.get("email").trim();
    let correoValidado = validarCorreo(correo);
    if (correo == "") {
      Swal.fire("Aviso!", "Debe de llenar el email", "warning");
    } else {
      if (correoValidado) {
        fetch("assets/php/suscripcion.php", {
          method: "POST",
          body: formulario,
        })
          .then((response) => response.json())
          .then((response) => {
            if (response == "correcto") {
              Swal.fire({
                position: "center",
                icon: "success",
                title: "Gracias por suscribirte al boletín.",
              });
              document.getElementById("newsletterForm").reset();
            } else if (response == "vacio") {
              Swal.fire("Error!", "Datos vacíos", "error");
            } else if (response == "error") {
              Swal.fire("Error!", "Error en el servidor", "error");
            } else if (response == "existente") {
              Swal.fire("Advertencia!", "Usted ya está suscrito", "warning");
            } else if (response == "nosuscrito") {
              Swal.fire(
                "Error!",
                "Debe de estar registrado para poder suscribirse",
                "warning"
              );
            }
          });
      } else {
        Swal.fire(
          "Aviso!",
          "El correo debe tener formato de email (@example.com)",
          "warning"
        );
      }
    }
  });
}
//validar campos
function validarSoloLetras(e) {
  return !!/^[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ. ]*$/.test(e);
}
function validarCorreo(e) {
  return !!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(e);
}
