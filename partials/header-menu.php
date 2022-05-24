<!-- ======= Barra superior ======= -->
<section id="topbar" class="d-flex align-items-center">
  <div class="container d-flex justify-content-center justify-content-md-between">
    <div class="contact-info d-flex align-items-center">
      <i class="bi bi-envelope-fill"></i><a href="#newsletter">¡Suscríbete a nuestro boletín de noticias!</a>
    </div>
    <div class="social-links d-none d-md-block">
      <a href="https://www.facebook.com/" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
      <a href="https://www.instagram.com/" target="_blank" class="instagram"><i class="bi bi-instagram"></i></a>
      <a href="https://www.twitter.com/" target="_blank" class="twitter"><i class="bi bi-twitter"></i></a>
      <a href="https://wa.me/526182001024?text=Hola%20SofTech%necesito%20ayuda." target="_blank" class="twitter"><i class="bi bi-whatsapp"></i></a>
    </div>
  </div>
</section>

<!-- ======= Encabezado ======= -->
<header id="header" class="d-flex align-items-center">
  <div class="container d-flex align-items-center">
    <a href="../" class="logo me-auto"><img src="../assets/img/logo.png" alt="Logo de la empresa" id="img_logo_menu" class="img-fluid"></a>

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto " href="seccion?sec=videojuegos">Videojuegos</a></li>
        <li><a class="nav-link scrollto" href="seccion?sec=software">Software</a></li>
        <li class="dropdown"><a href="#" class="scrollto"><span>Computadoras</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="seccion?sec=windows">Windows</a></li>
            <li><a href="seccion?sec=mac">Mac</a></li>
            <li><a href="seccion?sec=linux">Linux</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="scrollto"><span>Celulares</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="seccion?sec=android">Android</a></li>
            <li><a href="seccion?sec=iOS">iOS</a></li>
          </ul>
        </li>
        <li><a class="nav-link scrollto" href="../#contact">Contáctanos</a></li>
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
            <li class="dropdown user"><a href="#" class="scrollto"><span><?php echo $nombres.' '.$apellidos ?></span> <i class="bi bi-chevron-down"></i></a>
              <ul>
                <li><a href="autores">Autores</a></li>
                <li><a href="posts">Ver post</a></li>
                <li><a href="../perfil">Perfil</a></li>
                <?php if(isset($_SESSION['admin'])){ ?>
                  <li><a href="newsletter">Newsletter</a></li>
                  <li><a href="imgs">Imagenes del carrusel</a></li>
                <?php } ?>
                <li><a href="../assets/php/cerrar_sesion">Cerrar sesión</a></li>
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
                <li><a href="../perfil">Perfil</a></li>
                <li><a href="../assets/php/cerrar_sesion">Cerrar sesión</a></li>
              </ul>
            </li>
          <?php }else{ ?>
            <li class="me-4"><a class="getstarted scrollto login" href="../login">Inicia sesión</a></li>
          <?php } ?>
        <li>
          <form class="form-inline my-2 my-lg-0 d-flex" action="../busqueda" method="post">
            <input id="search-bar" class="form-control mr-sm-2" type="search" placeholder="Búsqueda" aria-label="Search"
              name="q" required minlength="3">
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