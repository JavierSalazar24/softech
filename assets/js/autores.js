$(document).on("change", "#img_agregar", function () {
  let imgCodificada = URL.createObjectURL(this.files[0]);
  $("#imgPrev_agregar").attr("src", imgCodificada);

  let archivoInput = document.getElementById("img_agregar").value;
  let extPermitidas =
    /(.gif|.svg|.png|.jpeg|.jpg|.webp|.GIF|.SVG|.PNG|.JPEG|.JPG|.WEBP)$/i;
  if (!extPermitidas.exec(archivoInput)) {
    Swal.fire(
      "Aviso!",
      "Extensión no valida, asegurate de haber seleccionado una imagen",
      "warning"
    );
    document.getElementById("img_agregar").value = null;
  }
});

if (document.getElementById("agregar_autor")) {
  document.getElementById("agregar_submit").addEventListener("click", (e) => {
    e.preventDefault();

    // let archivoInput = document.getElementById("img_agregar").value;
    // let extPermitidas =
    //   /(.gif|.svg|.png|.jpeg|.jpg|.webp|.GIF|.SVG|.PNG|.JPEG|.JPG|.WEBP)$/i;
    // if (!extPermitidas.exec(archivoInput)) {
    //   Swal.fire(
    //     "Aviso!",
    //     "Extensión no valida, asegurate de haber seleccionado una imagen",
    //     "warning"
    //   );
    // } else {
    const agregar_autor = document.getElementById("agregar_autor");
    let formulario = new FormData(agregar_autor);
    let nombre = formulario.get("nombre").trim();
    let apellido = formulario.get("apellido").trim();
    let genero = formulario.get("genero").trim();
    let user_facebook = formulario.get("user_facebook").trim();
    let user_instagram = formulario.get("user_instagram").trim();
    let user_twitter = formulario.get("user_twitter").trim();
    let tel_whatsapp = formulario.get("tel_whatsapp").trim();
    let whats = parseInt(tel_whatsapp);
    let email = formulario.get("email").trim();
    let password = formulario.get("password").trim();
    let privilegio = formulario.get("privilegio").trim();
    let frase = formulario.get("frase").trim();

    let nombreValidado = validarSoloLetras(nombre);
    let apellidoValidado = validarSoloLetras(apellido);
    let correoValidado = validarCorreo(email);
    let whatsValidado = validarSoloNumeros(whats);

    if (
      nombre == "" ||
      apellido == "" ||
      genero == "" ||
      user_facebook == "" ||
      user_instagram == "" ||
      user_twitter == "" ||
      tel_whatsapp == "" ||
      email == "" ||
      password == "" ||
      privilegio == "" ||
      frase == ""
    ) {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
      formulario = null;
    } else if (nombre.length >= 3 && nombreValidado) {
      if (apellido.length >= 3 && apellidoValidado) {
        if (genero.length >= 0) {
          if (user_facebook.length >= 0) {
            if (user_instagram.length >= 0) {
              if (user_twitter.length >= 0) {
                if (tel_whatsapp.length == 10 && whatsValidado) {
                  if (correoValidado) {
                    if (password.length >= 8) {
                      if (privilegio.length >= 0) {
                        if (frase.length >= 3) {
                          fetch("../assets/php/agregar_autor.php", {
                            method: "POST",
                            body: formulario,
                          })
                            .then((response) => response.json())
                            .then((response) => {
                              if (response == "correcto") {
                                Swal.fire({
                                  position: "center",
                                  icon: "success",
                                  title: "Autor agregado",
                                  showConfirmButton: !1,
                                  timer: 1500,
                                });
                                setTimeout(Reedireccion, 500);
                                function Reedireccion() {
                                  location.href = "./autores";
                                }
                              } else if (response == "vacio") {
                                Swal.fire("Error!", "Datos vacíos", "error");
                              } else if (response == "error") {
                                Swal.fire(
                                  "Error!",
                                  "Error en el servidor",
                                  "error"
                                );
                              } else if (response == "sinimg") {
                                Swal.fire(
                                  "Error!",
                                  "Debe de agregar una imagen",
                                  "error"
                                );
                              }
                            });
                        } else {
                          Swal.fire(
                            "Aviso!",
                            "La frase es demasiada corto",
                            "warning"
                          );
                          formulario = null;
                        }
                      } else {
                        Swal.fire(
                          "Aviso!",
                          "Debe de elegir un privilegio",
                          "warning"
                        );
                        formulario = null;
                      }
                    } else {
                      Swal.fire(
                        "Aviso!",
                        "La contraseña debe de tener al menos 8 carácteres",
                        "warning"
                      );
                      formulario = null;
                    }
                  } else {
                    Swal.fire(
                      "Aviso!",
                      "El correo debe tener formato de email (@example.com)",
                      "warning"
                    );
                    formulario = null;
                  }
                } else {
                  Swal.fire(
                    "Aviso!",
                    "El número de Whatsapp no es valido, debe de tener 10 digitos",
                    "warning"
                  );
                  formulario = null;
                }
              } else {
                Swal.fire(
                  "Aviso!",
                  "El usuario de Twitter no es válido",
                  "warning"
                );

                formulario = null;
              }
            } else {
              Swal.fire(
                "Aviso!",
                "El usuario de Instagram no es válido",
                "warning"
              );

              formulario = null;
            }
          } else {
            Swal.fire(
              "Aviso!",
              "El usuario de Facebook no es válido",
              "warning"
            );
            formulario = null;
          }
        } else {
          Swal.fire("Aviso!", "Debe de elegir un genero", "warning");
          formulario = null;
        }
      } else {
        Swal.fire("Aviso!", "El apellido no es válido", "warning");
        formulario = null;
      }
    } else {
      Swal.fire("Aviso!", "El nombre no es válido", "warning");
      formulario = null;
    }
    // }
  });
}

