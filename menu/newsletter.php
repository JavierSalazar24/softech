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
    <title>Newsletter | SofTech</title>

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
                <p class="txtcenter">Newsletter</p>
            </div>
        </div>

        <section class="breadcrumbs mt-5">
            <div class="container">

                <div class="d-flex justify-content-between ">
                    <div class="section-title">
                        <h2>Enviar noticia</h2>
                    </div>
                    <ol>
                        <li><a href=".././">Página principal</a></li>
                        <li>Newsletter</li>
                    </ol>
                </div>

            </div>
        </section>

        <div id="newsletters" class="form-3">
            <div class="container">
                <div class="row justify-content-center">
                    <h4 class="mb-3 text-center">Envía un correo a todos los usuarios suscritos</h4>
                    <div class="col-8 mt-3">
                        <form id="newsletterForm" data-toggle="validator" data-focus="false">
                            <div class="form-group">
                                <label class="label-control" for="cname">Asunto</label>
                                <input type="text" title="Completa este campo" class="form-control-input" name="asunto" required>
                            </div>
                            <div class="form-group">
                                <label class="label-control" for="cmessage">Mensaje</label>
                                <textarea class="form-control-textarea" name="mensaje" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" id="csubmit" class="form-control-submit-button">Enviar mensaje</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>      
        </div>

    </main>

    <?php require_once("../partials/footer-menu.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/darkmode.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../assets/js/newsletter.js"></script>
</body>
</html>

<?php
    }else{
        header("Location: ../");
    }
?>