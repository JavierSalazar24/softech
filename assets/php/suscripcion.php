<?php

include "conn.php";
// error_reporting(0);
    if(!empty($_POST['email'])) {
        $correo = $_POST['email'];
        $consulta = mysqli_query($conn, "SELECT * FROM users WHERE email = '$correo'");
        $validacion = mysqli_num_rows($consulta);

        while($info_users = mysqli_fetch_array($consulta)){
            $id = $info_users['id'];
        }

        if($validacion > 0){
            $consulta_news = mysqli_query($conn, "SELECT * FROM newsletter WHERE user_id = $id");
            $validacion_news = mysqli_num_rows($consulta_news);

            if ($validacion_news > 0) {
                echo json_encode('existente');
            }else{
                $insert = mysqli_query($conn, "INSERT INTO newsletter VALUES ('', $id)");
                echo json_encode('correcto');
            }
        }else{
            echo json_encode('nosuscrito');            
        }
    }else{
        echo json_encode('vacio');
    }

?>