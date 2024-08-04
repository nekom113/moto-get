<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';


// Получение данных
$json = file_get_contents('php://input'); // Получение json строки
$data = json_decode($json, true); // Преобразование json

// Данные
$name = $data['name'];
$tel = $data['tel'];
$promoCode = $data['promoCode'];
$msg = $data['message'];

// Контент письма
$title = 'Заявка с сайта www.motodc.ru'; // Название письма
$body = '<p><strong>Имя:</strong> '.$name.'</p>'.
        '<p><strong>Телефон:</strong> '.$tel.'</p>'.
        '<p><strong>Промокод: </strong>'.$promoCode.'</p>'.
        '<p><strong>Сообщение: </strong>'.$msg.'</p>';


// Настройки PHPMailer

$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.mail.ru'; //Set the SMTP server to send through
    $mail->CharSet = 'UTF-8';
    $mail->SMTPAuth = true; //Enable SMTP authentication

     // Настройки почты отправителя
    $mail->Username = 'myjob2021@internet.ru'; //SMTP username
    $mail->Password = '5Hd1iMCYijgWFech03TP'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('myjob2021@internet.ru', 'Письмо с сайта www.motodc.ru');// Адрес самой почты и имя отправителя
    $mail->addAddress('nekom113@mail.ru', 'Получение');// Адрес почты и имя получателя
    $mail->addAddress('piontek.job@internet.ru', 'Получение');// Адрес 2щпочты и имя получателя

  // Отправка сообщения
  $mail->isHTML(true);
  $mail->Subject = $title;
  $mail->Body = $body;

  $mail->send('d');

  // Сообщение об успешной отправке
  echo ('Сообщение отправлено успешно!');


} catch (Exception $e) {
    header('HTTP/1.1 400 Bad Request');
    echo('Сообщение не было отправлено! Причина ошибки: {$mail->ErrorInfo}');
}
