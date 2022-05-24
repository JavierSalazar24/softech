<?php
    
    session_start();
    require("../assets/php/conn.php");
    require("../assets/php/functions.php");

    if(isset($_SESSION['admin']) || isset($_SESSION['admin-publicaciones'])){

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores | SofTech</title>

    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/favicon.png" rel="apple-touch-icon">
    
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
</head>
<body class="dark">

    <?php require_once("../partials/header-menu.php"); ?>

    <main id="main">
        <div class="row d-flex align-items-center" style="width: 100%;">
            <div class="containerimg  d-flex align-items-center" style="background-image: url(../assets/img/sections/busqueda.png);">
                <p class="txtcenter">Autores</p>
            </div>
        </div>

        <section class="breadcrumbs mt-5">
            <div class="container">

                <div class="d-flex justify-content-between ">
                    <div class="section-title">
                        <h2>NUESTRO EQUIPO</h2>
                        <?php if(isset($_SESSION['admin'])){ ?>
                            <a class="btn btn-primary mt-2 me-3" data-toggle="modal" data-target="#VentanaModalA" style="color: #fff">Agregar autor</a>
                        <?php } ?>
                    </div>
                    <ol>
                        <li><a href=".././">Página principal</a></li>
                        <li>Autores</li>
                    </ol>
                </div>

            </div>
        </section>

        <section class="inner-page pt-3">
            <div class="container pt-3">
                <div class="row mt-3">
                    <div class="col-md-12 team" id="team">
                        <div class="container">
                            <div class="row justify-content-center">
                                <?php 
                                    $consulta_authors = mysqli_query($conn, "SELECT * FROM authors");
                                    $validacion_authors = mysqli_num_rows($consulta_authors);

                                    if ($validacion_authors > 0) {

                                    foreach($consulta_authors as $info_authors){

                                ?>
                                    <div class="col-lg-4 col-md-6 col-sm-10 col-xs-12 d-flex align-items-start">
                                        <div class="member">
                                            <img id="img_<?php echo $info_authors['id'] ?>" src="../assets/img/authors/<?php if(empty($info_authors['picture'])){ if ($info_authors['gender']=="F") { echo "unknownM.png"; }else{ echo "unknown.png"; } }else{ echo $info_authors['picture']; } ?>" width="160px" height="160px" alt="<?php echo $info_authors['name'].' '.$info_authors['last_name'] ?>">
                                            <h4><?php echo $info_authors['name'].' '.$info_authors['last_name'] ?></h4>
                                            <span><?php if($info_authors['gender'] == 'F'){ echo 'Editora'; }else{ echo 'Editor'; } ?></span>
                                            <p>"<?php echo $info_authors['phrase'] ?>"</p>
                                            <div class="social pb-3">
                                                <?php if(!empty($info_authors['user_facebook'])){ ?>
                                                    <a <?php echo $info_authors['id'] ?>" href="https://www.facebook.com/<?php echo $info_authors['user_facebook'] ?>/" target="_blank"><i class="bi bi-facebook"></i></a>
                                                <?php } if(!empty($info_authors['user_instagram'])){ ?>
                                                    <a <?php echo $info_authors['id'] ?>" href="https://www.instagram.com/<?php echo $info_authors['user_instagram'] ?>/" target="_blank"><i class="bi bi-instagram"></i></a>
                                                <?php } if(!empty($info_authors['user_twitter'])){ ?>
                                                    <a <?php echo $info_authors['id'] ?>" href="https://twitter.com/<?php echo $info_authors['user_twitter'] ?>/" target="_blank"><i class="bi bi-twitter"></i></a>
                                                <?php } if(!empty($info_authors['tel_whatsapp'])){ ?>
                                                    <a <?php echo $info_authors['id'] ?>" href="https://wa.me/52<?php echo $info_authors['tel_whatsapp'] ?>?text=¡Hola%20<?php echo $info_authors['name']?>!%20Me%20interesa%20saber%20más%20de%20SofTech." target="_blank"><i class="bi bi-whatsapp"></i></a>
                                                <?php } ?>
                                            </div>
                                            <?php if(isset($_SESSION['admin'])){ ?>
                                                <input type="hidden" value="<?php echo $info_authors["name"]; ?>" id="nombre_<?php echo $info_authors['id'] ?>">
                                                <input type="hidden" value="<?php echo $info_authors["last_name"]; ?>" id="apellido_<?php echo $info_authors['id'] ?>">
                                                <input type="hidden" value="<?php echo $info_authors["gender"]; ?>" id="genero_<?php echo $info_authors['id'] ?>">
                                                <input type="hidden" value="<?php echo $info_authors["user_facebook"]; ?>" id="face_<?php echo $info_authors['id'] ?>">
                                                <input type="hidden" value="<?php echo $info_authors["user_instagram"]; ?>" id="insta_<?php echo $info_authors['id'] ?>">
                                                <input type="hidden" value="<?php echo $info_authors["user_twitter"]; ?>" id="twitter_<?php echo $info_authors['id'] ?>">
                                                <input type="hidden" value="<?php echo $info_authors["tel_whatsapp"]; ?>" id="whats_<?php echo $info_authors['id'] ?>">
                                                <input type="hidden" value="<?php echo $info_authors["email"]; ?>" id="email_<?php echo $info_authors['id'] ?>">
                                                <input type="hidden" value="<?php echo $info_authors["privilege"]; ?>" id="privilegio_<?php echo $info_authors['id'] ?>">
                                                <input type="hidden" value="<?php echo $info_authors["phrase"]; ?>" id="frase_<?php echo $info_authors['id'] ?>">
                                                <div class="mt-3 d-flex justify-content-around">
                                                    <a class="mt-3 btn btn-success" onclick="editar('<?php echo $info_authors['id'] ?>')" data-toggle="modal" data-target="#VentanaModalE" id="btn_editarPost" style="font-size: 20px;"><i class='bx bxs-edit'></i></a>
                                                    <a class="mt-3 btn btn-danger" onclick="eliminar('<?php echo $info_authors['id'] ?>')" style="font-size: 20px;"><i class='bx bxs-trash'></i></a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php 
                                    } }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php require_once("../partials/footer-menu.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Modal Agregar -->
    <form id="agregar_autor" class="needs-validation" novalidate>
        <div class="modal fade" id="VentanaModalA" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar autor</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 text-center">
                            <label for="img_agregar" class="form-label">Imagen</label>
                            <div id="img_editar_autor">
                                <img src="../assets/img/logo.png" id="imgPrev_agregar"  style="max-width: 60% !important;"/>
                            </div>
                        </div>
                        <div class="mb-4 text-center">
                            <input accept="image/*" type="file" id="img_agregar" title="Agrega una imagen" name="img" required>
                        </div>
                        <div class="mb-3">
                            <label for="nombre_agregar" class="form-label">Nombre</label>
                            <input class="form-control" pattern="[a-zA-Zá-úÁ-Ú ]+" title="Completa este campo / Solo letras" minlength="3" pattern="[a-zA-Zá-úÁ-Ú ]+" placeholder="Nombre del autor" type="text" name="nombre" required id="nombre_agregar">
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor ingresa un nombre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="apellido_agregar" class="form-label">Apellido</label>
                            <input class="form-control" pattern="[a-zA-Zá-úÁ-Ú ]+" title="Completa este campo / Solo letras" minlength="3" pattern="[a-zA-Zá-úÁ-Ú ]+" placeholder="Apellido del autor" type="text" name="apellido" required id="apellido_agregar">
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor ingresa un apellido.</div>
                        </div>
                        <div class="mb-3">
                            <label for="genero_agregar" class="form-label">Genero</label>
                            <select name="genero" required id="genero_agregar" class="form-select">
                                <option value="">Seleccionar genero</option>
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona un genero.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="user_facebook_agregar" class="form-label">Usuario de Facebook</label>
                            <input class="form-control" type="text" title="Completa este campo" placeholder="Usuario de Facebook" name="user_facebook" required id="user_facebook_agregar">
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona un usuario de Facebook.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="user_instagram_agregar" class="form-label">Usuario de Instagram</label>
                            <input class="form-control" type="text" name="user_instagram" title="Completa este campo" placeholder="Usuario de Instagram" required id="user_instagram_agregar">
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona un usuario de Instagram.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="user_twitter_agregar" class="form-label">Usuario de Twitter</label>
                            <input class="form-control" type="text" name="user_twitter" title="Completa este campo" placeholder="Usuario de Twitter" required id="user_twitter_agregar">
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona un usuario de Twitter.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="tel_whatsapp_agregar" class="form-label">Número de Whatsapp</label>
                            <input class="form-control" pattern="[0-9]+" type="tel" minlength="10" maxlength="10" title="Completa este campo" placeholder="Número de Whatsapp" name="tel_whatsapp" required id="tel_whatsapp_agregar">
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona un número de Whatsapp.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="email_agregar" class="form-label">Email</label>
                            <input type="email" title="Completa este campo / example@gmail.com" placeholder="Correo electrónico" class="form-control" name="email" id="email_agregar" required>
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona un email.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="password_agregar" class="form-label">Contraseña</label>
                            <input type="password" autocapitalize="off" minlength="8" title="Completa este campo / Mínimo 8 carácteres" placeholder="Contraseña" name="password" class="form-control" required id="password_agregar">
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona una contraseña.</div>
                        </div>
                        <div class="mb-3">
                            <label for="privilegio_agregar" class="form-label">Privilegio</label>
                            <select name="privilegio" required id="privilegio_agregar" class="form-select">
                                <option value="">Seleccionar privilegio</option>
                                <option value="admin">Admin</option>
                                <option value="admin-publicaciones">Admin publicaciones</option>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona un privilegio.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="frase_agregar" class="form-label">Escribe una frase</label>
                            <textarea class="form-control" style="height: 100px" title="Completa este campo" placeholder="Frase" name="frase" id="frase_agregar" required></textarea>
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor escribe una frase.</div>
                        </div>                                                
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="agregar_submit" class="btn btn-primary">Agregar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal Editar -->
    <form id="editar_autor" class="needs-validation" novalidate>
        <div class="modal fade" id="VentanaModalE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Editar autor</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 text-center">
                            <label for="img_editar" class="form-label">Imagen</label>
                            <div>
                                <img src="../assets/img/logo.png" id="imgPrev_editar" class="img_editar_autor" style="max-width: 60% !important; border-radius: 50% !important;"/>
                            </div>
                        </div>
                        <div class="mb-4 text-center">
                            <input type="file" accept="image/*" id="img_editar" title="Agrega una imagen" name="img" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" title="Solo números" pattern="[0-9]+" type="hidden" name="id_autor" required id="id_editar" readonly>
                            <label for="nombre_editar" class="form-label">Nombre</label>
                            <input class="form-control" pattern="[a-zA-Zá-úÁ-Ú ]+" title="Completa este campo / Solo letras" minlength="3" pattern="[a-zA-Zá-úÁ-Ú ]+" placeholder="Nombre del autor" type="text" name="nombre" required id="nombre_editar">
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor ingresa un nombre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="apellido_editar" class="form-label">Apellido</label>
                            <input class="form-control" pattern="[a-zA-Zá-úÁ-Ú ]+" title="Completa este campo / Solo letras" minlength="3" pattern="[a-zA-Zá-úÁ-Ú ]+" placeholder="Apellido del autor" type="text" name="apellido" required id="apellido_editar">
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor ingresa un apellido.</div>
                        </div>
                        <div class="mb-3">
                            <label for="genero_editar" class="form-label">Genero</label>
                            <select name="genero" required id="genero_editar" class="form-select">
                                <option value="F">Femenino</option>
                                <option value="M">Masculino</option>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona un genero.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="user_facebook_editar" class="form-label">Usuario de Facebook</label>
                            <input class="form-control" type="text" title="Completa este campo" placeholder="Usuario de Facebook" name="user_facebook" required id="user_facebook_editar">
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona un usuario de Facebook.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="user_instagram_editar" class="form-label">Usuario de Instagram</label>
                            <input class="form-control" type="text" name="user_instagram" title="Completa este campo" placeholder="Usuario de Instagram" required id="user_instagram_editar">
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona un usuario de Instagram.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="user_twitter_editar" class="form-label">Usuario de Twitter</label>
                            <input class="form-control" type="text" name="user_twitter" title="Completa este campo" placeholder="Usuario de Twitter" required id="user_twitter_editar">
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona un usuario de Twitter.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="tel_whatsapp_editar" class="form-label">Número de Whatsapp</label>
                            <input class="form-control" pattern="[0-9]+" type="tel" minlength="10" maxlength="10" title="Completa este campo" name="tel_whatsapp" placeholder="Número de Whatsapp" required id="tel_whatsapp_editar">
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona un número de Whatsapp.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="email_editar" class="form-label">Email</label>
                            <input type="email" title="Completa este campo / example@gmail.com" placeholder="Correo electrónico" class="form-control" name="email" id="email_editar" required>
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona un email.</div>
                        </div>                         
                        <div class="mb-3">
                            <label for="privilegio_editar" class="form-label">Privilegio</label>
                            <select name="privilegio" required id="privilegio_editar" class="form-select">
                                <option value="admin">Admin</option>
                                <option value="admin-publicaciones">Admin publicaciones</option>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor selecciona un privilegio.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="frase_editar" class="form-label">Escribe una frase</label>
                            <textarea class="form-control" style="height: 100px" title="Completa este campo" placeholder="Frase" name="frase" id="frase_editar" required></textarea>
                            <div class="valid-feedback">Correcto.</div>
                            <div class="invalid-feedback">Por favor escribe una frase.</div>
                        </div>                                                
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="editar_submit" class="btn btn-success">Editar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/darkmode.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../assets/js/autores.js"></script>
</body>
</html>

<?php
    }else{
        header("Location: ../");
    }
?>