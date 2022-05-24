if (document.querySelector(".contenedor-slider")) {
  let index = 1;
  let selectedIndex = 1;
  const slides = document.querySelector(".slider");
  const slide = slides.children;
  const slidesTotal = slides.childElementCount;
  const dots = document.querySelector(".dots");
  const prev = document.querySelector(".prev");
  const next = document.querySelector(".next");

  //agregamos los punto de acuerdo a la cantidad de slides
  for (let i = 0; i < slidesTotal; i++)
    dots.innerHTML += '<span class="dot"></span>';

  //funcion para mostrar el slider
  function mostrarSlider(num) {
    if (selectedIndex > slidesTotal) selectedIndex = 1;
    else selectedIndex++;

    if (num > slidesTotal) index = 1;
    if (num < 1) index = slidesTotal;

    //removemos la clase active de todos los slide
    for (let i = 0; i < slidesTotal; i++) slide[i].classList.remove("active");

    //removemos la clase active de los puntos
    for (let x = 0; x < dots.children.length; x++)
      dots.children[x].classList.remove("active");

    //mostramos el slide
    slide[index - 1].classList.add("active");

    //agregamos la clase active al punto donde se encuntra el slide
    dots.children[index - 1].classList.add("active");
  }

  //ejecutamos la funcion
  mostrarSlider(index);

  //hacemos que nuestro slide sea automatico
  setInterval(() => {
    mostrarSlider((index = selectedIndex));
  }, 3000); //tiempo rempresentado en milesegundos

  //evento para nuestro botones prev y next
  next.addEventListener("click", (e) => {
    e.preventDefault();
    mostrarSlider((index += 1));
    selectedIndex = index;
  });
  prev.addEventListener("click", (e) => {
    e.preventDefault();
    mostrarSlider((index += -1));
    selectedIndex = index;
  });

  //puntos (dots)
  for (let y = 0; y < dots.children.length; y++) {
    //por cada dot que ecuentre le agregamos el evento click y ejecutamo la funcion de slide
    dots.children[y].addEventListener("click", () => {
      mostrarSlider((index = y + 1));
      selectedIndex = y + 1;
    });
  }
}

/* TABS DEL LOGIN */
const tabLink = document.querySelectorAll(".tab-link");
const formularios = document.querySelectorAll(".formulario");

for (let x = 0; x < tabLink.length; x++) {
  tabLink[x].addEventListener("click", () => {
    //removemos la clase active de todos los tabs encotrados
    tabLink.forEach((tab) => tab.classList.remove("active"));

    //le agregamos la clase active al tab que se le hizo click
    tabLink[x].classList.add("active");

    //mostramos el formulario correspondiente
    //para los formularios funciona exactamente los mismo que los tabs
    formularios.forEach((form) => form.classList.remove("active"));
    formularios[x].classList.add("active");
  });
}

