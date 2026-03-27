<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

function enviarResultado($correo, $nombre, $codigo){

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'panchoandres287@gmail.com';
        $mail->Password   = 'inbw dihu twry ivon'; // tu app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remitente
        $mail->setFrom('panchoandres287@gmail.com', 'SIGMELAB');

        // Destinatario
        $mail->addAddress($correo, $nombre);

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = 'Resultado disponible';

        $mail->Body = "
            <div style='font-family: Arial; padding:20px'>
                <h2 style='color:#0d6efd;'>SIGMELAB</h2>
                <p>Hola <b>$nombre</b>,</p>
                <p>Tu resultado de laboratorio ya está disponible.</p>
                <p><strong>Código de muestra:</strong> $codigo</p>
                <p>Puedes consultarlo en el portal web.</p>
                <hr>
                <small>Este es un mensaje automático.</small>
            </div>
        ";

        $mail->send();

    } catch (Exception $e) {
        // opcional: log de error
    }
}