(window.fbAsyncInit = function () {
  FB.init({
    appId: "443243804180409",
    cookie: !0,
    xfbml: !0,
    version: "v11.0",
  }),
    FB.AppEvents.logPageView();
}),
  (function (e, t, n) {
    var o,
      i = e.getElementsByTagName(t)[0];
    e.getElementById(n) ||
      (((o = e.createElement(t)).id = n),
      (o.src = "https://connect.facebook.net/en_US/sdk.js"),
      i.parentNode.insertBefore(o, i));
  })(document, "script", "facebook-jssdk");
const btnFace = document.getElementById("face");
btnFace.addEventListener("click", () => {
  FB.login((e) => {
    if (e.authResponse) {
      const t = e.authResponse.accessToken;
      FB.api(
        `https://graph.facebook.com/me?fields=email,first_name,last_name,picture.type(large)&access_token=${t}`,
        (e) => {
          const t = void 0 === e.email ? "****************" : e.email,
            n = {
              first_name: e.first_name,
              last_name: e.last_name,
              picture: e.picture.data.url,
              email: t,
              red: "facebook",
            };
          fetch("./assets/php/facebook.php", {
            method: "POST",
            body: JSON.stringify(n),
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
              } else if ("error" == e) {
                Swal.fire("Error!", "Error en el servidor", "error");
              } else if ("vacio" == e) {
                Swal.fire("Error!", "No puede enviar datos vacios", "error");
              }
            });
        }
      );
    }
  });
});
