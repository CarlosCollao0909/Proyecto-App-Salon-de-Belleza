<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    public $email;
    public $nombre;
    public $token;

    public function __construct($nombre, $email, $token) {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function sendConfirmation() {
        //Crear el objeto de phpmailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        //contenido HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333333; max-width: 600px; margin: 0 auto; padding: 20px;'>";
        $contenido .= "<div style='background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);'>";
        $contenido .= "<h1 style='color: #4a90e2; margin-bottom: 20px; text-align: center;'>Salón de Belleza LIZMAR</h1>";
        $contenido .= "<p style='margin-bottom: 15px;'><strong style='text-transform: capitalize'>Hola " . strtolower($this->nombre) . "</strong></p>";
        $contenido .= "<p style='margin-bottom: 15px;'>Has creado tu cuenta en el Salon de belleza LIZMAR, solo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p style='text-align: center; margin: 30px 0;'>";
        $contenido .= "<a href='". $_ENV['APP_URL'] . "/confirm-account?token=" . $this->token . "' style='background-color: #4a90e2; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;'>Confirmar Cuenta</a>";
        $contenido .= "</p>";
        $contenido .= "<p style='color: #666666; font-size: 0.9em; margin-top: 30px;'>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= "</div>";
        $contenido .= "</body>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        $mail->send();
    }

    public function sendInstructions() {
        //Crear el objeto de phpmailer
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Restablece tu contraseña';

        //contenido HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333333; max-width: 600px; margin: 0 auto; padding: 20px;'>";
        $contenido .= "<div style='background-color: #ffffff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1);'>";
        $contenido .= "<h1 style='color: #4a90e2; margin-bottom: 20px; text-align: center;'>Salón de Belleza LIZMAR</h1>";
        $contenido .= "<p style='margin-bottom: 15px;'><strong style='text-transform: capitalize'>Hola " . strtolower($this->nombre) . "</strong></p>";
        $contenido .= "<p style='margin-bottom: 15px;'>Has solicitado restablecer tu contraseña, sigue el siguiente enlace</p>";
        $contenido .= "<p style='text-align: center; margin: 30px 0;'>";
        $contenido .= "<a href='" . $_ENV['APP_URL'] . "/reset-password?token=" . $this->token . "' style='background-color: #4a90e2; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;'>Restablecer Contraseña</a>";
        $contenido .= "</p>";
        $contenido .= "<p style='color: #666666; font-size: 0.9em; margin-top: 30px;'>Si tu no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .= "</div>";
        $contenido .= "</body>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        $mail->send();
    }
}