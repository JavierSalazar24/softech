<div class="pt-5 pb-5 footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-xs-12 about-company">
          <img class="logofooter mb-3" src="assets/img/logo.png" alt="">
          <p class="pr-5 text-white-50">Tu blog de tecnología, donde quiera que estés. Síguenos en redes sociales:</p>
          <p>
            <a class="link-footer" href="https://www.facebook.com/" target="_blank"><i class="bx bxl-facebook-square mr-1"></i></a>
            <a class="link-footer" href="https://www.instagram.com/" target="_blank"><i class="bx bxl-instagram mr-1"></i></a>
            <a class="link-footer" href="https://www.twitter.com/" target="_blank"><i class="bx bxl-twitter mr-1"></i></a>
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
            <li class="mb-3"> <a class="link-footer"
                href="https://www.google.com/maps/place/Universidad+Tecnol%C3%B3gica+de+Durango/@23.9901183,-104.6197695,17z/data=!3m1!4b1!4m5!3m4!1s0x869bb833da45df2b:0x2392fefbf317535!8m2!3d23.9901183!4d-104.6175808"
                target="_blank"><i class="bx bx-map me-2"></i>
                Carr. Durango – Mezquital, Km. 4.5 Gabino Santillán. C.P. 34308, Durango, Dgo.</a>
            </li>
            <li class="mb-3"><a class="link-footer" href="tel:6181483067"><i class="bx bx-phone me-2"></i>(618)
                148-3067</a>
            </li>
            <li class="mb-3"><a class="link-footer" href="mailto:mensajessoftech@gmail.com"><i
                  class="bx bx-envelope me-2"></i>mensajesoftech@gmail.com</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col copyright">
          <p class=""><small class="text-white-50">© SofTech 2022. Todos los derechos reservados.</small></p>
        </div>
      </div>
    </div>
</div>