<?php

  session_start();

  if(isset($_SESSION['admin'])||isset($_SESSION['admin-publicaciones'])||isset($_SESSION['usuarioblog'])){
      header("Location: ./");
  }else{

    if(isset($_COOKIE['token'])){

        if(!empty($_SESSION['token'])){

            $token = $_SESSION['token'];

            include './assets/php/conn.php';

            $consulta_users = mysqli_query($conn, "SELECT * FROM users WHERE token = '$token'");
            $validacion_users = mysqli_num_rows($consulta_users);

            $consulta_authors = mysqli_query($conn, "SELECT * FROM authors WHERE token = '$token'");
            $validacion_authors = mysqli_num_rows($consulta_authors);

            if($validacion_users > 0 || $validacion_authors > 0){

                if ($validacion_users > 0){
                    while($datos = mysqli_fetch_array($consulta_authors)){
                        $correo = $datos['email'];
                    }
                }else if ($validacion_authors > 0){
                    while($datos = mysqli_fetch_array($consulta_authors)){
                        $correo = $datos['email'];
                    }
                }

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="./assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet preload" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet preload" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="./assets/css/estilos_nuevapass.css">
    <title> &#128187; Nueva contraseña | SofTech &#128187; </title>
</head>

<body>
    <div class="container">
        <div class="row mt-5 pt-5 mb-5 pb-5">
            <div class="col">
                <h3 class="text-center">Actualizar contraseña</h3>
                <div id="maquina">
                    <p class="text-center">Ingrese su nueva contraseña, verifíquela y guardela.</p>
                </div>
                <span class="descripcion"></span>

                <div class="mt-3 pt-3 text-center">
                    <a href="./" title="Ir al inicio"> <img src="./assets/img/logo.png" width="30%" alt="Logo de la empresa"> </a>
                </div>
                <form id="form_nuevaPass" autocomplete="off">
                    <div class="form-group mt-5 formulario">
                        <div class="col-12 col-md-6 mb-3 input-group">
                            <input type="password" minlength="8" title="Completa este campo / Mínimo 8 carácteres" class="clave text-center form-control form-control-lg" placeholder="Ingresa tu nueva contraseña" name="pass" id="pass" autocomplete="off" required>
                            <div class="divOjo input-group-text" title="Mostrar contraseña"><button type="button" class="icono fas fa-eye mostrarClave"></button></div>
                        </div>
                        <div id="password_input" class="col-12 col-md-6 mb-3 input-group">
                            <div class="input_boton">
                                <input type="password" minlength="8" title="Completa este campo / Mínimo 8 carácteres" class="clave text-center form-control form-control-lg" placeholder="Confirma tu nueva contraseña" name="conf_pass" id="conf_pass" autocomplete="off" required>
                                <div class="divOjo input-group-text" title="Mostrar contraseña"><button type="button" class="icono2 fas fa-eye mostrarClave"></button></div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mb-3 mt-2">
                            <button type="submit" id="btnGuardar" class="btnEnviar btn btn-block btn-outline-primary" title="Enviar nueva contraseña">Guardar</button>
                        </div>

                        <input type="hidden" name="correo" value="<?php echo $correo ?>">
                    </div>
                </form>
                <div class="text-center">
                    <a href="./login" title="Ir a iniciar sesión">Iniciar sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10" async></script>
    <!-- Efecto maquina de escribir -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11" async></script>
    <script type="text/javascript" src="./assets/js/password_strength.js"></script>
    <script src="./assets/js/password.js"></script>
    <!-- Script bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous" async></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" async></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous" async></script>
    <script> document.oncontextmenu = function () { return false }
    </script>
</body>

</html>

<?php
                }else{
                    header("Location: ./login");
                }
            }else{
                header("Location: ./login");
            }
        }else{
            header("Location: ./login");            
        }
    }
?>