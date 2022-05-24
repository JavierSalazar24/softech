<?php

date_default_timezone_set('America/Mexico_City');
session_start();
require("../assets/php/conn.php");
require("../assets/php/functions.php");

$opc = "";

if (!isset($_GET["sec"])) {
    header("location: ../");
} else {
    $sec = $_GET["sec"];

    $sql = mysqli_query($conn, "SELECT * FROM posts WHERE section = '$sec'");
    $validacion_sql = mysqli_num_rows($sql);
    
    if ($validacion_sql > 0) {
        $row = mysqli_fetch_array($sql);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sección <?php echo $sec; ?> | SofTech Blog</title>
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

<body class="dark">

    <?php require_once("../partials/header-menu.php"); ?>

    <main id="main">

        <div class="row d-flex align-items-center" style="width: 100%;">
            <div class="containerimg  d-flex align-items-center" style="background-image: url(../assets/img/sections/busqueda.png);">
                <p class="txtcenter">Sección <?php echo $sec; ?></p>
            </div>
        </div>

        <section class="breadcrumbs mt-5">
            <div class="container">

                <div class="d-flex justify-content-between ">
                    <div class="section-title">
                        <h2>Sección <?php echo $sec; ?></h2>
                    </div>
                    <ol>
                        <li><a href=".././">Página principal</a></li>
                        <li>Sección <?php echo $sec; ?></li>
                    </ol>
                </div>

            </div>
        </section>

        <section class="inner-page">
            <div class="container">

                <div class="row ">
                    <div class="col-lg-4 col-md-12 filtros_position">
                        <div class="position-sticky" style="top: 8rem;">
                            <div class="p-4 mb-3 bg-light rounded">
                                <h2 class="text-center" id="pri">Filtrar publicaciones</h2>
                                <div class="filtros">
                                    <form action="seccion?sec=<?php echo $sec ?>" id="form2" name="q" method="POST">
                                        <label for="aut">Filtrar por autor</p>
                                            <select id="aut" class="form-select mb-4" aria-label="Default select example" name="author">
                                                <option value="All">Todos los autores</option>
                                                <?php
                                                $consulta_authors = mysqli_query($conn, "SELECT * FROM authors");
                                                $validacion_authors = mysqli_num_rows($consulta_authors);

                                                if ($validacion_authors > 0) {
                                                    foreach($consulta_authors as $info_authors){
                                                    if (!empty($_POST['author'])){ 
                                                ?>
                                                <option value="<?php echo $info_authors['id']; ?>" <?php if($_POST['author'] == $info_authors['id']){ echo 'selected'; } ?>> <?php echo $info_authors['name'].' '.$info_authors['last_name']; ?></option>
                                                <?php }else{ ?>                      
                                                <option value="<?php echo $info_authors['id']; ?>"><?php echo $info_authors['name'].' '.$info_authors['last_name']; ?></option>
                                                <?php }}}?>
                                            </select>

                                            <p>Fecha desde: </p>
                                            <?php if (!empty($_POST['datesince'])){ ?>
                                                <input name="datesince" type="date" class="form-control mb-4" id="inputDate" min="2022-01-01" value="<?php echo $_POST['datesince'] ?>">
                                            <?php }else{ ?>
                                                <input name="datesince" type="date" class="form-control mb-4" id="inputDate" min="2022-01-01">
                                            <?php } ?>

                                            <p>Fecha hasta: </p>
                                            <?php if (!empty($_POST['dateto'])){ ?>
                                                <input name="dateto" type="date" class="form-control" id="inputDate" min="2022-01-01" value="<?php echo $_POST['dateto'] ?>">
                                            <?php }else{ ?>
                                                <input name="dateto" type="date" class="form-control" id="inputDate" min="2022-01-01">
                                            <?php } ?>

                                            <div class="d-flex justify-content-between mt-3 botones_filtros">
                                                <input type="submit" name="filtros" class="btn btn-primary mt-2 me-2" value="Aplicar filtros">
                                                <input type="reset" class="btn btn-primary mt-2" value="Limpiar filtros">
                                            </div>

                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <?php
                        $cont = 0;
                        if (isset($_POST["filtros"])) {
                            if ($_POST["author"] == 'All' && $_POST["datesince"] == '') {
                                $filtro = "WHERE section = '" . $sec . "' AND title LIKE '%" . $_POST["q"] . "%'";
                            } elseif ($_POST["author"] != 'All' && $_POST["datesince"] == '') {
                                $filtro = "WHERE section = '" . $sec . "' AND author = '" . $_POST["author"] . "'";
                            } elseif ($_POST["author"] != 'All' && $_POST["datesince"] != '') {
                                $filtro = "WHERE section = '" . $sec . "' AND author = '" . $_POST["author"] . "' AND date BETWEEN '" . $_POST["datesince"] . "' AND '" . $_POST["dateto"] . "'";
                            } elseif ($_POST["author"] == 'All' && $_POST["datesince"] != '') {
                                $filtro = "WHERE section = '" . $sec . "' AND date BETWEEN '" . $_POST["datesince"] . "' AND '" . $_POST["dateto"] . "'";
                            }

                            $sql = mysqli_query($conn, "SELECT * FROM posts $filtro");
                        } else {
                            $sql = mysqli_query($conn, "SELECT * FROM posts WHERE section = '$sec' ORDER BY date DESC");
                        }

                        if (mysqli_num_rows($sql)) {
                            while ($row = mysqli_fetch_array($sql)) {
                                $cont++;
                                $date = strtotime($row["date"]);
                                $id_author = $row["author"];

                                $sql_author = mysqli_query($conn, "SELECT * FROM authors WHERE id = '$id_author'");

                                $row_author = mysqli_fetch_array($sql_author);
                        ?>
                                <div class="card mb-3">
                                    <div class="row g-0">
                                        <div class="col-md-4 img_section img-container">
                                            <img src="../assets/img/posts/<?php echo $row["multimedia"]; ?>" class="img-fluid rounded-start img-post" alt="<?php echo $row["title"]; ?>">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row["title"]; ?></h5>
                                                <div class="author d-flex align-items-center mb-4">
                                                    <img src="../assets/img/authors/<?php echo $row_author["picture"] ?>" alt="" class="author-profile me-2">
                                                    <a href="../#team" class="author-name me-2"><?php echo $row_author["name"] . " " . $row_author["last_name"] ?></a>
                                                    <span class="time-ago"><?php echo timeago($date); ?></span>
                                                </div>
                                                <p class="card-text"><?php echo substr($row["content"], 0, 100) . "..." ?></p>

                                                <a href="publicacion?id=<?php echo $row["id"]; ?>">Seguir leyendo..</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <p>No hay resultados que coincidan con los filtros. <a href="../">Volver al inicio</a> o <a href="seccion?sec=<?php echo $sec ?>">Ver todas las publicaciones.</a></p>
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
    <script src="../assets/js/darkmode.js"></script>

</body>

</html>


<?php
        }else{
            header("location: ../");
        }
    }
?>