function editar(id) {
  $("#team", function () {
    let img = $(this)
      .find("#img_" + id)
      .attr("src");
    let nombre = $(this)
      .find("#nombre_" + id)
      .val();
    let apellido = $(this)
      .find("#apellido_" + id)
      .val();
    let genero = $(this)
      .find("#genero_" + id)
      .val();
    let user_facebook = $(this)
      .find("#face_" + id)
      .val();
    let user_instagram = $(this)
      .find("#insta_" + id)
      .val();
    let user_twitter = $(this)
      .find("#twitter_" + id)
      .val();
    let tel_whatsapp = $(this)
      .find("#whats_" + id)
      .val();
    let email = $(this)
      .find("#email_" + id)
      .val();
    let privilegio = $(this)
      .find("#privilegio_" + id)
      .val();
    let frase = $(this)
      .find("#frase_" + id)
      .val();

    $("#id_editar").val(id);
    $("#imgPrev_editar").attr("src", img);
    $("#nombre_editar").val(nombre);
    $("#apellido_editar").val(apellido);
    $("#genero_editar").val(genero);
    $("#user_facebook_editar").val(user_facebook);
    $("#user_instagram_editar").val(user_instagram);
    $("#user_twitter_editar").val(user_twitter);
    $("#tel_whatsapp_editar").val(tel_whatsapp);
    $("#email_editar").val(email);
    $("#privilegio_editar").val(privilegio);
    $("#frase_editar").val(frase);

    $(document).on("change", "#img_editar", function () {
      let imgCodificada = URL.createObjectURL(this.files[0]);
      $("#imgPrev_editar").attr("src", imgCodificada);

      let archivoInput = document.getElementById("img_editar").value;
      let extPermitidas =
        /(.gif|.svg|.png|.jpeg|.jpg|.webp|.GIF|.SVG|.PNG|.JPEG|.JPG|.WEBP)$/i;
      console.log(extPermitidas.exec(archivoInput));
      if (!extPermitidas.exec(archivoInput)) {
        Swal.fire(
          "Aviso!",
          "Extensión no valida, asegurate de haber seleccionado una imagen",
          "warning"
        );
      }
      document.getElementById("img_editar").value = null;
    });
  });
}

