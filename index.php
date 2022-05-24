<?php

session_start();
require("assets/php/conn.php");
require("assets/php/functions.php");

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SofTech Blog | Inicio</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/favicon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;800&display=swap" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/darkmode.css" rel="stylesheet">
</head>

<body class="dark">

  <div class="preloader">
    <div class="preloader_loader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
  </div>

  <!-- ======= Barra superior ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope-fill"></i><a href="#newsletter" class="scrollto">¡Suscríbete a nuestro boletín de noticias!</a>
      </div>
      <div class="social-links d-none d-md-block">
        <a href="https://www.facebook.com/" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://www.instagram.com/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="https://www.twitter.com/" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="https://wa.me/526182001024?text=Hola%20SofTech%necesito%20ayuda." target="_blank" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
      </div>
    </div>
  </section>

  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">
      <a href="./" class="logo me-auto"><img src="assets/img/logo.png" alt="Logo de la empresa" id="img_logo" class="animacion img-fluid"></a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="menu/seccion?sec=videojuegos">Videojuegos</a></li>
          <li><a class="nav-link scrollto" href="menu/seccion?sec=software">Software</a></li>
          <li class="dropdown"><a href="#"><span>Computadoras</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="menu/seccion?sec=windows">Windows</a></li>
              <li><a href="menu/seccion?sec=mac">Mac</a></li>
              <li><a href="menu/seccion?sec=linux">Linux</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Celulares</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="menu/seccion?sec=android">Android</a></li>
              <li><a href="menu/seccion?sec=iOS">iOS</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="#contact">Contáctanos</a></li>
          <?php if(isset($_SESSION['admin']) || isset($_SESSION['admin-publicaciones'])){
            $correo = isset($_SESSION['admin']) ? $_SESSION['admin'] : $_SESSION['admin-publicaciones'];
            $consulta = mysqli_query($conn, "SELECT * FROM authors WHERE email = '$correo'");
        
            while ($info = mysqli_fetch_array($consulta)) {
              $nombres = $info['name'];
              $apellidos = $info['last_name'];
              $genero = $info['gender'];
              $foto = $info['picture'];
            }
          ?>
            <li class="dropdown user"><a href="#"><span><?php echo $nombres.' '.$apellidos ?></span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="./menu/autores">Autores</a></li>
                <li><a href="./menu/posts">Ver post</a></li>
                <li><a href="perfil">Perfil</a></li>
                <?php if(isset($_SESSION['admin'])){ ?>
                  <li><a href="./menu/newsletter">Newsletter</a></li>
                  <li><a href="./menu/imgs">Imagenes del carrusel</a></li>
                <?php } ?>
                <li><a href="./assets/php/cerrar_sesion">Cerrar sesión</a></li>
              </ul>
            </li>
          <?php }else if(isset($_SESSION['usuarioblog'])){
            $correo = $_SESSION['usuarioblog'];
            $consulta = mysqli_query($conn, "SELECT * FROM users WHERE email = '$correo'");
        
            while ($info = mysqli_fetch_array($consulta)) {
              $nombres = $info['name'];
              $apellidos = $info['last_name'];
            }
          ?>
            <li class="dropdown user"><a href="#"><span><?php echo $nombres.' '.$apellidos ?></span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="perfil">Perfil</a></li>
                <li><a href="./assets/php/cerrar_sesion">Cerrar sesión</a></li>
              </ul>
            </li>
          <?php }else{ ?>
            <li class="me-4"><a class="getstarted scrollto login" href="login">Inicia sesión</a></li>
          <?php } ?>
          <li>
            <form class="form-inline my-2 my-lg-0 d-flex" action="busqueda" method="get">
              <input id="search-bar" class="form-control mr-sm-2" type="search" placeholder="Búsqueda" aria-label="Search" name="q" required minlength="3">
              <input type="hidden" name="opc" value="busqueda">
              <button class="btn btn-search my-2 my-sm-0" type="submit"><i class='bx bx-search'></i></button>
            </form>
          </li>
          <li>
            <button class="switch" id="switch">
              <span><i class='bx bxs-moon'></i></span>
              <span><i class='bx bxs-sun' ></i></span>
            </button>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header>

  <section id="principal">
    <div id="principalCarousel" class="carousel slide carousel-fade">
      <div class="carousel-inner">
        <div class="carousel-item active" style="background-image: url(assets/img/slide/slide1.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">¡Bienvenido(a) a <span>SofTech</span>!</h2>
              <p class="animate__animated animate__fadeInUp">Toda la información de tecnología que necesitas, a un clic
                de distancia. Regístrate para tener acceso ilimitado a nuestro contenido.</p>
              <a href="#latest-posts" class="btn-get-started animate__animated animate__fadeInUp scrollto">Leer últimas
                publicaciones</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <main id="main">
    <section id="latest-posts" class="latest-posts section-bg">
      <div class="container">

        <div class="section-title mt-5">
          <h2>Últimas publicaciones</h2>
        </div>


        <div class="row no-gutters">


          <?php
          $sql = mysqli_query($conn, "SELECT * FROM posts ORDER BY date DESC LIMIT 6");

          if (mysqli_num_rows($sql)) {
            while ($row = mysqli_fetch_array($sql)) {

              $date = strtotime($row["date"]);
              $id_author = $row["author"];

              $sql_author = mysqli_query($conn, "SELECT * FROM authors WHERE id = '$id_author'");

              $row_author = mysqli_fetch_array($sql_author);
          ?>
              <div class="col-lg-4 col-md-6 mb-3">
                <div class="card">
                  <img class="card-img-top" src="assets/img/posts/<?php echo $row["multimedia"]; ?>" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $row["title"]; ?></h5>
                    <div class="section-post mb-2">
                      <a href="menu/seccion?sec=<?php echo $row["section"]; ?>"><?php echo $row["section"]; ?></a>
                    </div>
                    <div class="author d-flex align-items-center mb-4">
                      <img src="assets/img/authors/<?php echo $row_author["picture"]; ?>" alt="" class="author-profile me-2">
                      <a href="#team" class="scrollto author-name me-2"><?php echo $row_author["name"] . ' ' . $row_author["last_name"]; ?></a>
                      <span class="time-ago"><?php echo timeago($date); ?></span>
                    </div>
                    <p class="card-text"> <?php echo substr($row["content"], 0, 100) . "..." ?>
                    </p>
                    <a href="menu/publicacion?id=<?php echo $row["id"] ?>">Seguir leyendo..</a>
                  </div>
                </div>
              </div>
            <?php
            }
          } else {
            ?>
            <p>No hay nada</p>
          <?php
          }
          ?>


        </div>

      </div>
    </section>

    <section id="newsletter" class="newsletter">
      <div class="cont-newsletter">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
              <h4>Suscríbete a nuestro boletín de noticias</h4>
              <p>¡Entérate de nuestras publicaciones antes que nadie! Manténte informado con lo último en tecnología,
                donde quiera que estés.</p>
            </div>
            <div class="col-lg-6">
              <form id="newsletterForm" method="post" autocomplete="off">
                <input class="email_suscribirme" type="email" name="email" title="Completa este campo / example@gmail.com" placeholder="Correo electrónico" required><input class="input_suscribirme" type="submit" value="Suscribirme">
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="team" class="team section-bg">
      <div class="container">
        <div class="section-title">
          <h2>Nuestro equipo</h2>
          <p>¿Quiénes hacen de SofTech la plataforma más confiable de información tecnológica? A continuación, podrás
            concocer a nuestros colaboradores:</p>
        </div>

        <div class="row justify-content-center">
          <?php 
            $consulta_authors = mysqli_query($conn, "SELECT * FROM authors");
            $validacion_authors = mysqli_num_rows($consulta_authors);

            if ($validacion_authors > 0) {

              foreach($consulta_authors as $info_authors){

          ?>
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
              <div class="member">
                <img src="assets/img/authors/<?php if(empty($info_authors['picture'])){ echo 'unknown.png'; }else{ echo $info_authors['picture']; } ?>" alt="Foto de <?php echo $info_authors['name'].' '.$info_authors['last_name'] ?>">
                <h4><?php echo $info_authors['name'].' '.$info_authors['last_name'] ?></h4>
                <span><?php if($info_authors['gender'] == 'F'){ echo 'Editora'; }else{ echo 'Editor'; } ?></span>
                <p>
                  "<?php echo $info_authors['phrase'] ?>"
                </p>
                <div class="social">
                  <?php if(!empty($info_authors['user_facebook'])){ ?>
                    <a href="https://www.facebook.com/<?php echo $info_authors['user_facebook'] ?>/" target="_blank"><i class="bi bi-facebook"></i></a>
                  <?php } if(!empty($info_authors['user_instagram'])){ ?>
                    <a href="https://www.instagram.com/<?php echo $info_authors['user_instagram'] ?>/" target="_blank"><i class="bi bi-instagram"></i></a>
                  <?php } if(!empty($info_authors['user_twitter'])){ ?>
                    <a href="https://twitter.com/<?php echo $info_authors['user_twitter'] ?>/" target="_blank"><i class="bi bi-twitter"></i></a>
                  <?php } if(!empty($info_authors['tel_whatsapp'])){ ?>
                    <a href="https://wa.me/52<?php echo $info_authors['tel_whatsapp'] ?>?text=¡Hola%20<?php echo $info_authors['name']?>!%20Me%20interesa%20saber%20más%20de%20SofTech." target="_blank"><i class="bi bi-whatsapp"></i></a>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php 
            } }
          ?>
        </div>
      </div>
    </section>

    <div id="contact" class="form-3">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="text-container">
              <div class="section-title">
                <h2>Contáctanos</h2>
              </div>
              <p>Si tienes preguntas, ponte en contacto con nosotros llenando el siguiente formulario.
                ¡Un asistente te atenderá y responderá tu mensaje!</p>
              <ul class="list-unstyled li-space-lg">
                <li class="media d-flex align-items-center mb-4">
                  <i class="bx bx-map"></i>
                  <div class="media-body">
                    <a class="link-footer" href="https://www.google.com/maps/place/Universidad+Tecnol%C3%B3gica+de+Durango/@23.9901183,-104.6197695,17z/data=!3m1!4b1!4m5!3m4!1s0x869bb833da45df2b:0x2392fefbf317535!8m2!3d23.9901183!4d-104.6175808" target="_blank">Carr. Durango – Mezquital, Km. 4.5 Gabino Santillán. C.P. 34308, Durango, Dgo.</a>
                  </div>
                </li>
                <li class="media d-flex align-items-center mb-4">
                  <i class="bx bx-phone"></i>
                  <div class="media-body">
                    <a class="link-footer" href="tel:6181483067">(618) 148-3067</a>
                  </div>
                </li>
                <li class="media d-flex align-items-center">
                  <i class="bx bx-envelope"></i>
                  <div class="media-body">
                    <a class="link-footer" href="mailto:mensajesoftech@gmail.com">mensajesoftech@gmail.com</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <div class="col-lg-6">
            <form id="contactForm" data-toggle="validator" data-focus="false">
              <div class="form-group">
                <label class="label-control" for="cname">Nombre</label>
                <input type="text" title="Completa este campo / Solo letras" minlength="3" pattern="[a-zA-Zá-úÁ-Ú ]+" class="form-control-input" name="cname" id="cname" required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label class="label-control" for="cemail">Email</label>
                <input type="email" title="Completa este campo / example@gmail.com" class="form-control-input" name="cemail" id="cemail" required>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <label class="label-control" for="cmessage">Mensaje</label>
                <textarea class="form-control-textarea" name="cmessage" id="cmessage" required></textarea>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group checkbox">
                <input type="checkbox" id="cterms" value="Agreed-to-Terms" title="Marca la casilla para enviar el formulario" required>He leído y acepto la <a class="contact-link" href="menu/privacidad">Política de privaciadad</a> y <a class="contact-link" href="menu/terminos">Términos y Condiciones</a>
                <div class="help-block with-errors"></div>
              </div>
              <div class="form-group">
                <button type="submit" id="csubmit" class="form-control-submit-button">Enviar mensaje</button>
              </div>
              <div class="form-message">
                <div id="cmsgSubmit" class="h3 text-center hidden"></div>
              </div>
            </form>
          </div>
        </div>
      </div>      
    </div>

    <div class="whatsapp-fixed">
      <a rel="nofollow" title="contáctanos enviando mensaje por whatsapp" href="https://wa.me/526182001024?text=SofTech%20está%20dispuesto%20a%20ayudarte%20¿Cuál%20es%20tu%20duda?" target="_blank">
        <img src="./assets/img/whatsapp.png" alt="Whatsapp">
      </a>
    </div>
  </main>


  <div class="pt-5 pb-5 footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-xs-12 about-company">
          <img class="logofooter mb-3" src="assets/img/logo.png" alt="Logo de la empresa">
          <p class="pr-5 text-white-50">Tu blog de tecnología, donde quiera que estés. Síguenos en redes sociales:</p>
          <p>
            <a class="link-footer" href="https://www.facebook.com/" target="_blank"><i class="bx bxl-facebook-square mr-1"></i></a>
            <a class="link-footer" href="https://www.instagram.com/" target="_blank"><i class="bx bxl-instagram mr-1"></i></a>
            <a class="link-footer" href="https://twitter.com/" target="_blank"><i class="bx bxl-twitter mr-1"></i></a>
            <a class="link-footer" href="https://wa.me/526182001024?text=Hola%20SofTech%necesito%20ayuda." target="_blank"><i class="bx bxl-whatsapp"></i></a>
          </p>
        </div>
        <div class="col-lg-3 col-xs-12 links">
          <h4 class="mt-lg-0 mt-sm-3">Enlaces</h4>
          <div class="line mb-4"></div>
          <ul class="m-0 p-0 footerlinks">
            <li class="mb-2"><a href="menu/seccion?sec=Videojuegos">Sección Videojuegos</a></li>
            <li class="mb-2"><a href="menu/seccion?sec=Software">Sección Software</a></li>
            <li class="mb-2"><a href="menu/seccion?sec=Windows">Sección Windows</a></li>
            <li class="mb-2"><a href="menu/seccion?sec=Mac">Sección Mac</a></li>
            <li class="mb-2"><a href="menu/seccion?sec=Linux">Sección Linux</a></li>
            <li class="mb-2"><a href="menu/seccion?sec=Android">Sección Android</a></li>
            <li class="mb-2"><a href="menu/seccion?sec=iOS">Sección iOS</a></li>
            <li class="mb-2"><a href="menu/privacidad">Política de privacidad</a></li>
            <li class="mb-2"><a href="menu/terminos">Términos y condiciones</a></li>
            <li class="mb-2"><a href="menu/sitemap">Mapa del sitio</a></li>
            <!-- <li class="mb-2"><a href="menu/manual">Manual de usuario</a></li> -->
            <?php if(isset($_SESSION['usuarioblog'])){ ?>
              <li class="mb-2"><a href="perfil" target="_blank" >Perfil</a></li>
              <p></p>
            <?php }else if(isset($_SESSION['admin'])){ ?>
              <li class="mb-2"><a href="perfil" target="_blank" >Perfil</a></li>
              <li class="mb-2"><a href="menu/posts" target="_blank" >Ver posts</a></li>
              <li class="mb-2"><a href="menu/autores" target="_blank" >Ver autores</a></li>
              <li class="mb-2"><a href="menu/newsletter" target="_blank" >Newsletter</a></li>
              <li class="mb-2"><a href="menu/imgs">Imagenes del carrusel</a></li>
            <?php }else if(isset($_SESSION['admin-publicaciones'])){ ?>
              <li class="mb-2"><a href="perfil" target="_blank" >Perfil</a></li>                    
              <li class="mb-2"><a href="menu/posts" target="_blank" >Ver posts</a></li>                    
              <li class="mb-2"><a href="menu/autores" target="_blank" >Ver autores</a></li>                    
            <?php }else{ ?>
              <li class="mb-2"><a href="login" target="_blank" >Regístrate</a></li>
              <li class="mb-2"><a href="login" target="_blank" >Inicia sesión</a></li>
            <?php } ?>
          </ul>
        </div>
        <div class="col-lg-4 col-xs-12 location">
          <h4 class="mt-lg-0 mt-sm-4">Oficinas</h4>
          <div class="line mb-4"></div>
          <ul class="m-0 p-0 footerlinks">
            <li class="mb-3"> <a class="link-footer" href="https://www.google.com/maps/place/Universidad+Tecnol%C3%B3gica+de+Durango/@23.9901183,-104.6197695,17z/data=!3m1!4b1!4m5!3m4!1s0x869bb833da45df2b:0x2392fefbf317535!8m2!3d23.9901183!4d-104.6175808" target="_blank"><i class="bx bx-map me-2"></i>
                Carr. Durango – Mezquital, Km. 4.5 Gabino Santillán. C.P. 34308, Durango, Dgo.</a>
            </li>
            <li class="mb-3"><a class="link-footer" href="tel:6181483067"><i class="bx bx-phone me-2"></i>(618)
                148-3067</a>
            </li>
            <li class="mb-3"><a class="link-footer" href="mailto:mensajesoftech@gmail.com"><i class="bx bx-envelope me-2"></i>mensajesoftech@gmail.com</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col copyright d-flex">
          <p class=""><small class="text-white-50">© SofTech 2022. Todos los derechos reservados.</small></p>
        </div>
      </div>
    </div>
  </div>


  <a href="#" class="scrollto back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-chevron-up"></i></a>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="assets/js/main.js"></script>
  <script src="assets/js/contactanos.js"></script>
  <script src="assets/js/darkmode.js"></script>
  <script>
    $(window).on('load',function(){
      $('.preloader').fadeOut();
    });
    gsap.from('.animacion', {
        duration: 1.2,
        y: -200,
        scale: 0,
        stagger: 0.5,
    })
  </script>
</body>

</html>