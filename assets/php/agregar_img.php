<?php

    session_start();
    include "conn.php";
    // var_dump($_FILES);
    if (isset($_SESSION['admin'])) {

        if (!empty($_FILES['img_carrusel']['name'])){


            $consulta_imgs = mysqli_query($conn, "SELECT * FROM imgs ORDER by ID DESC LIMIT 1");
            $result = mysqli_fetch_array($consulta_imgs);
            $num = $result['id']+1;

            $_FILES['img_carrusel']['name'] = "img_login$num.png";
            $imagenE = $_FILES['img_carrusel']['name'];

            $imagen = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($imagenE)));

            $ruta = $_FILES['img_carrusel']['tmp_name'];
            $destino = "../img/login/".$imagen;
            copy($ruta,$destino);


            $insert = mysqli_query($conn, "INSERT INTO imgs VALUES ('', '$imagen')");

            if ($insert) {
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