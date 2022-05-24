$(document).on("change", "#input_imagen", function () {
  let imgCodificada = URL.createObjectURL(this.files[0]);
  $("#imgPrev_agregar").attr("src", imgCodificada);

  let archivoInput = document.getElementById("input_imagen").value;
  let extPermitidas =
    /(.gif|.svg|.png|.jpeg|.jpg|.webp|.GIF|.SVG|.PNG|.JPEG|.JPG|.WEBP)$/i;
  if (!extPermitidas.exec(archivoInput)) {
    Swal.fire(
      "Aviso!",
      "Extensión no valida, asegurate de haber seleccionado una imagen",
      "warning"
    );
    $("#imgPrev_agregar").attr("src", "../assets/img/logo.png");
    document.getElementById("input_imagen").value = null;
  }
});

if (document.getElementById("agregar_imgs")) {
  document.getElementById("agregar_submit").addEventListener("click", (e) => {
    e.preventDefault();

    let archivoInput = document.getElementById("input_imagen").value;
    let extPermitidas =
      /(.gif|.svg|.png|.jpeg|.jpg|.webp|.GIF|.SVG|.PNG|.JPEG|.JPG|.WEBP)$/i;
    if (!extPermitidas.exec(archivoInput)) {
      Swal.fire(
        "Aviso!",
        "Extensión no valida, asegurate de haber seleccionado una imagen",
        "warning"
      );
    } else {
      const agregar_imgs = document.getElementById("agregar_imgs");
      let formulario = new FormData(agregar_imgs);
      let img_carrusel = formulario.get("img_carrusel").name.trim();

      if (img_carrusel == "") {
        Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
        formulario = null;
      } else if (img_carrusel.length >= 0) {
        fetch("../assets/php/agregar_img.php", {
          method: "POST",
          body: formulario,
        })
          .then((response) => response.json())
          .then((response) => {
            if (response == "correcto") {
              Swal.fire({
                position: "center",
                icon: "success",
                title: "Imágen agregada",
                showConfirmButton: !1,
                timer: 1500,
              });
              setTimeout(Reedireccion, 500);
              function Reedireccion() {
                location.href = "./imgs";
              }
            } else if (response == "vacio") {
              Swal.fire("Error!", "Datos vacíos", "error");
            } else if (response == "error") {
              Swal.fire("Error!", "Error en el servidor", "error");
            }
          });
      } else {
        Swal.fire("Aviso!", "Debes de agregar una imágen", "warning");
        formulario = null;
      }
    }
  });
}

function editar(id) {
  $("#team", function () {
    let img = $(this)
      .find("#img_" + id)
      .attr("src");

    $("#id_editar").val(id);
    $("#imgPrev_editar").attr("src", img);

    $(document).on("change", "#input_imagen_editar", function () {
      let imgCodificada = URL.createObjectURL(this.files[0]);
      $("#imgPrev_editar").attr("src", imgCodificada);

      let archivoInput = document.getElementById("input_imagen_editar").value;
      let extPermitidas =
        /(.gif|.svg|.png|.jpeg|.jpg|.webp|.GIF|.SVG|.PNG|.JPEG|.JPG|.WEBP)$/i;
      if (!extPermitidas.exec(archivoInput)) {
        Swal.fire(
          "Aviso!",
          "Extensión no valida, asegurate de haber seleccionado una imagen",
          "warning"
        );
        $("#imgPrev_editar").attr("src", "../assets/img/logo.png");
        document.getElementById("input_imagen_editar").value = null;
      }
    });
  });
}

if (document.getElementById("editar_imgs")) {
  document.getElementById("editar_submit").addEventListener("click", (e) => {
    e.preventDefault();

    // let archivoInput = document.getElementById("input_imagen_editar").value;
    // let extPermitidas =
    //   /(.gif|.svg|.png|.jpeg|.jpg|.webp|.GIF|.SVG|.PNG|.JPEG|.JPG|.WEBP)$/i;
    // if (!extPermitidas.exec(archivoInput)) {
    //   Swal.fire(
    //     "Aviso!",
    //     "Extensión no valida, asegurate de haber seleccionado una imagen",
    //     "warning"
    //   );
    // } else {
    const editar_imgs = document.getElementById("editar_imgs");
    let formulario = new FormData(editar_imgs);
    let img_carrusel = formulario.get("img_carrusel").name.trim();

    if (img_carrusel == "") {
      Swal.fire("Aviso!", "Debes de llenar todos los campos", "warning");
      formulario = null;
    } else if (img_carrusel.length >= 0) {
      fetch("../assets/php/editar_img.php", {
        method: "POST",
        body: formulario,
      })
        .then((response) => response.json())
        .then((response) => {
          if (response == "correcto") {
            Swal.fire({
              position: "center",
              icon: "success",
              title: "Imágen actualizada",
              showConfirmButton: !1,
              timer: 1500,
            });
            setTimeout(Reedireccion, 500);
            function Reedireccion() {
              location.href = "./imgs";
            }
          } else if (response == "vacio") {
            Swal.fire("Error!", "Datos vacíos", "error");
          } else if (response == "error") {
            Swal.fire("Error!", "Error en el servidor", "error");
          }
        });
    } else {
      Swal.fire("Aviso!", "Debe de agregar una imágen", "warning");
      formulario = null;
    }
    // }
  });
}

function eliminar(id) {
  Swal.fire({
    title: "¿Estás seguro que deseas eliminar la imágen?",
    text: "No podras recuperarla.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
    cancelButtonColor: "#d33",
  }).then((result) => {
    if (result.isConfirmed) {
      eliminar_img = {
        id_img: id,
      };
      fetch(`../assets/php/eliminar_img.php`, {
        method: "POST",
        body: JSON.stringify(eliminar_img),
        headers: { "Content-type": "aplication/json" },
      })
        .then((res) => res.json())
        .then((data) => {
          if (data == "correcto") {
            Swal.fire({
              icon: "success",
              title: "Imágen eliminada",
              showConfirmButton: false,
              timer: 1500,
            });
            setTimeout(Reedireccion, 500);
            function Reedireccion() {
              location.href = "./imgs";
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
