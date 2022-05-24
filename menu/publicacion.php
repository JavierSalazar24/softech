<?php

date_default_timezone_set('America/Mexico_City');

session_start();
require("../assets/php/conn.php");
require("../assets/php/functions.php");

if (!isset($_GET["id"])) {
    header("location: ../");
} else {
    $id_post = $_GET["id"];

    $sql = mysqli_query($conn, "SELECT * FROM posts WHERE id = '$id_post'");
    $validacion_sql = mysqli_num_rows($sql);
    
    if ($validacion_sql > 0) {
        $row = mysqli_fetch_array($sql);


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $row["title"]; ?> | SofTech Blog</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

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

<body>

    <?php require_once("../partials/header-menu.php"); ?>

    <main id="main">

        <div class="row d-flex align-items-center" style="width: 100%;">
            <div class="containerimg  d-flex align-items-center" style="background-image: url(../assets/img/sections/busqueda.png);">
                <p class="txtcenter">Publicación</p>
            </div>
        </div>

        <section class="breadcrumbs mt-5">
            <div class="container">

                <div class="d-flex justify-content-between ">
                    <div class="section-title">
                        <h2><?php echo $row["title"]; ?></h2>
                        <a href="seccion?sec=<?php echo $row["section"]; ?>"><?php echo $row["section"]; ?></a>
                    </div>
                    <ol>
                        <li><a href="../">Página principal</a></li>
                        <li><a href="seccion?sec=<?php echo $row["section"] ?>">Sección <?php echo $row["section"] ?></a></li>
                        <li>Publicación</li>
                    </ol>
                </div>

            </div>
        </section>

        <section class="inner-page">
            <div class="container">

                <div class="row ">
                    <div class="col">
                        <?php

                        $sql = mysqli_query($conn, "SELECT * FROM posts WHERE id = '$id_post'");


                        if (mysqli_num_rows($sql)) {
                            while ($row = mysqli_fetch_array($sql)) {
                                $date = strtotime($row["date"]);
                                $id_author = $row["author"];

                                $sql_author = mysqli_query($conn, "SELECT * FROM authors WHERE id = '$id_author'");

                                $row_author = mysqli_fetch_array($sql_author);
                        ?>
                                <div class="post_publi d-flex mt-3">
                                    <img class="publi img-post mb-3 rounded" src="../assets/img/posts/<?php echo $row["multimedia"]; ?>" alt="<?php echo $row["title"]; ?>" srcset="">
                                    <div>
                                        <article class="blog-post ps-3">
                                            <div class="author d-flex align-items-center mb-4">
                                                <img src="../assets/img/authors/<?php echo $row_author["picture"]; ?>" alt="" class="author-profile me-2">
                                                <a href="../#team" class="author-name me-2"><?php echo $row_author["name"] . ' ' . $row_author["last_name"]; ?></a>
                                                <span class="time-ago"><?php echo timeago($date); ?></span>
                                            </div>

                                            <p class="texto-publicacion ms-2"><?php echo $row["content"] ?></p>

                                        </article>
                                    </div>
                                </div>
                                <hr>
                                <form id="compartirForm">
                                    <h4>Comparte en tus redes sociales</h4>
                                    <div class="col-3">
                                        <select name="social" class="form-select mt-4">
                                            <option value="S">Elige una red social</option>
                                            <option value="F"><a href="https://www.facebook.com/sharer.php?u=https://softech.cesenas.com/menu/publicacion?id=<?php echo $id_post?>" target="_blank" class="btn btn_facebook"><i class='bx bxl-facebook-square'></i>Facebook</a></option>
                                            <option value="T"><a href="https://twitter.com/intent/tweet?text=Nueva%20noticia%20amigos&#128513;&url=https://softech.cesenas.com/menu/publicacion?id=<?php echo $id_post?>" target="_blank" class="btn btn_twitter"><i class='bx bxl-twitter'></i>Twittear</a></option>
                                            <option value="W"><a href="https://api.whatsapp.com/send?text=https://softech.cesenas.com/menu/publicacion?id=<?php echo $id_post?>" target="_blank" class="btn btn_whatsapp"><i class='bx bxl-whatsapp'></i>WhatsApp</a></option>
                                        </select>
                                        <input type="hidden" name="id_share" value="<?php echo $id_post?>">
                                        <button class="mt-3 btn btn-primary">Compartir</button>
                                    </div>
                                </form>
                                <!-- <a href="https://www.facebook.com/sharer.php?u=https://softech.cesenas.com/menu/publicacion?id=<?php echo $id_post?>" target="_blank" class="mt-3 btn btn_facebook"><i class='bx bxl-facebook-square'></i> Compartir en Facebook</a> -->
                                <!-- <a href="https://twitter.com/intent/tweet?text=Nueva%20noticia%20amigos&#128513;&url=https://softech.cesenas.com/menu/publicacion?id=<?php echo $id_post?>" target="_blank" class="mt-3 btn btn_twitter"><i class='bx bxl-twitter'></i> Twittear</a> -->
                                <!-- <a href="https://api.whatsapp.com/send?text=https://softech.cesenas.com/menu/publicacion?id=<?php echo $id_post?>" target="_blank" class="mt-3 btn btn_whatsapp"><i class='bx bxl-whatsapp'></i> Enviar en WhatsApp</a> -->
                            <?php
                            }
                        } else {
                            ?>
                            <p>No existe la publicación. <a href="../">Volver al inicio</a></p>
                        <?php
                        }
                        ?>
                    </div>


                </div>

            </div>
        </section>

    </main>

    <?php require_once("../partials/footer-menu.php"); ?>



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../assets/js/compartir.js"></script>
    <script src="../assets/js/darkmode.js"></script>

</body>

</html>

<?php
        }else{
            header("location: ../");
        }
    }
?>
