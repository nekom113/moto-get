<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.mail.ru'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'oldridgebarnes@mail.ru'; //SMTP username
    $mail->Password = 'jTJPhG5f6Q7UrgmVpc0A'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('oldridgebarnes@mail.ru', 'Oldridge Barnes');
    $mail->addAddress('oldridgebarnes@mail.ru', 'Oldridge Barnes');
    // $mail->addAddress('Info@oldridgebarnes.ru', 'Info');
    // $mail->addAddress('ygontar@oldridgebarnes.ru', 'Гонтарь Юрий Станиславович'); 

    //Content
    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];
    //format to HTML
    $mail->Body =
        '<p> <b>ФИО:</b> ' .
        $_POST['fullname'] .
        '<br/> <b>Email:</b> ' .
        $_POST['email'] .
        '<br/><b>Телефон:</b> ' .
        $_POST['phone'] .
        '<br/><b>Компания:</b> ' .
        $_POST['company'] . // Добавляем информацию о компании
        '<br/><b>Сообщение:</b> ' .
        $_POST['message'] .
        '<br/></p>';

    //format without HTML
    $mail->AltBody =
        'ФИО: ' .
        $_POST['fullname'] .
        ' Email: ' .
        $_POST['email'] .
        ' Телефон: ' .
        $_POST['phone'] .
        ' Компания: ' .
        $_POST['company'] . // Добавляем информацию о компании
        ' Сообщение: ' .
        $_POST['message'];
    $mail->CharSet = 'utf-8';
    $mail->send();
    echo 'OK';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
