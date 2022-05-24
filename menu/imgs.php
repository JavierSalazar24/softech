<?php
    
    session_start();
    require("../assets/php/conn.php");

    if(isset($_SESSION['admin'])){

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagenes del carrusel | SofTech</title>

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
                <p class="txtcenter">Imagenes del carrusel</p>
            </div>
        </div>

        <section class="breadcrumbs mt-5">
            <div class="container">

                <div class="d-flex justify-content-between ">
                    <div class="section-title">
                        <h2>Imagenes</h2>
                        <?php if(isset($_SESSION['admin'])){ ?>
                            <a class="btn btn-primary mt-2 me-3" data-toggle="modal" data-target="#VentanaModalA" style="color: #fff">Agregar imágen</a>
                        <?php } ?>
                    </div>
                    <ol>
                        <li><a href=".././">Página principal</a></li>
                        <li>Imagenes del carrusel</li>
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
                                    $consulta_imgs = mysqli_query($conn, "SELECT * FROM imgs");
                                    $validacion_imgs = mysqli_num_rows($consulta_imgs);

                                    if ($validacion_imgs > 0) {
                                        foreach($consulta_imgs as $imgs){

                                ?>
                                    <div class="col-lg-4 col-md-8 d-flex align-items-start">
                                        <div class="member">
                                            <img class="publi img-post mb-3 rounded" id="img_<?php echo $imgs['id'] ?>" src="../assets/img/login/<?php echo $imgs['name']; ?>" width="200px" height="200px"  alt="Imagen <?php echo $imgs['id']; ?> del carrousel">
                                            <h4><?php echo $imgs['name']; ?></h4>
                                            <div class="mt-3 d-flex justify-content-around">
                                                <a class="mt-3 btn btn-success" onclick="editar('<?php echo $imgs['id'] ?>')" data-toggle="modal" data-target="#VentanaModalE" id="btn_editarimg" style="font-size: 20px;"><i class='bx bxs-edit'></i></a>
                                                <a class="mt-3 btn btn-danger" onclick="eliminar('<?php echo $imgs['id'] ?>')" style="font-size: 20px;"><i class='bx bxs-trash'></i></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php } } else { ?>
                                    <div class="col-lg-4 col-md-8 d-flex align-items-start">
                                        <div class="member">
                                            <h4>No existen imagenes</h4>
                                        </div>
                                    </div>
                                <?php } ?>

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
    <form id="agregar_imgs" class="needs-validation" novalidate>
        <div class="modal fade" id="VentanaModalA" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar imágen</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 text-center">
                            <label for="img_agregar" class="form-label">Imágen</label>
                            <div id="img_editar_imgs">
                                <img src="../assets/img/logo.png" id="imgPrev_agregar" width="250px" height="200px"/>
                            </div>
                        </div>
                        <div class="mb-4 text-center">
                            <input accept="image/*" type="file" id="input_imagen" title="Agrega una imagen" name="img_carrusel" required>
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
    <form id="editar_imgs" class="needs-validation" novalidate>
        <div class="modal fade" id="VentanaModalE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Editar imágen</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 text-center">
                            <label for="img_editar" class="form-label">Imágen</label>
                            <div>
                                <img src="../assets/img/logo.png" id="imgPrev_editar" class="img_editar" width="250px" height="250px"/>
                            </div>
                        </div>
                        <div class="mb-4 text-center">
                            <input class="form-control" title="Solo números" pattern="[0-9]+" type="hidden" name="id_img" required id="id_editar" readonly>
                            <input type="file" accept="image/*" id="input_imagen_editar" title="Agrega una imagen" name="img_carrusel" required>
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
    <script src="../assets/js/imgs_carrusel.js"></script>
</body>
</html>

<?php
    }else{
        header("Location: ../");
    }
?>