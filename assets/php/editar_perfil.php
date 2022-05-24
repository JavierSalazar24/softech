<?php

    session_start();
    include "conn.php";

    if(isset($_SESSION['usuarioblog'])){
        if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['correo'])){

            $nombresE = $_POST['nombre'];
            $apellidosE = $_POST['apellido'];
            $correoE = $_POST['correo'];

            $nombres = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($nombresE)));
            $apellidos = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($apellidosE)));
            $correo = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($correoE)));

            $consulta = mysqli_query($conn, "SELECT * FROM users WHERE email = '$correo'");
            $verificacion = mysqli_num_rows($consulta);

            if ($verificacion > 0) {

                $imagenE=$_FILES['imagen']['name'];

                if (!empty($imagenE)) {
                    $_FILES['imagen']['name'] = $correo.".jpg";
                    $imagenE=$_FILES['imagen']['name'];
                    $imagen = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($imagenE)));

                    $ruta=$_FILES['imagen']['tmp_name'];
                    $destino="../img/users/".$imagen;
                    copy($ruta,$destino);

                    $update = mysqli_query($conn, "UPDATE users SET name = '$nombres', last_name = '$apellidos', picture = '$imagen' WHERE email = '$correo' ");

                    if ($update) {
                        echo json_encode("correcto");
                    }else{
                        echo json_encode("error");
                    }
                }else{
                    $update = mysqli_query($conn, "UPDATE users SET name = '$nombres', last_name = '$apellidos' WHERE email = '$correo' ");

                    if ($update) {
                        echo json_encode("correcto");
                    }else{
                        echo json_encode("error");
                    }
                }
                
            }else{
                echo json_encode("error");
            }
            
        }else {
            echo json_encode('vacio');
        }
    }else if(isset($_SESSION['admin'])){
        if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['genero']) && !empty($_POST['face']) && !empty($_POST['insta']) && !empty($_POST['twitter']) && !empty($_POST['whats']) && !empty($_POST['frase']) && !empty($_POST['privilegio']) && !empty($_POST['correo'])){

            $nombreE = $_POST['nombre'];
            $apellidoE = $_POST['apellido'];
            $generoE = $_POST['genero'];
            $faceE = $_POST['face'];
            $instaE = $_POST['insta'];
            $twitterE = $_POST['twitter'];
            $whatsE = $_POST['whats'];
            $fraseE = $_POST['frase'];
            $privilegioE = $_POST['privilegio'];
            $correoE = $_POST['correo'];

            $nombre = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($nombreE)));
            $apellido = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($apellidoE)));
            $genero = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($generoE)));
            $face = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($faceE)));
            $insta = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($instaE)));
            $twitter = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($twitterE)));
            $whats = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($whatsE)));
            $frase = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($fraseE)));
            $privilegio = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($privilegioE)));
            $correo = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($correoE)));

            $consulta = mysqli_query($conn, "SELECT * FROM authors WHERE email = '$correo'");
            $verificacion = mysqli_num_rows($consulta);

            if ($verificacion > 0) {

                $imagenE = $_FILES['imagen']['name'];

                if (!empty($imagenE)) {

                    $_FILES['imagen']['name'] = $correo.".jpg";
                    $imagenE=$_FILES['imagen']['name'];
                    $imagen = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($imagenE)));

                    $ruta=$_FILES['imagen']['tmp_name'];
                    $destino="../img/authors/".$imagen;
                    copy($ruta,$destino);

                    $update = mysqli_query($conn, "UPDATE authors SET name = '$nombre', last_name = '$apellido', gender = '$genero', user_facebook = '$face', user_instagram = '$insta', user_twitter = '$twitter', tel_whatsapp = '$whats', phrase = '$frase', privilege = '$privilegio', picture = '$imagen' WHERE email = '$correo' ");

                    if ($update) {
                        echo json_encode("correcto");
                    }else{
                        echo json_encode("error");
                    }
                }else{
                    $update = mysqli_query($conn, "UPDATE authors SET name = '$nombre', last_name = '$apellido', gender = '$genero', user_facebook = '$face', user_instagram = '$insta', user_twitter = '$twitter', tel_whatsapp = '$whats', phrase = '$frase', privilege = '$privilegio' WHERE email = '$correo' ");

                    if ($update) {
                        echo json_encode("correcto");
                    }else{
                        echo json_encode("error");
                    }
                }
                
            }else{
                echo json_encode("error");
            }
            
        }else {
            echo json_encode('vacio');
        }
    }else if(isset($_SESSION['admin-publicaciones'])){
        if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['genero']) && !empty($_POST['face']) && !empty($_POST['insta']) && !empty($_POST['twitter']) && !empty($_POST['whats']) && !empty($_POST['frase']) && !empty($_POST['correo'])){

            $nombreE = $_POST['nombre'];
            $apellidoE = $_POST['apellido'];
            $generoE = $_POST['genero'];
            $faceE = $_POST['face'];
            $instaE = $_POST['insta'];
            $twitterE = $_POST['twitter'];
            $whatsE = $_POST['whats'];
            $fraseE = $_POST['frase'];
            $correoE = $_POST['correo'];

            $nombre = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($nombreE)));
            $apellido = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($apellidoE)));
            $genero = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($generoE)));
            $face = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($faceE)));
            $insta = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($instaE)));
            $twitter = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($twitterE)));
            $whats = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($whatsE)));
            $frase = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($fraseE)));
            $correo = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($correoE)));

            $consulta = mysqli_query($conn, "SELECT * FROM authors WHERE email = '$correo'");
            $verificacion = mysqli_num_rows($consulta);

            if ($verificacion > 0) {

                $imagen = $_FILES['imagen']['name'];

                if (!empty($imagen)) {
                    
                    $_FILES['imagen']['name'] = $correo.".jpg";
                    $imagenE=$_FILES['imagen']['name'];
                    $imagen = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($imagenE)));

                    $ruta=$_FILES['imagen']['tmp_name'];
                    $destino="../img/authors/".$imagen;
                    copy($ruta,$destino);

                    $update = mysqli_query($conn, "UPDATE authors SET name = '$nombre', last_name = '$apellido', gender = '$genero', user_facebook = '$face', user_instagram = '$insta', user_twitter = '$twitter', tel_whatsapp = '$whats', phrase = '$frase', picture = '$imagen' WHERE email = '$correo' ");

                    if ($update) {
                        echo json_encode("correcto");
                    }else{
                        echo json_encode("error");
                    }
                }else{
                    $update = mysqli_query($conn, "UPDATE authors SET name = '$nombre', last_name = '$apellido', gender = '$genero', user_facebook = '$face', user_instagram = '$insta', user_twitter = '$twitter', tel_whatsapp = '$whats', phrase = '$frase' WHERE email = '$correo' ");

                    if ($update) {
                        echo json_encode("correcto");
                    }else{
                        echo json_encode("error");
                    }
                }
                
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