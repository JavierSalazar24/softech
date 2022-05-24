<?php

session_start();
if (isset($_SESSION['admin'])) {
    include "conn.php";
    header("Content-type: application/json; charset=utf-8");
    $id = json_decode(file_get_contents("php://input"), true);

    if (!empty($id)){

        $id_post = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($id['id_post'])));    

        $consulta_delete = mysqli_query($conn, "SELECT * FROM posts WHERE id = $id_post ");    
        $result = mysqli_fetch_array($consulta_delete);

        $delete = mysqli_query($conn, "DELETE FROM posts WHERE id = $id_post ");
    
        if ($delete) {
            if(file_exists("../img/posts/".$result['multimedia'])){
                unlink("../img/posts/".$result['multimedia']);
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