if (document.getElementById("btnEnviar")) {
  document.getElementById("btnEnviar").disabled = !0;
  const form_recuperar = document.getElementById("form_recuperar");
  form_recuperar.addEventListener("submit", (e) => {
    e.preventDefault();
    const datos = new FormData(form_recuperar);
    const correo = datos.get("correo");
    const validarEmail = validarCorreo(correo);
    if (validarEmail) {
      fetch("assets/php/recuperar.php", { method: "POST", body: datos })
        .then((res) => res.json())
        .then((data) => {
          if (data == "correcto") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Un email se envio a su dirección de correo electrónico",
              showConfirmButton: !0,
            });
            const recu = document.querySelectorAll(".recu")[0];
            const mens = document.querySelectorAll(".mens")[0];
            recu.classList.add("desaparecer");
            mens.classList.remove("desaparecer");
          } else if (data == "error") {
            Swal.fire({
              position: "center",
              icon: "error",
              title: "El email ingresado no existe",
              showConfirmButton: !1,
              timer: 1500,
            });
          } else if (data == "vacio") {
            Swal.fire({
              position: "center",
              icon: "error",
              title: "No se envío información",
              showConfirmButton: !1,
              timer: 1500,
            });
          } else {
            Swal.fire({
              position: "center",
              icon: "error",
              title: "Error en el servidor",
              showConfirmButton: !1,
              timer: 1500,
            });
          }
        });
    }
  });
}
if (document.getElementById("correo")) {
  const email = document.getElementById("correo");
  email.addEventListener("keyup", () => {
    const btnEnviar = document.getElementById("btnEnviar");
    const validarEmail = validarCorreo(email.value);
    if (validarEmail) {
      btnEnviar.disabled = !1;
    } else {
      btnEnviar.disabled = !0;
    }
  });
}
if (document.getElementById("btnGuardar")) {
  document.getElementById("btnGuardar").disabled = !0;
  const form_nuevaPass = document.getElementById("form_nuevaPass");
  form_nuevaPass.addEventListener("submit", (e) => {
    e.preventDefault();
    const datos = new FormData(form_nuevaPass);
    const pass = datos.get("pass").trim();
    const conf_pass = datos.get("conf_pass").trim();

    if (pass == "" || conf_pass == "") {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
    } else {
      const fortaleza = document.getElementById("fortaleza").textContent;
      if (
        fortaleza != "Muy débil" &&
        fortaleza != "Débil" &&
        fortaleza != "Mediana" &&
        fortaleza != "Fuerte"
      ) {
        Swal.fire("Aviso!", "Todos los puntos son requeridos", "warning");
      } else {
        if (fortaleza != "Muy débil") {
          if (fortaleza != "Débil") {
            if (fortaleza != "Mediana") {
              if (fortaleza == "Fuerte") {
                if (pass.length >= 8 && conf_pass.length >= 8) {
                  if (pass === conf_pass) {
                    fetch("assets/php/nueva_pass.php", {
                      method: "POST",
                      body: datos,
                    })
                      .then((res) => res.json())
                      .then((data) => {
                        if (data == "correcto") {
                          Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Su contraseña ha sido actualizada",
                            showConfirmButton: !0,
                          });
                          location.href = "./login";
                        } else if (data == "error") {
                          Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Las contraseñas no coinciden, verifíquelas",
                            showConfirmButton: !1,
                            timer: 1500,
                          });
                        } else if (data == "vacio") {
                          Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "No se envío información",
                            showConfirmButton: !1,
                            timer: 1500,
                          });
                        } else {
                          Swal.fire({
                            position: "center",
                            icon: "error",
                            title: "Error en el servidor",
                            showConfirmButton: !1,
                            timer: 1500,
                          });
                        }
                      });
                  } else {
                    Swal.fire(
                      "Aviso!",
                      "La contraseña debe de ser iguales",
                      "warning"
                    );
                  }
                } else {
                  Swal.fire(
                    "Aviso!",
                    "Las contraseñas debe de tener al menos 8 carácteres",
                    "warning"
                  );
                }
              }
            } else {
              Swal.fire("Aviso!", "Contraseña medianamente débil", "warning");
            }
          } else {
            Swal.fire("Aviso!", "Contraseña débil", "warning");
          }
        } else {
          Swal.fire("Aviso!", "Contraseña muy débil", "warning");
        }
      }
    }
  });
}
if (document.getElementById("pass")) {
  const pass = document.getElementById("pass");
  const conf_pass = document.getElementById("conf_pass");
  pass.addEventListener("keyup", () => {
    if (pass.value === "" || conf_pass.value === "") {
      document.getElementById("btnGuardar").disabled = !0;
    } else if (pass.value.length >= 8 && conf_pass.value.length >= 8) {
      if (pass.value === conf_pass.value) {
        document.getElementById("btnGuardar").disabled = !1;
      } else {
        document.getElementById("btnGuardar").disabled = !0;
      }
    }
  });
  conf_pass.addEventListener("keyup", () => {
    if (pass.value === "" || conf_pass.value === "") {
      document.getElementById("btnGuardar").disabled = !0;
    } else if (pass.value.length >= 8 && conf_pass.value.length >= 8) {
      if (pass.value === conf_pass.value) {
        document.getElementById("btnGuardar").disabled = !1;
      } else {
        document.getElementById("btnGuardar").disabled = !0;
      }
    }
  });
}
function validarCorreo(valor) {
  if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(valor)) {
    return !1;
  }
  return !0;
}
document.oncontextmenu = () => false;
const mostrarClave = document.querySelectorAll(".mostrarClave");
const inputPass = document.querySelectorAll(".clave");
for (let i = 0; i < mostrarClave.length; i++) {
  mostrarClave[i].addEventListener("click", () => {
    if (inputPass[i].type === "password") {
      inputPass[i].setAttribute("type", "text");
      mostrarClave[i].classList.remove("fa-eye");
      mostrarClave[i].classList.add("fa-eye-slash");
      mostrarClave[i].classList.add("active");
    } else {
      inputPass[i].setAttribute("type", "password");
      mostrarClave[i].classList.remove("fa-eye-slash");
      mostrarClave[i].classList.add("fa-eye");
      mostrarClave[i].classList.remove("active");
    }
  });
}
