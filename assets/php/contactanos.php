<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
    date_default_timezone_set('America/Mexico_city');
    $anio = date('Y');
    if (empty($_POST['cname'])||empty($_POST['cemail'])||empty($_POST['cmessage'])) {
        echo json_encode('vacio');
    } else {

        $correo= $_POST['cemail'];
        $nombre = $_POST['cname'];
        $mensaje = $_POST['cmessage'];
            
            
            
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
                $mail->setFrom("mensajesoftech@gmail.com", "SofTech");
                $mail->addAddress("mensajesoftech@gmail.com", "SofTech");     //Add a recipient
                $mail->addReplyTo("$correo", "$nombre");

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = "De: $nombre<$correo>";
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
                                                                                    margin-top: 0;' align='left'>Hola SofTech.</h1>
                                                                                
                                                                                <p style='box-sizing: border-box; color: #74787E; font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;' align='left'> 
                                                                                    $mensaje 
                                                                                </p>
                                                                                <p style='box-sizing: border-box; color: #74787E; font-family: Arial, Helvetica, sans-serif; font-size: 16px; line-height: 1.5em;
                                                                                    margin-top: 0;' align='left'>Gracias.
                                                                                </p>
                                        
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
                echo json_encode('error');
            }
    }
?>