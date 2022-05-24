<?php
  session_start();
  require("../assets/php/conn.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" href="../assets/img/favicon.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Padauk:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;800&display=swap" rel="stylesheet">
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/darkmode.css" rel="stylesheet">
    <title>Mapa del sitio | SofTech blog </title>
</head>
<body>

    <?php require_once("../partials/header-menu.php"); ?>
    
    <div class="contenedor_sitemap mb-3 pb-3">
        <div class="contenedor_sitemap__titulo">
            <h1>Mapa del sitio</h1>
            <span class="contenedor_sitemap__separador"></span>
        </div>
        <div class="grap_sitemap mb-3 pb-3">
            <div class="grap_sitemap__categorias">
                <h2>Categorías</h2>
                <p><a href="seccion?sec=videojuegos" target="_blank" >Videojuegos</a></p>
                <p><a href="seccion?sec=software" target="_blank" >Software</a></p>
                <p><a id="seccion_compu">Computadoras</a></p>
                <ul>
                    <li><a href="seccion?sec=windows" target="_blank" >Windows</a></li>
                    <li><a href="seccion?sec=mac" target="_blank" >Mac</a></li>
                    <li><a href="seccion?sec=linux" target="_blank" >Linux</a></li>
                </ul>
                <p><a id="seccion_cel">Celulares</a></p>
                <ul>
                    <li><a href="seccion?sec=android" target="_blank" >Android</a></li>
                    <li><a href="seccion?sec=iOS" target="_blank" >IOS</a></li>
                </ul>
            </div>
            <div class="grap_sitemap__secciones">
                <h2>Secciones</h2>
                <p><a href="../#contact" target="_blank" >Contáctanos</a></p>
                <?php if(isset($_SESSION['usuarioblog'])){ ?>
                    <p><a href="../perfil" target="_blank" >Perfil</a></p>
                <?php }else if(isset($_SESSION['admin'])){ ?>
                    <p><a href="../perfil" target="_blank" >Perfil</a></p>
                    <p><a href="posts" target="_blank" >Ver posts</a></p>
                    <p><a href="autores" target="_blank" >Ver autores</a></p>
                    <p><a href="newsletter">Newsletter</a></p>
                    <p><a href="imgs">Imagenes del carrusel</a></p>
                <?php }else if(isset($_SESSION['admin-publicaciones'])){ ?>
                    <p><a href="../perfil" target="_blank" >Perfil</a></p>                    
                    <p><a href="posts" target="_blank" >Ver posts</a></p>                    
                    <p><a href="autores" target="_blank" >Ver autores</a></p>                    
                <?php }else{ ?>
                    <p><a href="../login" target="_blank" >Regístrate</a></p>
                    <p><a href="../login" target="_blank" >Inicia sesión</a></p>
                <?php } ?>
                <p><a href="privacidad" target="_blank" >Política de privacidad</a></p>
                <p><a href="terminos" target="_blank" >Términos y condiciones</a></p>
                <p><a href="manual" target="_blank" >Manual de usuario</a></p>
            </div>
        </div>
    </div>

    <?php require_once("../partials/footer-menu.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/darkmode.js"></script>
    <script>
        const seccion_compu = document.getElementById("seccion_compu");
        seccion_compu.addEventListener("click", (e) => {
            e.preventDefault();
        });
        const seccion_cel = document.getElementById("seccion_cel");
        seccion_cel.addEventListener("click", (e) => {
            e.preventDefault();
        });
    </script>
</body>
</html>