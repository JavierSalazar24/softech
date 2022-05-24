if (document.getElementById("perfilForm_user")) {
  document.getElementById("btnPerfil").addEventListener("click", (e) => {
    e.preventDefault();
    if (document.getElementById("btnPerfil").innerHTML == "Editar perfil") {
      document.getElementById("btnPerfil").innerHTML = "Guardar cambios";
      document.getElementById("input_nombre").disabled = false;
      document.getElementById("input_apellido").disabled = false;
      document.getElementById("input_imagen").disabled = false;
    } else {
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
      const perfilForm = document.getElementById("perfilForm_user");
      let formulario = new FormData(perfilForm);
      let nombre = formulario.get("nombre").trim();
      let apellido = formulario.get("apellido").trim();
      let validarNombre = validarSoloLetras(nombre);
      let validarApellido = validarSoloLetras(apellido);
      if (nombre == "" || apellido == "") {
        Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
        perfilForm = null;
      } else if (nombre.length >= 3 && validarNombre) {
        if (apellido.length >= 3 && validarApellido) {
          fetch("assets/php/editar_perfil.php", {
            method: "POST",
            body: formulario,
          })
            .then((response) => response.json())
            .then((response) => {
              if (response == "correcto") {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Perfil actualizado",
                  showConfirmButton: !1,
                  timer: 1500,
                });
                document.getElementById("btnPerfil").innerHTML =
                  "Editar perfil";
                document.getElementById("input_nombre").disabled = true;
                document.getElementById("input_apellido").disabled = true;
                document.getElementById("input_imagen").disabled = true;
              } else if (response == "vacio") {
                Swal.fire("Error!", "Datos vacíos", "error");
              } else if (response == "error") {
                Swal.fire("Error!", "Error en el servidor", "error");
              }
            });
        } else {
          Swal.fire("Aviso!", "El apellido no es válido", "warning");
          perfilForm = null;
        }
      } else {
        Swal.fire("Aviso!", "El nombre no es válido", "warning");
        perfilForm = null;
      }
      // }
    }
  });

  if (
    document.getElementById("nombrePerfil") &&
    document.getElementById("apellidoPerfil")
  ) {
    let nombre_edit = document.getElementById("input_nombre");
    let apellido_edit = document.getElementById("input_apellido");
    nombre_edit.addEventListener("keyup", () => {
      document.getElementById("nombrePerfil").innerText = "";
      document.getElementById("nombrePerfil").innerText += nombre_edit.value;
    });
    apellido_edit.addEventListener("keyup", () => {
      document.getElementById("apellidoPerfil").innerText = "";
      document.getElementById("apellidoPerfil").innerText +=
        apellido_edit.value;
    });
  }

  $(document).on("change", "#input_imagen", function () {
    let imgCodificada = URL.createObjectURL(this.files[0]);
    $("#imagen_sub").attr("src", imgCodificada);

    let archivoInput = document.getElementById("input_imagen").value;
    let extPermitidas = /(.gif | .svg | .png | .jpeg | .jpg | .webp)$/i;
    if (!extPermitidas.exec(archivoInput)) {
      Swal.fire(
        "Aviso!",
        "Extensión no valida, asegurate de haber seleccionado una imagen",
        "warning"
      );
    }
    document.getElementById("input_imagen").value = null;
  });
} else if (document.getElementById("perfilForm_admin")) {
  document.getElementById("btnPerfil_admin").addEventListener("click", (e) => {
    e.preventDefault();

    if (
      document.getElementById("btnPerfil_admin").innerHTML == "Editar perfil"
    ) {
      document.getElementById("btnPerfil_admin").innerHTML = "Guardar cambios";
      document.getElementById("input_imagen").disabled = false;
      document.getElementById("input_nombre").disabled = false;
      document.getElementById("input_apellido").disabled = false;
      document.getElementById("input_genero").disabled = false;
      document.getElementById("input_facebook").disabled = false;
      document.getElementById("input_instagram").disabled = false;
      document.getElementById("input_twitter").disabled = false;
      document.getElementById("input_whatsapp").disabled = false;
      document.getElementById("input_frase").disabled = false;
      document.getElementById("input_privilegio").disabled = false;
    } else {
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
      const perfilForm = document.getElementById("perfilForm_admin");
      let formulario = new FormData(perfilForm);
      let nombre = formulario.get("nombre").trim();
      let apellido = formulario.get("apellido").trim();
      let genero = formulario.get("genero").trim();
      let face = formulario.get("face").trim();
      let insta = formulario.get("insta").trim();
      let twitter = formulario.get("twitter").trim();
      let whats = formulario.get("whats").trim();
      let tel_whats = parseInt(whats);
      let frase = formulario.get("frase").trim();
      let privilegio = formulario.get("privilegio").trim();
      let validarNombre = validarSoloLetras(nombre);
      let validarApellido = validarSoloLetras(apellido);
      let validarGenero = validarSoloLetras(genero);
      let validarWhats = validarSoloNumeros(tel_whats);
      if (
        nombre == "" ||
        apellido == "" ||
        genero == "" ||
        face == "" ||
        insta == "" ||
        twitter == "" ||
        whats == "" ||
        frase == ""
      ) {
        Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
        perfilForm = null;
      } else if (nombre.length >= 3 && validarNombre) {
        if (apellido.length >= 3 && validarApellido) {
          if (genero.length >= 0 && validarGenero) {
            if (face.length >= 0) {
              if (insta.length >= 0) {
                if (twitter.length >= 0) {
                  if (whats.length == 10 && validarWhats) {
                    if (privilegio.length >= 0) {
                      if (frase.length >= 3) {
                        fetch("assets/php/editar_perfil.php", {
                          method: "POST",
                          body: formulario,
                        })
                          .then((response) => response.json())
                          .then((response) => {
                            if (response == "correcto") {
                              Swal.fire({
                                position: "center",
                                icon: "success",
                                title: "Perfil actualizado",
                                showConfirmButton: !1,
                                timer: 1500,
                              });
                              document.getElementById("btnPerfil").innerHTML =
                                "Editar perfil";
                              document.getElementById(
                                "input_imagen"
                              ).disabled = true;
                              document.getElementById(
                                "input_nombre"
                              ).disabled = true;
                              document.getElementById(
                                "input_apellido"
                              ).disabled = true;
                              document.getElementById(
                                "input_genero"
                              ).disabled = true;
                              document.getElementById(
                                "input_facebook"
                              ).disabled = true;
                              document.getElementById(
                                "input_instagram"
                              ).disabled = true;
                              document.getElementById(
                                "input_twitter"
                              ).disabled = true;
                              document.getElementById(
                                "input_whatsapp"
                              ).disabled = true;
                              document.getElementById(
                                "input_frase"
                              ).disabled = true;
                              document.getElementById(
                                "input_privilegio"
                              ).disabled = true;
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
          perfilForm = null;
        }
      } else {
        Swal.fire("Aviso!", "El nombre no es válido", "warning");
        perfilForm = null;
      }
      // }
    }
  });

  if (
    document.getElementById("nombrePerfil") &&
    document.getElementById("apellidoPerfil")
  ) {
    let nombre_edit = document.getElementById("input_nombre");
    let apellido_edit = document.getElementById("input_apellido");
    nombre_edit.addEventListener("keyup", () => {
      document.getElementById("nombrePerfil").innerText = "";
      document.getElementById("nombrePerfil").innerText += nombre_edit.value;
    });
    apellido_edit.addEventListener("keyup", () => {
      document.getElementById("apellidoPerfil").innerText = "";
      document.getElementById("apellidoPerfil").innerText +=
        apellido_edit.value;
    });
  }

  $(document).on("change", "#input_imagen", function () {
    let imgCodificada = URL.createObjectURL(this.files[0]);
    $("#imagen_sub").attr("src", imgCodificada);

    let archivoInput = document.getElementById("input_imagen").value;
    let extPermitidas = /(.gif | .svg | .png | .jpeg | .jpg | .webp)$/i;
    if (!extPermitidas.exec(archivoInput)) {
      Swal.fire(
        "Aviso!",
        "Extensión no valida, asegurate de haber seleccionado una imagen",
        "warning"
      );
    }
    document.getElementById("input_imagen").value = null;
  });
} else if (document.getElementById("perfilForm_admin-publi")) {
  document.getElementById("btnPerfil_admin").addEventListener("click", (e) => {
    e.preventDefault();
    if (
      document.getElementById("btnPerfil_admin").innerHTML == "Editar perfil"
    ) {
      document.getElementById("btnPerfil_admin").innerHTML = "Guardar cambios";
      document.getElementById("input_imagen").disabled = false;
      document.getElementById("input_nombre").disabled = false;
      document.getElementById("input_apellido").disabled = false;
      document.getElementById("input_genero").disabled = false;
      document.getElementById("input_facebook").disabled = false;
      document.getElementById("input_instagram").disabled = false;
      document.getElementById("input_twitter").disabled = false;
      document.getElementById("input_whatsapp").disabled = false;
      document.getElementById("input_frase").disabled = false;
    } else {
      // let archivoInput = document.getElementById("input_imagen").value;
      // let extPermitidas =
      //   /.gif|.svg|.png|.jpeg|.jpg|.webp|.GIF|.SVG|.PNG|.JPEG|.JPG|.WEBP)$/i;
      // if (!extPermitidas.exec(archivoInput)) {
      //   Swal.fire(
      //     "Aviso!",
      //     "Extensión no valida, asegurate de haber seleccionado una imagen",
      //     "warning"
      //   );
      // } else {
      const perfilForm = document.getElementById("perfilForm_admin-publi");
      let formulario = new FormData(perfilForm);
      let nombre = formulario.get("nombre").trim();
      let apellido = formulario.get("apellido").trim();
      let genero = formulario.get("genero").trim();
      let face = formulario.get("face").trim();
      let insta = formulario.get("insta").trim();
      let twitter = formulario.get("twitter").trim();
      let whats = formulario.get("whats").trim();
      let tel_whats = parseInt(whats);
      let frase = formulario.get("frase").trim();
      let validarNombre = validarSoloLetras(nombre);
      let validarApellido = validarSoloLetras(apellido);
      let validarGenero = validarSoloLetras(genero);
      let validarWhats = validarSoloNumeros(tel_whats);
      if (
        nombre == "" ||
        apellido == "" ||
        genero == "" ||
        face == "" ||
        insta == "" ||
        twitter == "" ||
        whats == "" ||
        frase == ""
      ) {
        Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
        perfilForm = null;
      } else if (nombre.length >= 3 && validarNombre) {
        if (apellido.length >= 3 && validarApellido) {
          if (genero.length >= 0 && validarGenero) {
            if (face.length >= 0) {
              if (insta.length >= 0) {
                if (twitter.length >= 0) {
                  if (whats.length == 10 && validarWhats) {
                    if (frase.length >= 3) {
                      fetch("assets/php/editar_perfil.php", {
                        method: "POST",
                        body: formulario,
                      })
                        .then((response) => response.json())
                        .then((response) => {
                          if (response == "correcto") {
                            Swal.fire({
                              position: "center",
                              icon: "success",
                              title: "Perfil actualizado",
                              showConfirmButton: !1,
                              timer: 1500,
                            });
                            document.getElementById("btnPerfil").innerHTML =
                              "Editar perfil";
                            document.getElementById(
                              "input_imagen"
                            ).disabled = true;
                            document.getElementById(
                              "input_nombre"
                            ).disabled = true;
                            document.getElementById(
                              "input_apellido"
                            ).disabled = true;
                            document.getElementById(
                              "input_genero"
                            ).disabled = true;
                            document.getElementById(
                              "input_facebook"
                            ).disabled = true;
                            document.getElementById(
                              "input_instagram"
                            ).disabled = true;
                            document.getElementById(
                              "input_twitter"
                            ).disabled = true;
                            document.getElementById(
                              "input_whatsapp"
                            ).disabled = true;
                            document.getElementById(
                              "input_frase"
                            ).disabled = true;
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
          perfilForm = null;
        }
      } else {
        Swal.fire("Aviso!", "El nombre no es válido", "warning");
        perfilForm = null;
      }
      // }
    }
  });

  if (
    document.getElementById("nombrePerfil") &&
    document.getElementById("apellidoPerfil")
  ) {
    let nombre_edit = document.getElementById("input_nombre");
    let apellido_edit = document.getElementById("input_apellido");
    nombre_edit.addEventListener("keyup", () => {
      document.getElementById("nombrePerfil").innerText = "";
      document.getElementById("nombrePerfil").innerText += nombre_edit.value;
    });
    apellido_edit.addEventListener("keyup", () => {
      document.getElementById("apellidoPerfil").innerText = "";
      document.getElementById("apellidoPerfil").innerText +=
        apellido_edit.value;
    });
  }

  $(document).on("change", "#input_imagen", function () {
    let imgCodificada = URL.createObjectURL(this.files[0]);
    $("#imagen_sub").attr("src", imgCodificada);

    let archivoInput = document.getElementById("input_imagen").value;
    let extPermitidas =
      /(.gif|.svg|.png|.jpeg|.jpg|.webp|.GIF|.SVG|.PNG|.JPEG|.JPG|.WEBP)$/i;
    if (!extPermitidas.exec(archivoInput)) {
      Swal.fire(
        "Aviso!",
        "Extensión no valida, asegurate de haber seleccionado una imagen",
        "warning"
      );
    }
    document.getElementById("input_imagen").value = null;
  });
}

if (document.getElementById("btnPerfilFace")) {
  document.getElementById("btnPerfilFace").addEventListener("click", (e) => {
    e.preventDefault(),
      Swal.fire({
        title: "Advertencia",
        text: "No puedes editar tu perfil de facebook desde aquí",
        icon: "warning",
        position: "center",
      });
  });
} else if (document.getElementById("btnPerfilGoogle")) {
  document.getElementById("btnPerfilFace").addEventListener("click", (e) => {
    e.preventDefault(),
      Swal.fire({
        title: "Advertencia",
        text: "No puedes editar tu perfil de google desde aquí",
        icon: "warning",
        position: "center",
      });
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
