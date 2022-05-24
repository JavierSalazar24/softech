<?php

session_start();
if (isset($_SESSION['admin'])) {

    include "conn.php";
    date_default_timezone_set('America/Mexico_City');
    $date = date('Y-m-d H:i:s');

    if (!empty($_POST['id_autor'])&&!empty($_POST['nombre'])&&!empty($_POST['apellido'])&&!empty($_POST['genero'])&&!empty($_POST['user_facebook'])&&!empty($_POST['user_instagram'])&&!empty($_POST['user_twitter'])&&!empty($_POST['tel_whatsapp'])&&!empty($_POST['email'])&&!empty($_POST['privilegio'])&&!empty($_POST['frase'])){

        $id_autor = $_POST['id_autor'];
        $nombreE = $_POST['nombre'];
        $apellidoE = $_POST['apellido'];
        $generoE = $_POST['genero'];
        $user_facebookE = $_POST['user_facebook'];
        $user_instagramE = $_POST['user_instagram'];
        $user_twitterE = $_POST['user_twitter'];
        $tel_whatsappE = $_POST['tel_whatsapp'];
        $emailE = $_POST['email'];
        $privilegioE = $_POST['privilegio'];
        $fraseE = $_POST['frase'];

        $nombre = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($nombreE)));
        $apellido = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($apellidoE)));
        $genero = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($generoE)));
        $user_facebook = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($user_facebookE)));
        $user_instagram = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($user_instagramE)));
        $user_twitter = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($user_twitterE)));
        $tel_whatsapp = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($tel_whatsappE)));
        $email = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($emailE)));
        $privilegio = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($privilegioE)));
        $frase = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($fraseE)));        

        $imagenE=$_FILES['img']['name'];

        if (!empty($imagenE)) {
            $_FILES['img']['name'] = $email.".jpg";
            $imagenE=$_FILES['img']['name'];
            $imagen = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($imagenE)));

            $ruta=$_FILES['img']['tmp_name'];
            $destino="../img/authors/".$imagen;
            copy($ruta,$destino);

            $update = mysqli_query($conn, "UPDATE authors SET name = '$nombre', last_name = '$apellido', gender = '$genero', user_facebook = '$user_facebook', user_instagram = '$user_instagram', user_twitter = '$user_twitter', tel_whatsapp = '$tel_whatsapp', member_since = '$date', email = '$email', privilege = '$privilegio', phrase = '$frase', picture = '$imagen' WHERE id = $id_autor");

            if ($update) {
                echo json_encode("correcto");
            }else{
                echo json_encode("error");
            }
        }else{
            $update = mysqli_query($conn, "UPDATE authors SET name = '$nombre', last_name = '$apellido', gender = '$genero', user_facebook = '$user_facebook', user_instagram = '$user_instagram', user_twitter = '$user_twitter', tel_whatsapp = '$tel_whatsapp', member_since = '$date', email = '$email', privilege = '$privilegio', phrase = '$frase' WHERE id = $id_autor ");

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