//mostrar contraseña
const mostrarClave = document.querySelectorAll(".mostrarClave");
const inputPass = document.querySelectorAll(".clave");
for (let i = 0; i < mostrarClave.length; i++)
  mostrarClave[i].addEventListener("click", () => {
    if ("password" === inputPass[i].type) {
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
//validar registro
if (document.getElementById("formRegistro")) {
  const btnRegistro = document.getElementById("btnRegistro");
  const terminos = document.getElementById("terminos");
  terminos.addEventListener("change", function () {
    if (this.checked == true) {
      btnRegistro.disabled = false;
    } else {
      btnRegistro.disabled = true;
      Swal.fire({
        title: "Advertencia",
        text: "Debe de aceptar los terminos de privacidad",
        icon: "warning",
        position: "center",
      });
    }
  });
  const formRegistro = document.getElementById("formRegistro");
  formRegistro.addEventListener("submit", (e) => {
    e.preventDefault();
    const formulario = new FormData(formRegistro);
    let nombre = formulario.get("nombres").trim();
    let apellidos = formulario.get("apellidos").trim();
    let correo = formulario.get("correo").trim();
    let password = formulario.get("password").trim();
    let nombreValidado = validarSoloLetras(nombre);
    let apellidosValidado = validarSoloLetras(apellidos);
    let correoValidado = validarCorreo(correo);

    if (nombre == "" || apellidos == "" || correo == "" || password == "") {
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
                if (nombre.length >= 3 && nombreValidado) {
                  if (apellidos.length >= 3 && apellidosValidado) {
                    if (correoValidado) {
                      if (password.length >= 8) {
                        fetch("assets/php/registrarse.php", {
                          method: "POST",
                          body: formulario,
                        })
                          .then((response) => response.json())
                          .then((response) => {
                            if (response == "correcto") {
                              Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Bienvenido a SofTech",
                                showConfirmButton: !1,
                                timer: 1500,
                              }),
                                setTimeout(function () {
                                  location.href = "./";
                                }, 500);
                            } else if (response == "existente") {
                              Swal.fire(
                                "Error!",
                                "El correo ya existe",
                                "error"
                              );
                            } else if (response == "vacio") {
                              Swal.fire("Error!", "Datos vacíos", "error");
                            } else if (response == "error") {
                              Swal.fire(
                                "Error!",
                                "Error en el servidor",
                                "error"
                              );
                            }
                          });
                      } else {
                        Swal.fire(
                          "Aviso!",
                          "La contraseña debe de tener al menos 8 carácteres",
                          "warning"
                        );
                      }
                    } else {
                      Swal.fire(
                        "Aviso!",
                        "El correo debe tener formato de email (@example.com)",
                        "warning"
                      );
                    }
                  } else {
                    Swal.fire("Aviso!", "El apellido no es válido", "warning");
                  }
                } else {
                  Swal.fire("Aviso!", "El nombre no es válido", "warning");
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
//validar login
if (document.getElementById("formLogin")) {
  const formLogin = document.getElementById("formLogin");
  let i = 1;
  formLogin.addEventListener("submit", (e) => {
    e.preventDefault();
    const formulario = new FormData(formLogin);
    let correo = formulario.get("correo").trim();
    let password = formulario.get("password").trim();
    let correoValidado = validarCorreo(correo);
    if (correo == "" || password == "") {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
    } else if (correoValidado) {
      if (password.length >= 8) {
        let cookiename = "nombrecookie=" + correo;
        let getCookiesNameBlock = document.cookie.lastIndexOf(
          cookiename + "block"
        );
        if (getCookiesNameBlock == -1) {
          fetch("assets/php/login.php", { method: "POST", body: formulario })
            .then((response) => response.json())
            .then((response) => {
              if (response == "user") {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Bienvenido a SofTech",
                  showConfirmButton: !1,
                  timer: 1500,
                }),
                  setTimeout(function () {
                    location.href = "./";
                  }, 500);
              } else if (response == "admin") {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Bienvenido administrador",
                  showConfirmButton: !1,
                  timer: 1500,
                }),
                  setTimeout(function () {
                    location.href = "./";
                  }, 500);
              } else if (response == "admin-publicaciones") {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Bienvenido administrador",
                  showConfirmButton: !1,
                  timer: 1500,
                }),
                  setTimeout(function () {
                    location.href = "./";
                  }, 500);
              } else if (response == "null") {
                let getCookiesName = document.cookie.lastIndexOf(
                  cookiename + i
                );
                if (getCookiesName >= 0) {
                  i++;
                  if (i > 3) {
                    document.cookie =
                      cookiename + "block" + ";" + "max-age=600;";
                    Swal.fire(
                      "Aviso!",
                      "Demasiados intentos, se bloqueó su cuenta 10 minutos",
                      "error"
                    );
                    return false;
                  }
                  Swal.fire(
                    "Error!",
                    "Correo o contraseña incorrecta",
                    "error"
                  );
                } else {
                  document.cookie =
                    "nombrecookie=" + correo + i + "; max-age=600;";
                  Swal.fire(
                    "Error!",
                    "Correo o contraseña incorrecta",
                    "error"
                  );
                }
              } else if (response == "vacio") {
                "vacio" == e && Swal.fire("Error!", "Datos vacíos", "error");
              }
            });
        } else {
          Swal.fire(
            "Aviso!",
            "Demasiados intentos, se bloqueó su cuenta 10 minutos",
            "error"
          );
        }
      } else {
        Swal.fire(
          "Aviso!",
          "La contraseña debe de tener al menos 8 carácteres",
          "warning"
        );
      }
    } else {
      Swal.fire(
        "Aviso!",
        "El correo debe tener formato de email (@example.com)",
        "warning"
      );
    }
  });
}
// document.oncontextmenu = function () {
//   return false;
// };
//validar campos
function validarSoloLetras(e) {
  return !!/^[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ. ]*$/.test(e);
}
function validarCorreo(e) {
  return !!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(e);
}
