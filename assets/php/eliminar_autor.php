<?php

session_start();
if (isset($_SESSION['admin'])) {
    include "conn.php";
    header("Content-type: application/json; charset=utf-8");
    $id = json_decode(file_get_contents("php://input"), true);
    error_reporting(0);

    if (!empty($id)){

        $id_autor = mysqli_real_escape_string($conn, preg_replace("/[[:space:]]/"," ",trim($id['id_autor'])));    

        $consulta_delete = mysqli_query($conn, "SELECT * FROM authors WHERE id = $id_autor ");    
        $result = mysqli_fetch_array($consulta_delete);
        
        $delete = mysqli_query($conn, "DELETE FROM authors WHERE id = $id_autor ");
        if ($delete) {
            if(file_exists("../img/authors/".$result['picture'])){
                if($result['picture'] != 'unknown.png' || $result['picture'] != 'unknownM.png'){
                    unlink("../img/authors/".$result['picture']);
                }
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