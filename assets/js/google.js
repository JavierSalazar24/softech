var googleUser = {},
  startApp = function () {
    gapi.load("auth2", function () {
      (auth2 = gapi.auth2.init({
        client_id:
          "511192057597-fk6hi457g4gb197vp42ibpsian0pr2er.apps.googleusercontent.com",
        cookiepolicy: "single_host_origin",
        scope: "profile email",
      })),
        attachSignin(document.getElementById("google"));
    });
  };
function attachSignin(e) {
  auth2.attachClickHandler(e, {}, function (e) {
    const i = e.getBasicProfile(),
      o = {
        first_name: i.getGivenName(),
        last_name: i.getFamilyName(),
        picture: i.getImageUrl(),
        email: i.getEmail(),
        red: "google",
      };
    fetch("./assets/php/google.php", {
      method: "POST",
      body: JSON.stringify(o),
      headers: { "Content-type": "aplication/json" },
    })
      .then((e) => e.json())
      .then((e) => {
        if ("correcto" == e) {
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
        } else if ("error" == e) {
          Swal.fire("Error!", "Error en el servidor", "error");
        } else if ("vacio" == e) {
          Swal.fire("Error!", "No puede enviar datos vacios", "error");
        } else if ("admin" == e) {
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
        }
      });
  });
}
startApp();
