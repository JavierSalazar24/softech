<?php

    session_start();
    if (isset($_SESSION['admin'])) {
        include "conn.php";
        header("Content-type: application/json; charset=utf-8");
        $id = json_decode(file_get_contents("php://input"), true);

        if (!empty($id)){

            $id_img = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($id['id_img'])));    

            $consulta_delete = mysqli_query($conn, "SELECT * FROM imgs WHERE id = $id_img ");

            while($info_img = mysqli_fetch_array($consulta_delete)){
                $nombre_img = $info_img['name'];
            }

            $delete = mysqli_query($conn, "DELETE FROM imgs WHERE id = $id_img ");

            if ($delete) {
                if(file_exists("../img/login/".$nombre_img)){
                    unlink("../img/login/".$nombre_img);
                }
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