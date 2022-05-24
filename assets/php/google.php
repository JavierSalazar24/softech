<?php
    session_start();
    require_once 'conn.php';
    header("Content-type: application/json; charset=utf-8");
        
    $_SESSION['usuarioSocial'] = json_decode(file_get_contents("php://input"), true);
    if(!empty($_SESSION["usuarioSocial"])){

        $correo = $_SESSION['usuarioSocial']['email'];
        $consulta_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$correo'");
        $validacion_users = mysqli_num_rows($consulta_users);

        while($info_users = mysqli_fetch_array($consulta_users)){
            $privilegio = $info_users['privilege'];
        }

        if($validacion_users > 0){
      
            if ($privilegio == 'admin') {
                $_SESSION['admin'] = $correo;
                echo json_encode('admin');
            }else if($privilegio == 'admin-publicaciones'){
                $_SESSION['admin-publicaciones'] = $correo;
                echo json_encode('admin');
            }else if($privilegio == 'usuarioblog'){
                echo json_encode("correcto");
            }
        }else{
            echo json_encode("error");
        }
    }else{
        echo json_encode("vacio");
    }



?>