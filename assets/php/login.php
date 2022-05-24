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

    if (!empty($_POST['correo']) && !empty($_POST['password'])){

        $correoE = $_POST['correo'];
        $passE = $_POST['password'];

        $correo = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($correoE)));
        $pass_sin = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($passE)));

        $token = sha1(uniqid($correo, true));
        $pass_encrypt = openssl_encrypt($pass_sin, 'AES-256-ECB', $correo, 0, $token);
        $pass = base64_encode($pass_encrypt);

        $consulta_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$correo' AND password = '$pass'");
        $validacion_users = mysqli_num_rows($consulta_users);

        $consulta_admin = mysqli_query($conn, "SELECT * FROM authors WHERE email = '$correo' AND password = '$pass'");
        $validacion_admin = mysqli_num_rows($consulta_admin);

        $consulta_logs = mysqli_query($conn, "SELECT * FROM logs WHERE email_user = '$correo'");      
        $validacion_logs = mysqli_num_rows($consulta_logs);        

        date_default_timezone_set('America/Mexico_City');
        $fecha_hora = date('Y-m-d H:i:s');

        if($validacion_logs > 0){
          mysqli_query('SET foreign_key_checks = 0');
          $update = mysqli_query($conn, "UPDATE logs SET date = '$fecha_hora' WHERE email_user = '$correo'");
        }else{
          mysqli_query($conn, "SET foreign_key_checks = 0");
          $insert = mysqli_query($conn, "INSERT INTO logs VALUES ('', '$ip', '$fecha_hora', '$correo')");
        }

        if($validacion_users > 0){

          while($info_user = mysqli_fetch_array($consulta_users)){
            $privilegio = $info_user['privilege'];
          }

          if($privilegio == 'usuarioblog'){
            $_SESSION['usuarioblog'] = $correo;
            echo json_encode('user');
          }else{
            echo json_encode('null');
          }

        }else if ($validacion_admin > 0) {

          while($info_admin = mysqli_fetch_array($consulta_admin)){
            $privilegio = $info_admin['privilege'];
          }
          
          if($privilegio == 'admin'){
            $_SESSION['admin'] = $correo;
            echo json_encode('admin');
          }else if($privilegio == 'admin-publicaciones'){
            $_SESSION['admin-publicaciones'] = $correo;
            echo json_encode('admin');
          }else{
            echo json_encode('null');
          }

        }else {
          echo json_encode('null');
        }

    }else{
      echo json_encode('vacio');
    }
?>