<?php

  if (!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }else{
    $ip = $_SERVER['REMOTE_ADDR'];
  }

    session_start();
    include 'conn.php';
    error_reporting(0);

    if (!empty($_POST['nombres']) && !empty($_POST['apellidos']) && !empty($_POST['correo']) && !empty($_POST['password'])){

      $nombresE = $_POST['nombres'];
      $apellidosE = $_POST['apellidos'];
      $correoE = $_POST['correo'];
      $passE = $_POST['password'];        

      $nombres = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($nombresE)));
      $apellidos = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($apellidosE)));
      $correo = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($correoE)));
      $pass_sin = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($passE)));

      $token = sha1(uniqid($correo, true));
      $pass_encrypt = openssl_encrypt($pass_sin, 'AES-256-ECB', $correo, 0, $token);
      $pass = base64_encode($pass_encrypt);

      $consulta = mysqli_query($conn, "SELECT * FROM users WHERE email = '$correo'");
      $verificacion = mysqli_num_rows($consulta);

      $consulta_admin = mysqli_query($conn, "SELECT * FROM authors WHERE email = '$correo'");
      $verificacion_admin = mysqli_num_rows($consulta_admin);
  
      if($verificacion == 0 && $verificacion_admin == 0){

        //insertar users
        $consulta_insert = mysqli_query($conn, "INSERT INTO users (id, password, name, last_name, privilege, picture, email, token) VALUES ('', '$pass', '$nombres', '$apellidos', 'usuarioblog', 'unknown.png', '$correo', '$token')");                

        if($consulta_insert){
          //ingresar registro en tabla de logs
          mysqli_query('SET foreign_key_checks = 0');
          date_default_timezone_set('America/Mexico_City');
          $fecha_hora = date('Y-m-d H:i:s');
          $insert = mysqli_query($conn, "INSERT INTO logs VALUES ('', '$ip', '$fecha_hora', '$correo')");
          
          $_SESSION['usuarioblog'] = $correo;
          echo json_encode('correcto');
        }else{
          echo json_encode('error');
        }
      }else {
        echo json_encode('existente');
      }
    }else {
      echo json_encode('vacio');
    }
?>