<?php

date_default_timezone_set('America/Mexico_City');
session_start();
require("../assets/php/conn.php");
require("../assets/php/functions.php");
error_reporting(0);

if (isset($_SESSION['admin'])||isset($_SESSION['admin-publicaciones'])) {

    $opc = "";
    
    if (isset($_GET["q"]) && isset($_GET["opc"])) {
      $busqueda = $_GET["q"];
      $opc = $_GET["opc"];
    } elseif (isset($_POST["q"]) && isset($_POST["opc"])) {
      $busqueda = $_POST["q"];
      $opc = $_POST["opc"];
    }
    
    if(isset($_SESSION['admin-publicaciones'])){
        $correo_authors = $_SESSION['admin-publicaciones'];
        $consulta_authors = mysqli_query($conn, "SELECT * FROM authors WHERE email = '$correo_authors' ");
        $row_consulta_author = mysqli_fetch_array($consulta_authors);
    }else if(isset($_SESSION['admin'])){
        $correo_authors = $_SESSION['admin'];
        $consulta_authors = mysqli_query($conn, "SELECT * FROM authors ");
    }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Posts | SofTech Blog</title>
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
                <p class="txtcenter">Posts</p>
            </div>
        </div>

        <section class="breadcrumbs mt-5">
            <div class="container">
                <div class="d-flex justify-content-between ">
                    <div class="section-title">
                        <h2>Noticias de <?php if(isset($_SESSION['admin-publicaciones'])){ echo $row_consulta_author['name'].' '.$row_consulta_author['last_name']; }else{ echo 'los autores'; } ?></h2>
                    </div>
                    <ol>
                        <li><a href=".././">Página principal</a></li>
                        <li>Posts</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="inner-page">
            <div class="container">               
                <div class="row ">
                    <?php if(isset($_SESSION['admin-publicaciones'])){ ?>        
                        <div class="col-lg-4 col-md-12 filtros_position">
                            <div class="position-sticky" style="top: 8rem;">
                                <div class="p-4 mb-3 bg-light rounded">
                                    <div class="text-center">
                                        <a class="btn btn-primary mt-2 me-3" data-toggle="modal" data-target="#VentanaModalA">Agregar noticia</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12">
                            <?php
                            $cont = 0;                                                    
                            $id = $row_consulta_author['id'];
                            $sql = mysqli_query($conn, "SELECT * FROM posts WHERE author = $id ");

                            if (mysqli_num_rows($sql)) {
                                while ($row = mysqli_fetch_array($sql)) {
                                    $cont++;
                                    $date = strtotime($row["date"]);
                                    $id_author = $row["author"];

                                    $sql_author = mysqli_query($conn, "SELECT * FROM authors WHERE id = '$id_author'");

                                    $row_author = mysqli_fetch_array($sql_author);
                            ?>
                                    <div class="card mb-3 mt-3">
                                        <div class="row g-0" id="noticia">
                                            <div class="col-md-4 img-container">
                                                <img src="../assets/img/posts/<?php echo $row["multimedia"]; ?>" id="img_<?php echo $row['id'] ?>" class="img-fluid rounded-start img-post" alt="<?php echo $row["title"]; ?>">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title" id="title_<?php echo $row['id']; ?>"><?php echo $row["title"]; ?></h5>
                                                    <div class="author d-flex align-items-center mb-4">
                                                        <img src="../assets/img/authors/<?php echo $row_author["picture"] ?>" alt="<?php echo $row_author["name"] . " " . $row_author["last_name"] ?>" class="author-profile me-2">
                                                        <a href="../#team" class="author-name me-2"><?php echo $row_author["name"] . " " . $row_author["last_name"] ?></a>
                                                        <span class="time-ago"><?php echo timeago($date); ?></span>
                                                    </div>
                                                    <p class="card-text"><?php echo substr($row["content"], 0, 100) . "..." ?></p>

                                                    <a href="publicacion?id=<?php echo $row["id"]; ?>">Seguir leyendo..</a>
                                                    <div class="text-center mt-2">
                                                        <a class="mt-2 me-3 btn btn-success" onclick="editar('<?php echo $row['id'] ?>')" data-toggle="modal" data-target="#VentanaModalE" id="btn_editarPost" style="font-size: 20px;"><i class='bx bxs-edit'></i></a>
                                                        <a class="mt-2 me-3 btn btn-danger" onclick="eliminar('<?php echo $row['id'] ?>')" style="font-size: 20px;"><i class='bx bxs-trash'></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" value="<?php echo $row_author["id"]; ?>" id="author_<?php echo $row['id'] ?>">
                                            <input type="hidden" value="<?php echo $row["section"]; ?>" id="sec_<?php echo $row['id']; ?>">
                                            <input type="hidden" value="<?php echo $row["content"]; ?>" id="notice_<?php echo $row['id']; ?>">
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
                    <?php }else{ ?> 
                        <div class="col-lg-4 col-md-12 filtros_position">
                            <div class="position-sticky" style="top: 8rem;">
                                <div class="p-4 mb-3 bg-light rounded">
                                    <h2 id="pri">Filtrar publicaciones</h2>
                                    <div class="filtros">
                                        <form action="posts" id="form2" name="q" method="POST">
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

                                                <div class="d-flex justify-content-between mt-2 botones_filtros">
                                                    <input type="submit" name="filtros" class="btn btn-primary mt-2 me-2" value="Aplicar filtros">
                                                    <input type="reset" class="btn btn-primary mt-2" value="Limpiar filtros">
                                                </div>

                                        </form>
                                    </div>
                                    <div class="text-center mt-3">
                                        <a class="btn btn-primary mt-2 me-3" data-toggle="modal" data-target="#VentanaModalA">Agregar noticia</a>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12">
                            <?php
                                $cont = 0;
                                if (isset($_POST['author'])) {
                                    $aut_post = $_POST['author'];
                                    $sql = mysqli_query($conn, "SELECT * FROM posts WHERE author = '$aut_post' ");
                                }else {
                                    $sql = mysqli_query($conn, "SELECT * FROM posts ");
                                }
                                if (mysqli_num_rows($sql)) {
                                    while ($row = mysqli_fetch_array($sql)) {
                                        $cont++;
                                        $date = strtotime($row["date"]);
                                        $id_author = $row["author"];

                                        $sql_author = mysqli_query($conn, "SELECT * FROM authors WHERE id = '$id_author'");

                                        $row_author = mysqli_fetch_array($sql_author);
                                ?>
                                        <div class="card mb-3 mt-3">
                                            <div class="row g-0" id="noticia">
                                                <div class="col-md-4 img-container">
                                                    <img src="../assets/img/posts/<?php echo $row["multimedia"]; ?>" id="img_<?php echo $row['id'] ?>" class="img-fluid rounded-start img-post" alt="<?php echo $row["title"]; ?>">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title" id="title_<?php echo $row['id']; ?>"><?php echo $row["title"]; ?></h5>
                                                        <div class="author d-flex align-items-center mb-4">
                                                            <img src="../assets/img/authors/<?php echo $row_author["picture"] ?>" alt="<?php echo $row_author["name"] . " " . $row_author["last_name"] ?>" class="author-profile me-2">
                                                            <a href="../#team" class="author-name me-2"><?php echo $row_author["name"] . " " . $row_author["last_name"] ?></a>
                                                            <span class="time-ago"><?php echo timeago($date); ?></span>
                                                        </div>
                                                        <p class="card-text"><?php echo substr($row["content"], 0, 100) . "..." ?></p>

                                                        <a href="publicacion?id=<?php echo $row["id"]; ?>">Seguir leyendo..</a>
                                                        <div class="text-center mt-2">
                                                            <a class="mt-2 me-3 btn btn-success" onclick="editar('<?php echo $row['id'] ?>')" data-toggle="modal" data-target="#VentanaModalE" id="btn_editarPost" style="font-size: 20px;"><i class='bx bxs-edit'></i></a>
                                                            <a class="mt-2 me-3 btn btn-danger" onclick="eliminar('<?php echo $row['id'] ?>')" style="font-size: 20px;"><i class='bx bxs-trash'></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="<?php echo $row_author["id"]; ?>" id="author_<?php echo $row['id'] ?>">
                                                <input type="hidden" value="<?php echo $row["section"]; ?>" id="sec_<?php echo $row['id']; ?>">
                                                <input type="hidden" value="<?php echo $row["content"]; ?>" id="notice_<?php echo $row['id']; ?>">
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
                    <?php } ?>
                </div>
            </div>
        </section>

    </main>

    <?php require_once("../partials/footer-menu.php"); ?>



    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Modal Agregar -->
    <form id="agregar_post" class="needs-validation" novalidate>
        <div class="modal fade" id="VentanaModalA" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Noticia</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 text-center">
                            <label for="img_agregar" class="form-label">Imagen</label>
                            <div>
                                <img src="../assets/img/logo.png" id="imgPrev_agregar" width="350px" height="250px"/>
                            </div>
                        </div>
                        <div class="mb-4 text-center">
                            <input accept="image/*" type="file" id="img_agregar" name="img" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" title="Solo números" pattern="[0-9]+" type="hidden" name="id_post" required id="id_agregar" readonly>
                            <label for="title_agregar" class="form-label">Titulo</label>
                            <input class="form-control" pattern="[a-zA-Zá-úÁ-Ú ]+" type="text" name="title" required id="title_agregar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un titulo.</div>
                        </div>
                        <div class="mb-3">
                            <label for="sec_agregar" class="form-label">Sección</label>
                            <select name="sec" required id="sec_agregar" class="form-select">
                                <option value="">Seleccionar sección</option>
                                <option value="Software">Software</option>
                                <option value="Videojuegos">Videojuegos</option>
                                <option value="Windows">Windows</option>
                                <option value="Mac">Mac</option>
                                <option value="Linux">Linux</option>
                                <option value="Android">Android</option>
                                <option value="iOS">iOS</option>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor selecciona una sección.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="author_agregar" class="form-label">Autor</label>
                            <select name="author" required id="author_agregar" class="form-select">
                                <?php if(isset($_SESSION['admin-publicaciones'])){ ?>
                                <option value="<?php echo $row_consulta_author['id']; ?>" <?php if($correo_authors == $row_consulta_author['email']){ echo 'selected'; } ?>><?php echo $row_consulta_author['name'].' '.$row_consulta_author['last_name']; ?></option>
                                <?php }elseif(isset($_SESSION['admin'])){ 
                                    foreach($consulta_authors as $row_consulta_author){
                                ?>
                                    <option value="<?php echo $row_consulta_author['id']; ?>" <?php if($correo_authors == $row_consulta_author['email']){ echo 'selected'; } ?>><?php echo $row_consulta_author['name'].' '.$row_consulta_author['last_name']; ?></option>
                                <?php } } ?>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor selecciona un autor.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="notice_agregar" class="form-label">Escribe la noticia</label>
                            <textarea class="form-control" style="height: 500px" name="notice" id="notice_agregar" required></textarea>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor escribe una noticia.</div>
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
    <form id="editarForm" class="needs-validation" novalidate>
        <div class="modal fade" id="VentanaModalE" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Noticia </h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 text-center">
                            <label for="img_editar" class="form-label">Imagen</label>
                            <div>
                                <img src="" id="imgPrev_editar" width="350px" height="250px"/>
                            </div>
                        </div>
                        <div class="mb-4 text-center">
                            <input accept="image/*" type="file" id="img_editar" name="img">
                        </div>
                        <div class="mb-3">
                            <input class="form-control" title="Solo números" pattern="[0-9]+" type="hidden" name="id_post" required id="id_editar" readonly>
                            <label for="title_editar" class="form-label">Titulo</label>
                            <input class="form-control" pattern="[a-zA-Zá-úÁ-Ú ]+" type="text" name="title" required id="title_editar">
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor ingresa un titulo.</div>
                        </div>
                        <div class="mb-3">
                            <label for="sec_editar" class="form-label">Sección</label>
                            <select name="sec" required id="sec_editar" class="form-select">
                                <option value="Software">Software</option>
                                <option value="Videojuegos">Videojuegos</option>
                                <option value="Windows">Windows</option>
                                <option value="Mac">Mac</option>
                                <option value="Linux">Linux</option>
                                <option value="Android">Android</option>
                                <option value="iOS">iOS</option>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor selecciona una sección.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="author_editar" class="form-label">Autor</label>
                            <select name="author" required id="author_editar" class="form-select">
                            <?php if(isset($_SESSION['admin-publicaciones'])){ ?>
                                <option value="<?php echo $row_consulta_author['id']; ?>" <?php if($correo_authors == $row_consulta_author['email']){ echo 'selected'; } ?>><?php echo $row_consulta_author['name'].' '.$row_consulta_author['last_name']; ?></option>
                                <?php }elseif(isset($_SESSION['admin'])){ 
                                    foreach($consulta_authors as $row_consulta_author){
                                ?>
                                    <option value="<?php echo $row_consulta_author['id']; ?>" <?php if($correo_authors == $row_consulta_author['email']){ echo 'selected'; } ?>><?php echo $row_consulta_author['name'].' '.$row_consulta_author['last_name']; ?></option>
                                <?php } } ?>
                            </select>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor selecciona un autor.</div>
                        </div> 
                        <div class="mb-3">
                            <label for="notice_editar" class="form-label">Escribe la noticia</label>
                            <textarea class="form-control" style="height: 500px" name="notice" id="notice_editar" required></textarea>
                            <div class="valid-feedback">Correcto.</div>
						    <div class="invalid-feedback">Por favor escribe una noticia.</div>
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
    <script src="../assets/js/post.js"></script>

</body>

</html>

<?php
    }else{
        header('../');
    }
?>