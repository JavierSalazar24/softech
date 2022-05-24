<?php
  session_start();

  if(isset($_SESSION['admin'])||isset($_SESSION['admin-publicaciones'])||isset($_SESSION['usuarioblog'])){
      header("Location: ./");
  }else{

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" href="./assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet preload" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title> Recuperar contraseña | SofTech </title>
    <style>
        ::-webkit-scrollbar {
        width: 10px;
        }
        ::-webkit-scrollbar-track {
        border-radius: 2px;
        }
        ::-webkit-scrollbar-thumb {
        background: #034975;
        border-radius: 2px;
        }
        ::-webkit-scrollbar-thumb:hover {
        background: #033250;
        }
        .mens {
            box-shadow: 5px 5px 10px 6px rgba(0, 0, 0, 0.068);
            border-radius: 8px;
            margin: auto;
        }
        
        .mens__descripcion{
            font-family: sans-serif;
            width: 80%;
            margin: auto;
            text-align: justify;
        }

        .desaparecer{
            display: none
        }

        .recu {
            box-shadow: 5px 5px 10px 6px rgba(0, 0, 0, 0.068);
            border-radius: 8px;
            width: 80%;
            margin: auto;
        }

        .formulario {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .container {
            margin-top: 100px;
        }

        .form-control:focus {
            border-color: #0367A6;
            box-shadow: none;
            background: transparent;
        }

        .descripcion{
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>    
    <div class="container">
        <div class="row recu mt-5 pt-5 mb-5 pb-5">
            <div class="col">
                <h3 class="text-center">Recuperar contraseña</h3>
                <div id="maquina">
                    <p class="text-center">Ingrese su correo electrónico y le enviaremos un email para confirmar su recuperación</p>
                </div>
                <span class="descripcion"></span>

                <div class="mt-3 pt-3 text-center">
                    <a href="./" title="Volver al inicio"> <img src="./assets/img/logo.png" width='30%' alt="Logo de la empresa"> </a>
                </div>
                <form id="form_recuperar" autocomplete="off">
                    <div class="form-group mt-5 formulario">
                        <div class="col-12 col-md-6 mb-3">
                            <input type="email" title="Completa este campo / example@gmail.com" class="text-center form-control form-control-lg" placeholder="Ingresa tu correo electrónico" name="correo" id="correo" autocomplete="off" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3 mt-2">
                            <button id="btnEnviar" type="submit" class="btnEnviar btn btn-block btn-outline-primary" title="Envíar correo">Enviar</button>
                        </div>
                    </div>
                </form>
                <div class="text-center">
                    <a href="./" title="Ir a iniciar sesión">Iniciar sesión</a>
                </div>
            </div>
        </div>
        <div class="row desaparecer mens mt-5 pt-5 mb-5 pb-5">
            <div class="col">
                <h3 class="text-center">Recuperar contraseña</h3>
                <div class="mt-3 pt-3 text-center">
                    <a href="./" title="Volver al inicio"> <img src="./assets/img/logo.png" width='25%' alt="Logo de la empresa"> </a>
                </div>
                <div class="mens__descripcion mt-5">
                    <p>Dirigase a su correo electrónico. Se le envío un mensaje de verificación para que pueda cambiar su contraseña.</p>
                    <p>Al darle click al link enviado, deberá crear una nueva contraseña y confirmarla, después se le reedirigirá al inicio de sesión para que pueda entrar a su cuenta con su nueva contraseña.</p>
                </div>                
            </div>
        </div>
    </div>

    <!-- SweetAlert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10" async></script>
    <!-- Efecto maquina de escribir -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11" async></script>
    <script src="./assets/js/password.js" async></script>
    <script src="./assets/js/maquina.js" async></script>
    <!-- Script bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous" async></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous" async></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous" async></script>
</body>

</html>

<?php
  }
?>