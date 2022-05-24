<?php

    session_start();

    //Sacar sistema operativo
    $user_agent_SO = $_SERVER['HTTP_USER_AGENT'];
    function getPlatform($user_agent_SO) {
        $plataformas = array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );
        foreach($plataformas as $plataforma=>$valor){
            if (preg_match($plataforma, $user_agent_SO))
                return $valor;
        }
        return 'Sistema operativo no identificado';
    }

    $SO = getPlatform($user_agent_SO);

    //Sacar navegador
    $user_agent_navegador = $_SERVER['HTTP_USER_AGENT'];
    function getNavegador($user_agent_navegador) {
        $navegadores = array(
            '/msie/i'      => 'Internet Explorer',
            '/firefox/i'   => 'Firefox',
            '/chrome/i'    => 'Chrome',
            '/safari/i'    => 'Safari',
            '/edge/i'      => 'Edge',
            '/opera/i'     => 'Opera',
            '/netscape/i'  => 'Netscape',
            '/maxthon/i'   => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i'    => 'Handheld Browser'
        );
        foreach($navegadores as $navegador=>$valueNav){
            if (preg_match($navegador, $user_agent_navegador))
                return $valueNav;
        }
        return 'Navegador no identificado';
    }

    $browser = getNavegador($user_agent_navegador);

    include 'conn.php';
    date_default_timezone_set('America/Mexico_city');
    $anio = date('Y');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    if (empty($_POST['correo'])) {
        echo json_encode('vacio');
    } else {

        $destino = $_POST['correo'];

        $consulta_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$destino'");
        $validacion_users = mysqli_num_rows($consulta_users);

        $consulta_authors = mysqli_query($conn, "SELECT * FROM authors WHERE email = '$destino'");
        $validacion_authors = mysqli_num_rows($consulta_authors);

        // echo $validacion_authors;

        if($validacion_users > 0){

            while($datos = mysqli_fetch_array($consulta_users)){
                $toke = $datos['token'];
                $nombres = $datos['name'];
                $apellidos = $datos['last_name'];
            }
            
            $mail = new PHPMailer;
            $mail -> CharSet = "UTF-8";
            try {
                //Server settings
                $mail->isSMTP();                                                //Send using SMTP
                $mail->SMTPDebug  =   0;                                        //Enable verbose debug output
                $mail->Host       =   'smtp.gmail.com';                         //Set the SMTP server to send through
                $mail->Port       =   465;                                      //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->SMTPSecure =   'ssl';                                    //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->SMTPAuth   =   true;                                     //Enable SMTP authentication
                $mail->Username   =   "mensajesoftech@gmail.com";                //SMTP username
                $mail->Password   =   "softech2022";                      //SMTP password
    
                //Recipients
                $mail->setFrom('mensajesoftech@gmail.com', 'SofTech');
                $mail->addAddress("$destino", "$nombres $apellidos");           //Add a recipient                
    
                //Content
                $mail->isHTML(true);                                            //Set email format to HTML
                $mail->Subject = 'Recuperación de contraseña - SofTech';
                $mail->Body    = "<!DOCTYPE html>
                                    <html lang='es'>

                                        <head>
                                            <link rel='icon' href='../img/favicon.png' type='image/x-icon'>
                                            <meta name='viewport' content='width=device-width, initial-scale=1.0' />
                                            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                                            <title>Restablecer contraseña | SofTech</title>
                                            <style type='text/css'>
                                                body {
                                                    width: 100% !important;
                                                    height: 100%;
                                                    margin: 0;
                                                    line-height: 1.4;
                                                    background-color: #F2F4F6;
                                                    color: #74787E;
                                                    -webkit-text-size-adjust: none;
                                                }
                                        
                                                @media only screen and (max-width: 600px) {
                                                    .email-body_inner {
                                                        width: 100% !important;
                                                    }
                                        
                                                    .email-footer {
                                                        width: 100% !important;
                                                    }
                                                }
                                        
                                                @media only screen and (max-width: 500px) {
                                                    .button {
                                                        width: 100% !important;
                                                    }
                                                }
                                        
                                                .ancla-softtech:hover {
                                                    text-decoration: underline !important;
                                                }
                                        
                                                .ancla-recuperar:hover {
                                                    background-color: #0367A6  !important;
                                                    border-color: #0367A6  !important;
                                                }
                                            </style>
                                        
                                        </head>

                                        <body>
                                            <table class='email-wrapper' width='100%' cellpadding='0' cellspacing='0' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 0; padding:
                                                0; width: 100%; background-color:#F2F4F6'>
                                                <tr>
                                                    <td align=' center'
                                                        style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; word-break: break-word;'>
                                                        <table class='email-content' width='100%' cellpadding='0' cellspacing='0' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin:
                                                            0; padding: 0; width: 100%;'>
                                                            <tr>
                                                                <td class='email-masthead'
                                                                    style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; padding: 25px 0; word-break: break-word;'
                                                                    align='center'>
                                                                    <a class='ancla-softtech' href='https://softech.cesenas.com/'
                                                                        class='email-masthead_name' style='box-sizing: border-box; color: #bbbfc3; font-family: Arial, Helvetica, sans-serif; font-size: 16px; font-weight: bold; text-decoration: none;
                                                                        text-shadow: 0 1px 0 white;'>
                                                                        SofTech
                                                                    </a>
                                                                </td>
                                                            </tr>
                                        
                                                            <tr>
                                                                <td class='email-body' width='100%' cellpadding='0' cellspacing='0' style='-premailer-cellpadding: 0; -premailer-cellspacing: 0; border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; width: 100%; word-break:
                                                                    break-word;' bgcolor='#FFFFFF'>
                                                                    <table class='email-body_inner' align='center' width='570' cellpadding='0' cellspacing='0'
                                                                        style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 0 auto; padding: 0; width: 570px;'
                                                                        bgcolor='#FFFFFF'>
                                        
                                                                        <tr>
                                                                            <td class='content-cell'
                                                                                style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; padding: 35px; word-break: break-word;'>
                                                                                <h1 style='box-sizing: border-box; color: #2F3133; font-family: Arial, Helvetica, sans-serif; font-size: 19px; font-weight: bold;
                                                                                    margin-top: 0;' align='left'>Hola $nombres $apellidos.</h1>
                                                                                <p style='box-sizing: border-box; color: #74787E; font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 1.5em;
                                                                                    margin-top: 0;' align='left'>Recientemente solicitó restablecer su
                                                                                    contraseña para su cuenta
                                                                                    en SofTech. Use el botón de abajo para cambiarla.
                                                                                </p>
                                        
                                                                                <table class='body-action' align='center' width='100%' cellpadding='0'
                                                                                    cellspacing='0' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 30px auto; padding: 0;
                                                                                    text-align: center; width: 100%;'>
                                                                                    <tr>
                                                                                        <td align='center'
                                                                                            style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; word-break: break-word;'>
                                        
                                                                                            <table width='100%' border='0' cellspacing='0' cellpadding='0'
                                                                                                style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif;'>
                                                                                                <tr>
                                                                                                    <td align='center' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; word-break:
                                                                                                        break-word;'>
                                                                                                        <table border='0' cellspacing='0' cellpadding='0'
                                                                                                            style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif;'>
                                                                                                            <tr>
                                                                                                                <td style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif;
                                                                                                                    word-break: break-word;'>
                                                                                                                    <a class='ancla-recuperar'
                                                                                                                        href='https://softech.cesenas.com/nueva_password'
                                                                                                                        class='button button--green'
                                                                                                                        target='_blank' style='-webkit-text-size-adjust: none; background: #5CB6F9; border-color: #5CB6F9; border-radius: 3px; border-style: solid; border-width: 10px 18px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); box-sizing: border-box; color: #FFF; display: inline-block; font-family: Arial, Helvetica, sans-serif;
                                                                                                                        text-decoration: none;'>Restablecer
                                                                                                                        contraseña</a>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <p style='box-sizing: border-box; color: #74787E; font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 1.5em;
                                                                                    margin-top: 0;' align='left'> Por razones de seguridad, le comentamos que esta solicitud se
                                                                                    recibió de un
                                                                                    dispositivo $SO usando el navegador $browser. Si no solicitó
                                                                                    restablecer la contraseña, ignore este correo electrónico o póngase en
                                                                                    contacto con el servicio de asistencia si tiene alguna pregunta.<br/>Si sí fue usted, tiene 10 minutos para restablecerla, si se pasa el tiempo limite, tendrá que volver a solicitar el restabelecimiento de su contraseña.</p>      
                                                                                <p style='box-sizing: border-box; color: #74787E; font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 1.5em;
                                                                                    margin-top: 0;' align='left'>Gracias.
                                                                                    <br />Equipo de SofTech
                                                                                </p>
                                        
                                                                                <table class='body-sub' style='border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin-top: 25px; padding-top:
                                                                                    25px;'>
                                                                                    <tr>
                                                                                        <td
                                                                                            style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; word-break: break-word;'>
                                                                                            <p class='sub' style='box-sizing: border-box; color: #74787E; font-family: Arial, Helvetica, sans-serif; font-size: 12px;
                                                                                                line-height: 1.5em; margin-top: 0;' align='left'>Si tiene
                                                                                                problemas con el botón de arriba, copie y
                                                                                                pegue la siguiente URL en su navegador web o de click en el siguiente enlace.</p>
                                                                                            <p class='sub' style='box-sizing: border-box; color: #74787E; font-family: Arial, Helvetica, sans-serif; font-size: 12px;
                                                                                                line-height: 1.5em; margin-top: 0;' align='left'>
                                                                                                https://softech.cesenas.com/nueva_password
                                                                                            </p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif;
                                                                    word-break: break-word;'>
                                                                    <table class='email-footer' align='center' width='570' cellpadding='0' cellspacing='0'
                                                                        style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 0 auto; padding: 0; text-align: center; width: 570px;'>
                                                                        <tr>
                                                                            <td class='content-cell' align='center'
                                                                                style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; padding: 35px; word-break: break-word;'>
                                                                                <p class='sub align-center' style='box-sizing: border-box; color: #AEAEAE; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5em;
                                                                                    margin-top: 0;' align='center'>© $anio SofTech. Todos los derechos
                                                                                    reservados.</p>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </body>

                                    </html>";                
    
                $mail->send();

                echo json_encode("correcto");
    
            } catch (Exception $e) {
                echo ($e);
            }
        }else if ($validacion_authors > 0){
            while($datos = mysqli_fetch_array($consulta_authors)){
                $toke = $datos['token'];
                $nombres = $datos['name'];
                $apellidos = $datos['last_name'];
            }
            
            $mail = new PHPMailer;
            $mail -> CharSet = "UTF-8";
            try {
                //Server settings
                $mail->isSMTP();                                                //Send using SMTP
                $mail->SMTPDebug  =   0;                                        //Enable verbose debug output
                $mail->Host       =   'smtp.gmail.com';                         //Set the SMTP server to send through
                $mail->Port       =   465;                                      //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->SMTPSecure =   'ssl';                                    //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->SMTPAuth   =   true;                                     //Enable SMTP authentication
                $mail->Username   =   "mensajesoftech@gmail.com";                //SMTP username
                $mail->Password   =   "softech2022";                      //SMTP password
    
                //Recipients
                $mail->setFrom('mensajesoftech@gmail.com', 'SofTech');
                $mail->addAddress("$destino", "$nombres $apellidos");           //Add a recipient                
    
                //Content
                $mail->isHTML(true);                                            //Set email format to HTML
                $mail->Subject = 'Recuperación de contraseña - SofTech';
                $mail->Body    = "<!DOCTYPE html>
                                    <html lang='es'>

                                        <head>
                                            <link rel='icon' href='../img/favicon.png' type='image/x-icon'>
                                            <meta name='viewport' content='width=device-width, initial-scale=1.0' />
                                            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                                            <title>Restablecer contraseña | SofTech</title>
                                            <style type='text/css'>
                                                body {
                                                    width: 100% !important;
                                                    height: 100%;
                                                    margin: 0;
                                                    line-height: 1.4;
                                                    background-color: #F2F4F6;
                                                    color: #74787E;
                                                    -webkit-text-size-adjust: none;
                                                }
                                        
                                                @media only screen and (max-width: 600px) {
                                                    .email-body_inner {
                                                        width: 100% !important;
                                                    }
                                        
                                                    .email-footer {
                                                        width: 100% !important;
                                                    }
                                                }
                                        
                                                @media only screen and (max-width: 500px) {
                                                    .button {
                                                        width: 100% !important;
                                                    }
                                                }
                                        
                                                .ancla-softtech:hover {
                                                    text-decoration: underline !important;
                                                }
                                        
                                                .ancla-recuperar:hover {
                                                    background-color: #0367A6  !important;
                                                    border-color: #0367A6  !important;
                                                }
                                            </style>
                                        
                                        </head>

                                        <body>
                                            <table class='email-wrapper' width='100%' cellpadding='0' cellspacing='0' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 0; padding:
                                                0; width: 100%; background-color:#F2F4F6'>
                                                <tr>
                                                    <td align=' center'
                                                        style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; word-break: break-word;'>
                                                        <table class='email-content' width='100%' cellpadding='0' cellspacing='0' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin:
                                                            0; padding: 0; width: 100%;'>
                                                            <tr>
                                                                <td class='email-masthead'
                                                                    style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; padding: 25px 0; word-break: break-word;'
                                                                    align='center'>
                                                                    <a class='ancla-softtech' href='https://softech.cesenas.com/'
                                                                        class='email-masthead_name' style='box-sizing: border-box; color: #bbbfc3; font-family: Arial, Helvetica, sans-serif; font-size: 16px; font-weight: bold; text-decoration: none;
                                                                        text-shadow: 0 1px 0 white;'>
                                                                        SofTech
                                                                    </a>
                                                                </td>
                                                            </tr>
                                        
                                                            <tr>
                                                                <td class='email-body' width='100%' cellpadding='0' cellspacing='0' style='-premailer-cellpadding: 0; -premailer-cellspacing: 0; border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 0; padding: 0; width: 100%; word-break: break-word;' bgcolor='#FFFFFF'>
                                                                    <table class='email-body_inner' align='center' width='570' cellpadding='0' cellspacing='0' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 0 auto; padding: 0; width: 570px;' bgcolor='#FFFFFF'>                                
                                                                        <tr>
                                                                            <td class='content-cell' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; padding: 35px; word-break: break-word;'>
                                                                                <h1 style='box-sizing: border-box; color: #2F3133; font-family: Arial, Helvetica, sans-serif; font-size: 19px; font-weight: bold; margin-top: 0;' align='left'>Hola $nombres $apellidos.</h1>
                                                                                <p style='box-sizing: border-box; color: #74787E; font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;' align='left'>Recientemente solicitó restablecer su contraseña para su cuenta en SofTech. Use el botón de abajo para cambiarla.
                                                                                </p>                                    
                                                                                <table class='body-action' align='center' width='100%' cellpadding='0' cellspacing='0' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 30px auto; padding: 0; text-align: center; width: 100%;'>
                                                                                    <tr>
                                                                                        <td align='center'style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; word-break: break-word;'>                                    
                                                                                            <table width='100%' border='0' cellspacing='0' cellpadding='0' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif;'>
                                                                                                <tr>
                                                                                                    <td align='center' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; word-break: break-word;'>
                                                                                                        <table border='0' cellspacing='0' cellpadding='0' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif;'>
                                                                                                            <tr>
                                                                                                                <td style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; word-break: break-word;'>
                                                                                                                    <a class='ancla-recuperar' href='https://softech.cesenas.com/nueva_password' class='button button--green' target='_blank' style='-webkit-text-size-adjust: none; background: #5CB6F9; border-color: #5CB6F9; border-radius: 3px; border-style: solid; border-width: 10px 18px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); box-sizing: border-box; color: #FFF; display: inline-block; font-family: Arial, Helvetica, sans-serif; text-decoration: none;'>Restablecer contraseña</a>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                                <p style='box-sizing: border-box; color: #74787E; font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;' align='left'> Por razones de seguridad, le comentamos que esta solicitud se recibió de un dispositivo $SO usando el navegador $browser. Si no solicitó restablecer la contraseña, ignore este correo electrónico o póngase en contacto con el servicio de asistencia si tiene alguna pregunta.<br/>Si sí fue usted, tiene 10 minutos para restablecerla, si se pasa el tiempo limite, tendrá que volver a solicitar el restabelecimiento de su contraseña. </p>
                                                                                <p style='box-sizing: border-box; color: #74787E; font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;' align='left'>Gracias.
                                                                                <br />Equipo de SofTech
                                                                                </p>                                    
                                                                                <table class='body-sub' style='border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin-top: 25px; padding-top: 25px;'>
                                                                                    <tr>
                                                                                        <td style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; word-break: break-word;'>
                                                                                            <p class='sub' style='box-sizing: border-box; color: #74787E; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;' align='left'>Si tiene problemas con el botón de arriba, copie y pegue la siguiente URL en su navegador web o de click en el siguiente enlace.</p>
                                                                                            <p class='sub' style='box-sizing: border-box; color: #74787E; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;' align='left'>https://softech.cesenas.com/nueva_password</p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; word-break: break-word;'>
                                                                    <table class='email-footer' align='center' width='570' cellpadding='0' cellspacing='0' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; margin: 0 auto; padding: 0; text-align: center; width: 570px;'>
                                                                        <tr>
                                                                            <td class='content-cell' align='center' style='box-sizing: border-box; font-family: Arial, Helvetica, sans-serif; padding: 35px; word-break: break-word;'>
                                                                                <p class='sub align-center' style='box-sizing: border-box; color: #AEAEAE; font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;' align='center'>© $anio SofTech. Todos los derechos reservados.</p>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </body>

                                    </html>";
    
                $mail->send();

                echo json_encode("correcto");
    
            } catch (Exception $e) {
                echo ($e);
            }
        }else{            
            echo json_encode('error');
        }

        
        $_SESSION['token'] = $toke;

        setcookie("token", $toke, time()+600, '/', NULL, 0);

    }



?>