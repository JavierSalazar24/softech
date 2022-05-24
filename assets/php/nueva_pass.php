<?php

    include 'conn.php';
    session_start();    
    error_reporting(0);

    if(!empty($_POST['pass']) && !empty($_POST['conf_pass']) && !empty($_POST['correo'])){
        $passE = $_POST['pass'];
        $conf_passE = $_POST['conf_pass'];
        $correo = $_POST['correo'];

        $pass = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($passE)));
        $conf_pass = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($conf_passE)));

        $token = sha1(uniqid($correo, true));
        $pass_encrypt = openssl_encrypt($pass, 'AES-256-ECB', $correo, 0, $token);
        $pass_cifrada = base64_encode($pass_encrypt);

        $consulta_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$correo'");
        $validacion_users = mysqli_num_rows($consulta_users);

        $consulta_authors = mysqli_query($conn, "SELECT * FROM authors WHERE email = '$correo'");
        $validacion_authors = mysqli_num_rows($consulta_authors);
        
        if($pass === $conf_pass){            

            if($validacion_users > 0){
                $update = mysqli_query($conn, "UPDATE users SET password = '$pass_cifrada' WHERE email = '$correo'");
                if ($update) {
                    echo json_encode("correcto");
                } else {
                    echo json_encode("errors");
                }
            }else if ($validacion_authors > 0){
                $update = mysqli_query($conn, "UPDATE authors SET password = '$pass_cifrada' WHERE email = '$correo'");
                if ($update) {
                    echo json_encode("correcto");
                } else {
                    echo json_encode("errors");
                }
            }else{
                echo json_encode("errors");
            }
            
            $_SESSION = array();
            session_destroy();
            setcookie("token", $toke, time()-800, '/', NULL, 0);

        }else{
            echo json_encode("error");            
        }
    }else {
        echo json_encode('vacio');
    }

?>