if (document.getElementById("editar_autor")) {
  document.getElementById("editar_submit").addEventListener("click", (e) => {
    e.preventDefault();

    // let archivoInput = document.getElementById("input_imagen").value;
    // let extPermitidas =
    //   /(.gif|.svg|.png|.jpeg|.jpg|.webp|.GIF|.SVG|.PNG|.JPEG|.JPG|.WEBP)$/i;
    // if (!extPermitidas.exec(archivoInput)) {
    //   Swal.fire(
    //     "Aviso!",
    //     "Extensión no valida, asegurate de haber seleccionado una imagen",
    //     "warning"
    //   );
    // } else {
    const editar_autor = document.getElementById("editar_autor");
    let formulario = new FormData(editar_autor);
    let nombre = formulario.get("nombre").trim();
    let apellido = formulario.get("apellido").trim();
    let genero = formulario.get("genero").trim();
    let user_facebook = formulario.get("user_facebook").trim();
    let user_instagram = formulario.get("user_instagram").trim();
    let user_twitter = formulario.get("user_twitter").trim();
    let tel_whatsapp = formulario.get("tel_whatsapp").trim();
    let whats = parseInt(tel_whatsapp);
    let email = formulario.get("email").trim();
    let privilegio = formulario.get("privilegio").trim();
    let frase = formulario.get("frase").trim();

    let nombreValidado = validarSoloLetras(nombre);
    let apellidoValidado = validarSoloLetras(apellido);
    let correoValidado = validarCorreo(email);
    let whatsValidado = validarSoloNumeros(whats);

    if (
      nombre == "" ||
      apellido == "" ||
      genero == "" ||
      user_facebook == "" ||
      user_instagram == "" ||
      user_twitter == "" ||
      tel_whatsapp == "" ||
      email == "" ||
      privilegio == "" ||
      frase == ""
    ) {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
      formulario = null;
    } else if (nombre.length >= 3 && nombreValidado) {
      if (apellido.length >= 3 && apellidoValidado) {
        if (genero.length >= 0) {
          if (user_facebook.length >= 0) {
            if (user_instagram.length >= 0) {
              if (user_twitter.length >= 0) {
                if (tel_whatsapp.length == 10 && whatsValidado) {
                  if (correoValidado) {
                    if (privilegio.length >= 0) {
                      if (frase.length >= 3) {
                        fetch("../assets/php/editar_autor.php", {
                          method: "POST",
                          body: formulario,
                        })
                          .then((response) => response.json())
                          .then((response) => {
                            if (response == "correcto") {
                              Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Autor actualizado",
                                showConfirmButton: !1,
                                timer: 1500,
                              });
                              setTimeout(Reedireccion, 500);
                              function Reedireccion() {
                                location.href = "./autores";
                              }
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
                          "La frase es demasiada corto",
                          "warning"
                        );
                        formulario = null;
                      }
                    } else {
                      Swal.fire(
                        "Aviso!",
                        "Debe de elegir un privilegio",
                        "warning"
                      );
                      formulario = null;
                    }
                  } else {
                    Swal.fire(
                      "Aviso!",
                      "El correo debe tener formato de email (@example.com)",
                      "warning"
                    );
                    formulario = null;
                  }
                } else {
                  Swal.fire(
                    "Aviso!",
                    "El número de Whatsapp no es valido, debe de tener 10 digitos",
                    "warning"
                  );
                  formulario = null;
                }
              } else {
                Swal.fire(
                  "Aviso!",
                  "El usuario de Twitter no es válido",
                  "warning"
                );

                formulario = null;
              }
            } else {
              Swal.fire(
                "Aviso!",
                "El usuario de Instagram no es válido",
                "warning"
              );

              formulario = null;
            }
          } else {
            Swal.fire(
              "Aviso!",
              "El usuario de Facebook no es válido",
              "warning"
            );
            formulario = null;
          }
        } else {
          Swal.fire("Aviso!", "Debe de elegir un genero", "warning");
          formulario = null;
        }
      } else {
        Swal.fire("Aviso!", "El apellido no es válido", "warning");
        formulario = null;
      }
    } else {
      Swal.fire("Aviso!", "El nombre no es válido", "warning");
      formulario = null;
    }
    // }
  });
}

function eliminar(id) {
  Swal.fire({
    title: "¿Estás seguro que deseas eliminar al autor?",
    text: "No podras recuperarlo.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      eliminar_autor = {
        id_autor: id,
      };
      fetch(`../assets/php/eliminar_autor.php`, {
        method: "POST",
        body: JSON.stringify(eliminar_autor),
        headers: { "Content-type": "aplication/json" },
      })
        .then((res) => res.json())
        .then((data) => {
          if (data == "correcto") {
            Swal.fire({
              icon: "success",
              title: "Autor eliminado",
              showConfirmButton: false,
              timer: 1500,
            });
            setTimeout(Reedireccion, 500);
            function Reedireccion() {
              location.href = "./autores";
            }
          } else {
            Swal.fire({
              icon: "error",
              title: "Error en el servidor",
              showConfirmButton: false,
              timer: 3000,
            });
          }
        });
    }
  });
}

//validar campos
function validarSoloLetras(e) {
  return !!/^[a-zA-ZñÑáéíóúüÁÉÍÓÚÜ. ]*$/.test(e);
}
function validarSoloNumeros(e) {
  return !!/^[0-9]*$/.test(e);
}
function validarCorreo(e) {
  return !!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(e);
}
