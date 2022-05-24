const btnSwitch = document.querySelector("#switch");
btnSwitch.addEventListener("click", () => {
  document.body.classList.toggle("dark");
  btnSwitch.classList.toggle("active");
  if (document.body.classList.contains("dark")) {
    localStorage.setItem("dark-mode", "true");

    if (document.getElementById("img_logo")) {
      const img_darkmode = document.getElementById("img_logo");
      img_darkmode.src = "./assets/img/logo_darkmode.png";
    } else if (document.getElementById("img_logo_menu")) {
      const img_darkmode_menu = document.getElementById("img_logo_menu");
      img_darkmode_menu.src = "../assets/img/logo_darkmode.png";
    }
  } else {
    localStorage.setItem("dark-mode", "false");
    if (document.getElementById("img_logo")) {
      const img_logo = document.getElementById("img_logo");
      img_logo.src = "./assets/img/logo.png";
    } else if (document.getElementById("img_logo_menu")) {
      const img_logo_menu = document.getElementById("img_logo_menu");
      img_logo_menu.src = "../assets/img/logo.png";
    }
  }
});
if (localStorage.getItem("dark-mode") === "true") {
  document.body.classList.add("dark");
  btnSwitch.classList.add("active");
  if (document.getElementById("img_logo")) {
    const img_darkmode = document.getElementById("img_logo");
    img_darkmode.src = "./assets/img/logo_darkmode.png";
  } else if (document.getElementById("img_logo_menu")) {
    const img_darkmode_menu = document.getElementById("img_logo_menu");
    img_darkmode_menu.src = "../assets/img/logo_darkmode.png";
  }
} else {
  document.body.classList.remove("dark");
  btnSwitch.classList.remove("active");
  if (document.getElementById("img_logo")) {
    const img_logo = document.getElementById("img_logo");
    img_logo.src = "./assets/img/logo.png";
  } else if (document.getElementById("img_logo_menu")) {
    const img_logo_menu = document.getElementById("img_logo_menu");
    img_logo_menu.src = "../assets/img/logo.png";
  }
}
