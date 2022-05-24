<?php

    session_start();
    include("assets/php/keys.php");
    include("assets/php/conn.php");
    if(isset($_SESSION['admin'])||isset($_SESSION['admin-publicaciones'])||isset($_SESSION['usuarioblog'])){
        header("Location: ./");
    }else{
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="./assets/img/favicon.png" type="image/x-icon">
    
    <meta name="google-signin-scope" content="profile email">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet preload">

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="./assets/css/estilos_login.css">

    <title> Login | SofTech </title>
    <meta name="description" content="En SofThech&#128187; puedes iniciar sesión o registrarse, para poder ver todo el contenido del blog📱.">
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo SITE_KEY ?>"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("demo-form").submit();
        }           
    </script>
</head>

<body>
    <div class="contenedor-login">
        <!-- Slider -->
        <div class="contenedor-slider">
            <div class="slider">
                <?php 
                    $consulta_imgs = mysqli_query($conn, "SELECT * FROM imgs ");
                    $validacion_imgs = mysqli_num_rows($consulta_imgs);

                    if ($validacion_imgs > 0) {
                        foreach($consulta_imgs as $imgs){

                ?>
                    <div class="slide fade ">
                        <img src="./assets/img/login/<?php echo $imgs['name'] ?>" alt="Imagen <?php echo $imgs['id'] ?> del carrousel">
                        <div class="contenido-slider">
                            <div class="logo">
                                <a rel="nofollow" href="./" title="Ir al inicio">
                                    <img src="./assets/img/logo.png" alt="Logo de softech">
                                </a>
                            </div>
                        </div>
                    </div>  
                <?php } } else { ?>
                    <div class="slide fade ">
                        <img src="./assets/img/login/img_login1.png" alt="Imagen 1 del carrousel">
                        <div class="contenido-slider">
                            <div class="logo">
                                <a rel="nofollow" href="./" title="Ir al inicio">
                                    <img src="./assets/img/logo.png" alt="Logo de softech">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="slide fade ">
                        <img src="./assets/img/login/img_login2.jpg" alt="Imagen 2 del carrousel">
                        <div class="contenido-slider">
                            <div class="logo">
                                <a rel="nofollow" href="./" title="Ir al inicio">
                                    <img src="./assets/img/logo.png" alt="Logo de softech">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="slide fade ">
                        <img src="./assets/img/login/img_login3.png" alt="Imagen 3 del carrousel">
                        <div class="contenido-slider">
                            <div class="logo">
                                <a rel="nofollow" href="./" title="Ir al inicio">
                                    <img src="./assets/img/logo.png" alt="Logo de softech">
                                </a>
                            </div>
                        </div>
                    </div>
            <?php } ?>              
            </div>
            <a href="#" class="prev pagSlider" title="Anterior"><i class="fas fa-chevron-left"></i></a>
            <a href="#" class="next pagSlider" title="Siguiente"><i class="fas fa-chevron-right"></i></a>
            <div class="dots"></div>
        </div>

       <!-- Formularios -->
        <div class="contenedor-texto">
            <div class="contenedor-form">
                <h1 class="titulo">¡Bienvenido(a) a SofTech!</h1>
                <div id="maquina">
                    <p>Ingresa a tu cuenta para tener acceso ilimitado y exclusivo de nuestro contenido.</p>
                </div>
                <span class="descripcion"></span>

                <ul class="tabs-links">
                    <li class="tab-link active">Iniciar Sesión</li>
                    <li class="tab-link ">Regístrate</li>
                </ul>

                <!-- Formulario login -->                
                <form id="formLogin" class="formulario active" autocomplete="off">
                    <input type="email" placeholder="Correo electrónico" autocapitalize="off" autocapitalize="off" title="Completa este campo / example@gmail.com" class="input-text" name="correo" required>
                    <div class="grupo-input">
                        <input type="password" autocapitalize="off" minlength="8" title="Completa este campo / Mínimo 8 carácteres" placeholder="Contraseña" name="password" class="input-text clave" required>
                        <button type="button" class="icono fas fa-eye mostrarClave" title="Mostrar contraseña"></button>
                    </div>

                    <a href="./recuperar" class="link">¿Olvidaste tu contraseña?</a>
                    <button class="btn" id="btnLogin" type="submit">Iniciar Sesión</button>
                    <a href="./" class="btn2">Volver al inicio</a>

                    <div class="redes_sociales">
                        <div class="icono_redSocial div_facebook" id="face" title="Iniciar sesión con Facebook">
                            <button class="buttonIcono" type="button"><i class="fab fa-facebook-f"></i></button>
                        </div>
                        <div class="icono_redSocial div_google" id="google" title="Iniciar sesión con Google">
                            <button class="buttonIcono" type="button"><i class="fab fa-google"></i></button>
                        </div>
                    </div>
                </form>

               <!-- Formulario registrarse -->
                <form id="formRegistro" class="formulario" autocomplete="off">
                    <input type="text" title="Completa este campo / Solo letras" minlength="3" pattern="[a-zA-Zá-úÁ-Ú ]+" placeholder="Nombre(s)" class="input-text" name="nombres" required>
                    <input type="text" title="Completa este campo / Solo letras" minlength="3" pattern="[a-zA-Zá-úÁ-Ú ]+" placeholder="Apellido(s)" class="input-text" name="apellidos" required>
                    <input type="email" title="Completa este campo / example@gmail.com" placeholder="Correo electrónico" class="input-text" name="correo" autocomplete="off" required>

                    <div class="grupo-input">                        
                        <div id="password_input">
                            <input type="password" autocapitalize="off" minlength="8" title="Completa este campo / Mínimo 8 carácteres" placeholder="Contraseña" name="password" class="input-text clave" required>
                            <button type="button" class="icono2 fas fa-eye mostrarClave" title="Mostrar contraseña"></button>
                        </div>
                    </div>

                    <label class="contenedor-cbx animate">
                        Acepto los terminos de <a href="./menu/privacidad" rel="nofollow" target="_blank">privacidad</a>.
                        <input type="checkbox" id="terminos" checked>
                        <span class="cbx-marca"></span>
                    </label>

                    <button class="btn" id="btnRegistro" type="submit">Crear Cuenta</button>
                    <a href="./" class="btn2">Volver al inicio</a>
                </form>
                
            </div>
        </div>
        <button class="g-recaptcha" data-sitekey="reCAPTCHA_site_key" data-callback='onSubmit' data-action='submit' title="Validación humana"></button>
    </div>

    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>    
    <!-- Efecto maquina de escribir -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
    <script type="text/javascript" src="./assets/js/password_strength.js"></script>
    <script src="./assets/js/login.js"></script>
    <script src="./assets/js/maquina.js"></script>    
    <!-- redes sociales -->
    <script src="./assets/js/facebook.js"></script>
    <script src="./assets/js/google.js"></script>
</body>

</html>


<?php
    }
?>