<?php
    
    echo "<link rel='icon' href='../img/favicon.png' type='image/x-icon'>";

    // Inicializar la sesión.
    // Si está usando session_name("algo"), ¡no lo olvide ahora!
    session_start();    

    // Destruir todas las variables de sesión.
    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finalmente, destruir la sesión.
    session_destroy();

    echo "<script>
                setTimeout(cargaAlertaCerrarSesion, 500);
                function cargaAlertaCerrarSesion(){
                    AlertaCerrarSesion();
                }
            </script>";    

    echo "<script>
                setTimeout(ReedireccionLogin, 1700);
                function ReedireccionLogin(){
                    location.href = '../../login';
                }
            </script>";

    echo "<script src='//cdn.jsdelivr.net/npm/sweetalert2@10'></script>";
    echo "<script src='../js/sweetalert.js'></script>";

?>