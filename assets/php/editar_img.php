<?php

    session_start();
    if (isset($_SESSION['admin'])) {
        include "conn.php";

        if (!empty($_POST['id_img']) && !empty($_FILES['img_carrusel']['name'])){

            $id_img = $_POST['id_img'];            
            
            $_FILES['img_carrusel']['name'] = "img_login$id_img.png";
            $imagenE = $_FILES['img_carrusel']['name'];

            $imagen = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($imagenE)));

            $ruta=$_FILES['img_carrusel']['tmp_name'];
            $destino="../img/login/".$imagen;
            copy($ruta,$destino);

            $update = mysqli_query($conn, "UPDATE imgs SET name = '$imagen' WHERE id = $id_img ");

            if ($update) {
                echo json_encode("correcto");
            }else{
                echo json_encode("error");
            }
                
        }else {
            echo json_encode('vacio');
        }
    }else{
        header("Location: ../../");
    }
?>