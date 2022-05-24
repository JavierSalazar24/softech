<?php

    session_start();
    if (isset($_SESSION['admin'])) {
        include "conn.php";
        if (!empty($_POST['id_post']) && !empty($_POST['title']) && !empty($_POST['sec']) && !empty($_POST['author']) && !empty($_POST['notice'])){

            $id_post = $_POST['id_post'];
            $titleE = $_POST['title'];
            $secE = $_POST['sec'];
            $authorE = $_POST['author'];
            $noticeE = $_POST['notice'];

            $title = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($titleE)));
            $sec = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($secE)));
            $author = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($authorE)));
            $notice = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($noticeE)));

            $imagenE=$_FILES['img']['name'];

            if (!empty($imagenE)) {
                $_FILES['img']['name'] = "$id_post.jpg";
                $imagenE = $_FILES['img']['name'];
                $imagen = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($imagenE)));

                $ruta=$_FILES['img']['tmp_name'];
                $destino="../img/posts/".$imagen;
                copy($ruta,$destino);

                $update = mysqli_query($conn, "UPDATE posts SET title = '$title', section = '$sec', author = $author, content = '$notice', multimedia = '$imagen' WHERE id = $id_post ");

                if ($update) {
                    echo json_encode("correcto");
                }else{
                    echo json_encode("error");
                }
            }else{
                $update = mysqli_query($conn, "UPDATE posts SET title = '$title', section = '$sec', author = $author, content = '$notice' WHERE id = $id_post ");

                if ($update) {
                    echo json_encode("correcto");
                }else{
                    echo json_encode("error");
                }
            }
                
        }else {
            echo json_encode('vacio');
        }
    }else{
        header("Location: ../../");
    }
?>