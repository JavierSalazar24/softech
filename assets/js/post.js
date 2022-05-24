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
  }
  document.getElementById("img_agregar").value = null;
});

if (document.getElementById("agregar_post")) {
  document.getElementById("agregar_submit").addEventListener("click", (e) => {
    e.preventDefault();

    let archivoInput = document.getElementById("img_agregar").value;
    let extPermitidas =
      /(.gif|.svg|.png|.jpeg|.jpg|.webp|.GIF|.SVG|.PNG|.JPEG|.JPG|.WEBP)$/i;
    if (!extPermitidas.exec(archivoInput)) {
      Swal.fire(
        "Aviso!",
        "Extensión no valida, asegurate de haber seleccionado una imagen",
        "warning"
      );
    } else {
      const agregar_post = document.getElementById("agregar_post");
      let formulario = new FormData(agregar_post);
      let title = formulario.get("title").trim();
      let sec = formulario.get("sec").trim();
      let author = formulario.get("author").trim();
      let notice = formulario.get("notice").trim();
      if (title == "" || sec == "" || author == "" || notice == "") {
        Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
        agregar_post = null;
      } else if (title.length >= 3) {
        if (sec.length >= 0) {
          if (author.length >= 0) {
            if (notice.length >= 3) {
              fetch("../assets/php/agregar_post.php", {
                method: "POST",
                body: formulario,
              })
                .then((response) => response.json())
                .then((response) => {
                  if (response == "correcto") {
                    Swal.fire({
                      position: "center",
                      icon: "success",
                      title: "Noticia agregada",
                      showConfirmButton: !1,
                      timer: 1500,
                    });
                    setTimeout(Reedireccion, 500);
                    function Reedireccion() {
                      location.href = "./posts";
                    }
                  } else if (response == "vacio") {
                    Swal.fire("Error!", "Datos vacíos", "error");
                  } else if (response == "error") {
                    Swal.fire("Error!", "Error en el servidor", "error");
                  } else if (response == "sinimg") {
                    Swal.fire("Error!", "Debe de agregar una imagen", "error");
                  }
                });
            } else {
              Swal.fire("Aviso!", "La noticia es demasiada corta", "warning");
              agregar_post = null;
            }
          } else {
            Swal.fire("Aviso!", "Debe de elegir un autor", "warning");
            agregar_post = null;
          }
        } else {
          Swal.fire("Aviso!", "Debe de elegir una sección", "warning");
          agregar_post = null;
        }
      } else {
        Swal.fire("Aviso!", "El titulo es demasiado corto", "warning");
        agregar_post = null;
      }
    }
  });
}

function editar(id) {
  $("#noticia", function () {
    let img = $(this)
      .find("#img_" + id)
      .attr("src");
    let titulo = $(this)
      .find("#title_" + id)
      .text();
    let seccion = $(this)
      .find("#sec_" + id)
      .val();
    let autor = $(this)
      .find("#author_" + id)
      .val();
    let noticia = $(this)
      .find("#notice_" + id)
      .val();

    let autor_int = parseInt(autor);

    $("#id_editar").val(id);
    $("#imgPrev_editar").attr("src", img);
    $("#title_editar").val(titulo);
    $("#sec_editar").val(seccion);
    $("#author_editar").val(autor_int);
    $("#notice_editar").val(noticia);

    $(document).on("change", "#img_editar", function () {
      let imgCodificada = URL.createObjectURL(this.files[0]);
      $("#imgPrev_editar").attr("src", imgCodificada);

      let archivoInput = document.getElementById("img_editar").value;
      let extPermitidas =
        /(.gif|.svg|.png|.jpeg|.jpg|.webp|.GIF|.SVG|.PNG|.JPEG|.JPG|.WEBP)$/i;
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

function eliminar(id) {
  Swal.fire({
    title: "¿Estás seguro que deseas eliminar la noticia?",
    text: "No podras recuperarlo.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      eliminar_post = {
        id_post: id,
      };
      fetch(`../assets/php/eliminar_post.php`, {
        method: "POST",
        body: JSON.stringify(eliminar_post),
        headers: { "Content-type": "aplication/json" },
      })
        .then((res) => res.json())
        .then((data) => {
          if (data == "correcto") {
            Swal.fire({
              icon: "success",
              title: "Noticia eliminada",
              showConfirmButton: false,
              timer: 1500,
            });
            setTimeout(Reedireccion, 500);
            function Reedireccion() {
              location.href = "./posts";
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

if (document.getElementById("editar_submit")) {
  document.getElementById("editar_submit").addEventListener("click", (e) => {
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
    const editarForm = document.getElementById("editarForm");
    let formulario = new FormData(editarForm);
    let title = formulario.get("title").trim();
    let sec = formulario.get("sec").trim();
    let author = formulario.get("author").trim();
    let notice = formulario.get("notice").trim();
    if (title == "" || sec == "" || author == "" || notice == "") {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
      editarForm = null;
    } else if (title.length >= 3) {
      if (sec.length >= 0) {
        if (author.length >= 0) {
          if (notice.length >= 3) {
            fetch("../assets/php/editar_post.php", {
              method: "POST",
              body: formulario,
            })
              .then((response) => response.json())
              .then((response) => {
                if (response == "correcto") {
                  Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Noticia actualizada",
                    showConfirmButton: !1,
                    timer: 1500,
                  });
                  setTimeout(Reedireccion, 500);
                  function Reedireccion() {
                    location.href = "./posts";
                  }
                } else if (response == "vacio") {
                  Swal.fire("Error!", "Datos vacíos", "error");
                } else if (response == "error") {
                  Swal.fire("Error!", "Error en el servidor", "error");
                }
              });
          } else {
            Swal.fire("Aviso!", "La noticia es demasiada corta", "warning");
            editarForm = null;
          }
        } else {
          Swal.fire("Aviso!", "Debe de elegir un autor", "warning");
          editarForm = null;
        }
      } else {
        Swal.fire("Aviso!", "Debe de elegir una sección", "warning");
        editarForm = null;
      }
    } else {
      Swal.fire("Aviso!", "El titulo es demasiado corto", "warning");
      editarForm = null;
    }
    // }
  });
}
