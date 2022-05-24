<?php

session_start();
if (isset($_SESSION['admin'])) {
    include "conn.php";
    date_default_timezone_set('America/Mexico_City');
    $date = date('Y-m-d H:i:s');

    if (!empty($_POST['title']) && !empty($_POST['sec']) && !empty($_POST['author']) && !empty($_POST['notice'])){

        $id_post = $_POST['id_post'];
        $titleE = $_POST['title'];
        $secE = $_POST['sec'];
        $authorE = $_POST['author'];
        $noticeE = $_POST['notice'];

        $title = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($titleE)));
        $sec = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($secE)));
        $author = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($authorE)));
        $notice = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($noticeE)));

        $consulta_posts = mysqli_query($conn, "SELECT * FROM posts ORDER by ID DESC LIMIT 1");
        $result = mysqli_fetch_array($consulta_posts);
        $num = $result['id']+1;
            
        $_FILES['img']['name'] = "$num.jpg";        
        $imagenE = $_FILES['img']['name'];

        $imagen = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($imagenE)));

        if (!empty($imagen)) {
            $ruta=$_FILES['img']['tmp_name'];
            $destino="../img/posts/".$imagen;
            copy($ruta,$destino);

            $insert = mysqli_query($conn, "INSERT INTO posts VALUES ('', '$title', '$sec', $author, '$notice', '$date', '$imagen')");

            if ($insert) {
                echo json_encode("correcto");
            }else{
                echo json_encode("error");
            }
        }else{
            echo json_encode('sinimg');        
        }
            
    }else {
        echo json_encode('vacio');
    }
}else{
    header("Location: ../../");
}
?>