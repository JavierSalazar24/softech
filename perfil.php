<?php
    session_start();
    require("assets/php/conn.php");
    if(isset($_SESSION['admin'])||isset($_SESSION['admin-publicaciones'])||isset($_SESSION['usuarioblog'])){
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="./assets/img/favicon.png" rel="icon">
    <link href="./assets/img/favicon.png" rel="apple-touch-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;800&display=swap" rel="stylesheet">
    <link href="./assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="./assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="./assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="./assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="./assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">
    <link href="./assets/css/darkmode.css" rel="stylesheet">
    <title>Perfil | SofTech Blog</title>
</head>
<body class="dark perfil">
  
    <?php require_once("./partials/header.php"); ?>

    <div class="row d-flex align-items-center" style="width: 100%;">
      <div class="containerimg  d-flex align-items-center" style="background-image: url(assets/img/sections/busqueda.png);">
        <p class="txtcenter">Perfil</p>
      </div>
    </div>

    <section class="breadcrumbs mt-5">
      <div class="container">

        <div class="d-flex justify-content-between ">
          <div class="section-title">
            <h2><?php if(isset($_SESSION['admin'])||isset($_SESSION['admin-publicaciones'])){ echo "Editar autor"; }elseif(isset($_SESSION['usuarioblog'])){ echo "Editar usuario"; } ?></h2>
          </div>
          <ol>
          <li><a href="./">Página principal</a></li>
            <li>Perfil</li>
          </ol>
        </div>

      </div>
    </section>

    <form id="<?php if(isset($_SESSION['usuarioblog'])) { echo "perfilForm_user"; } elseif(isset($_SESSION['admin'])) { echo "perfilForm_admin"; }elseif(isset($_SESSION['admin-publicaciones'])){ echo "perfilForm_admin-publi"; } ?>" method="post">
        <div class="contenedor_perfil">
            <section class="contenedor_perfil__seccion">
                <div class="contenedor_perfil__img">
                    <div class="contenedor_perfil__img_imagen">
                        <img  src="<?php if (isset($_SESSION['usuarioblog'])){ if(empty($foto)){ echo './assets/img/unknown.png'; }else{ echo './assets/img/users/'.$foto; } }elseif(isset($_SESSION['usuarioSocial'])){ echo $_SESSION['usuarioSocial']['picture']; }else if(isset($_SESSION['admin'])||isset($_SESSION['admin-publicaciones'])){ if(empty($foto)){ if ($genero == 'F') { echo './assets/img/authors/unknownM.png'; } else { echo './assets/img/authors/unknown.png'; } }else{ echo './assets/img/authors/'.$foto; } } ?>" width="340" height="340" alt="Imagen del usuario <?php if (isset($_SESSION['usuarioblog'])||isset($_SESSION['admin'])||isset($_SESSION['admin-publicaciones'])){ echo $nombres.' '.$apellidos; }elseif(isset($_SESSION['usuarioSocial'])){ echo $_SESSION['usuarioSocial']['first_name'].' '.$_SESSION['usuarioSocial']['last_name']; } ?>" id="imagen_sub" alt="Imagen del usuario <?php echo $_SESSION['usuarioSocial']['first_name'].' '.$_SESSION['usuarioSocial']['last_name']; ?>">
                        <br>
                        <input type="file" accept="image/*" name="imagen" id="input_imagen" required disabled>
                    </div>
                </div>
                <div class="contenedor_perfil__info">
                    <div class="contenedor_perfil__info_form">
                        <div class="contenedor_perfil__info_form-titulo">
                            <h2 class="perfil_nombre"><span id="nombrePerfil"><?php echo $nombres ?></span> <span id="apellidoPerfil"><?php echo $apellidos ?></span></h2>
                            <p class="perfil_usuario"> <?php if(isset($_SESSION['usuarioblog'])){ echo 'Usuario'; }else if(isset($_SESSION['admin']) || isset($_SESSION['admin-publicaciones'])){ echo 'Admin'; } ?></p>
                            <hr class="divider">
                        </div>
                        <div class="contenedor_perfil__info_form-informacion">
                            <h6 class="perfil_informacion">Información</h6>
                            <div class="text-divider"></div>
                            <div class="perfilForm">
                                <div class="perfil_form">
                                    <?php
                                        if (isset($_SESSION['admin'])||isset($_SESSION['admin-publicaciones'])) {
                                            $consulta_author = mysqli_query($conn, "SELECT * FROM authors WHERE email = '$correo'");
                                            $validacion_author = mysqli_num_rows($consulta_author);

                                            if($validacion_author > 0){
                                                while ($info_author = mysqli_fetch_array($consulta_author)) {
                                                    $nombre_perfil = $info_author['name'];
                                                    $apellido_perfil = $info_author['last_name'];
                                                    $genero_perfil = $info_author['gender'];
                                                    $frase_perfil = $info_author['phrase'];
                                                    $face_perfil = $info_author['user_facebook'];
                                                    $insta_perfil = $info_author['user_instagram'];
                                                    $twitter_perfil = $info_author['user_twitter'];
                                                    $whats_perfil = $info_author['tel_whatsapp'];
                                                    $privilegio_perfil = $info_author['privilege'];
                                                }
                                            }                                                                                
                                    ?>
                                    <div class="perfil_form__seccion_admins">
                                        <div class="perfil_form__form-group">
                                            <label for="input_nombre" class="form-label">Nombre</label>
                                            <input class="form-control_perfil" type="text" title="Completa este campo / Solo letras" minlength="3" pattern="[a-zA-Zá-úÁ-Ú ]+" name="nombre" id="input_nombre" value="<?php echo $nombre_perfil ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="perfil_form__seccion_admins">
                                        <div class="perfil_form__form-group">                 
                                            <label for="input_apellido" class="form-label">Apellido</label>
                                            <input class="form-control_perfil" type="text" title="Completa este campo / Solo letras" minlength="3" pattern="[a-zA-Zá-úÁ-Ú ]+" name="apellido" id="input_apellido" value="<?php echo $apellido_perfil ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="perfil_form__seccion_admins">
                                        <div class="perfil_form__form-group">
                                            <label for="input_genero" class="form-label">Genero</label>
                                            <select name="genero" class="control_perfil form-select" title="Completa este campo" id="input_genero" required disabled>
                                                <option value="F" <?php if($genero_perfil == 'F'){ echo "selected"; } ?>>Femenino</option>
                                                <option value="M" <?php if($genero_perfil == 'M'){ echo "selected"; } ?>>Masculino</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="perfil_form__seccion_admins">
                                        <div class="perfil_form__form-group">
                                            <label for="input_facebook" class="form-label">Facebook</label>
                                            <input class="form-control_perfil" type="text" title="Completa este campo" name="face" id="input_facebook" value="<?php echo $face_perfil ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="perfil_form__seccion_admins">
                                        <div class="perfil_form__form-group">
                                            <label for="input_instagram" class="form-label">Instagram</label>
                                            <input class="form-control_perfil" type="text" title="Completa este campo" name="insta" id="input_instagram" value="<?php echo $insta_perfil ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="perfil_form__seccion_admins">
                                        <div class="perfil_form__form-group">
                                            <label for="input_twitter" class="form-label">Twitter</label>
                                            <input class="form-control_perfil" type="text" title="Completa este campo" name="twitter" id="input_twitter" value="<?php echo $twitter_perfil ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="perfil_form__seccion_admins">
                                        <div class="perfil_form__form-group">
                                            <label for="input_whatsapp" class="form-label">Whatsapp</label>
                                            <input class="form-control_perfil" type="tel" minlenght="10" maxlength="10" title="Completa este campo / Solo números" name="whats" id="input_whatsapp" value="<?php echo $whats_perfil ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="perfil_form__seccion_admins">
                                        <div class="perfil_form__form-group">
                                            <label for="input_frase" class="form-label">Frase</label>
                                            <textarea class="form-control_perfil" name="frase" id="input_frase" cols="30" rows="10" style="min-height: 50px !important;" title="Completa este campo" required disabled><?php echo $frase_perfil ?></textarea>
                                        </div>
                                    </div>
                                    <?php if(isset($_SESSION['admin'])){ ?>
                                        <div class="perfil_form__seccion_admins">
                                            <div class="perfil_form__form-group">
                                                <label for="input_privilegio" class="form-label">Privilegio</label>
                                                <select name="privilegio" title="Completa este campo" class="control_perfil form-select" title="Completa este campo" id="input_privilegio" required disabled>
                                                    <option value="admin" <?php if($privilegio_perfil == 'admin'){ echo "selected"; } ?>>Admin</option>
                                                    <option value="admin-publicaciones" <?php if($privilegio_perfil == 'admin-publicaciones'){ echo "selected"; } ?>>Admin-publicaciones</option>
                                                </select>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="perfil_form__seccion_admins">
                                        <div class="perfil_form__form-group">
                                            <label for="input_correo" class="form-label">Correo</label>
                                            <input class="form-control_perfil" type="email" title="Completa este campo" name="correo" id="input_correo" value="<?php echo $correo ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="<?php if(isset($_SESSION['admin'])){ echo "perfil_form__seccion_admins"; }else{ echo "perfil_form__seccion_admins-publi"; } ?>">
                                        <div class="perfil_form__form-group">
                                            <button class="form-control_perfil-submit" id="btnPerfil_admin">Editar perfil</button>
                                        </div>
                                    </div>
                                <?php } else if(isset($_SESSION['usuarioblog'])||isset($_SESSION['usuarioSocial'])) {

                                    $consulta_user = mysqli_query($conn, "SELECT * FROM users WHERE email = '$correo'");
                                    $validacion_user = mysqli_num_rows($consulta_user);

                                    if($validacion_user > 0){
                                        while ($info_user = mysqli_fetch_array($consulta_user)) {
                                            $nombre_perfil = $info_user['name'];
                                            $apellido_perfil = $info_user['last_name'];
                                        }
                                    }
                                    
                                ?>
                                    <div class="perfil_form__seccion">
                                        <div class="perfil_form__form-group">
                                            <label for="input_nombre" class="form-label">Nombre</label>
                                            <input class="form-control_perfil" type="text" title="Completa este campo / Solo letras" minlength="3" pattern="[a-zA-Zá-úÁ-Ú ]+" name="nombre" id="input_nombre" value="<?php echo $nombre_perfil ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="perfil_form__seccion">
                                        <div class="perfil_form__form-group">                 
                                            <label for="input_apellido" class="form-label">Apellido</label>
                                            <input class="form-control_perfil" type="text" title="Completa este campo / Solo letras" minlength="3" pattern="[a-zA-Zá-úÁ-Ú ]+" name="apellido" id="input_apellido" value="<?php echo $apellido_perfil ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="perfil_form__seccion">
                                        <div class="perfil_form__form-group">
                                            <label for="input_correo" class="form-label">Correo</label>
                                            <input class="form-control_perfil" type="email" title="Completa este campo" name="correo" id="input_correo" value="<?php echo $correo ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="perfil_form__seccion">
                                        <div class="perfil_form__form-group">
                                        <?php if (isset($_SESSION['usuarioblog'])){?>
                                            <button class="form-control_perfil-submit" id="btnPerfil">Editar perfil</button>
                                        <?php }else if (isset($_SESSION['usuarioSocial']['red']) && $_SESSION['usuarioSocial']['red'] == 'facebook'){ ?>
                                            <button class="form-control_perfil-submit" id="btnPerfilFace">Editar perfil</button>
                                        <?php }else if (isset($_SESSION['usuarioSocial']['red']) && $_SESSION['usuarioSocial']['red'] == 'google'){ ?> 
                                            <button class="form-control_perfil-submit" id="btnPerfilGoogle">Editar perfil</button>
                                        <?php } ?>
                                        </div>
                                    </div>

                                <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </form>
    <?php require_once("./partials/footer.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="./assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="./assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="./assets/vendor/php-email-form/validate.js"></script>

    <script src="./assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="./assets/js/perfil.js"></script>
    <script src="./assets/js/darkmode.js"></script>
</body>
</html>

<?php
    }else{
        header("Location: ./");
    }
?>