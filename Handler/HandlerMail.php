<?php

require_once __DIR__ . '/assets/lib/vendor/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function getMailerInstance()
{
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bucignoscuola@gmail.com';
        $mail->Password = 'nhzkisndrwqnsilh';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->setFrom('bucignoscuola@gmail.com', 'Bucigno Informatica');


        return $mail;
    } catch (Exception $e) {
        return null;
    }
}
