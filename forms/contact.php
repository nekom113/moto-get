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
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.mail.ru'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'myjob2021@internet.ru'; //SMTP username
    $mail->Password = '5Hd1iMCYijgWFech03TP'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    // $mail->setFrom('myjob2021@internet.ru', 'Михаил Мотоподбор');
    $mail->addAddress('nekom113@mail.ru', 'Просто Мотоподбор');




    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = $_POST['subject'];
    $mail->Body =
        '<p> <b>Имя:</b> ' .
        $_POST['name'] .
        '<br/> <b>Email:</b> ' .
        $_POST['email'] .
        '<br/><b>Сообщение:</b> ' .
        $_POST['message'] .
        '<br/></p>';

    $mail->AltBody =
        'Имя: ' .
        $_POST['name'] .
        ' Email: ' .
        $_POST['email'] .
        'Сообщение: ' .
        $_POST['message'] .
        '';
    $mail->CharSet = 'utf-8';
    $mail->send();
    echo 'OK';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
/**
 * Requires the "PHP Email Form" library
 * The "PHP Email Form" library is available only in the pro version of the template
 * The library should be uploaded to: vendor/php-email-form/php-email-form.php
 * For more info and help: https://bootstrapmade.com/php-email-form/
 */

// Replace contact@example.com with your real receiving email address
// $receiving_email_address = 'oldridgebarnes@mail.ru';

// if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
//   include( $php_email_form );
// } else {
//   die( 'Unable to load the "PHP Email Form" Library!');
// }

// $contact = new PHP_Email_Form;
// $contact->ajax = true;

// $contact->to = $receiving_email_address;
// $contact->from_name = $_POST['name'];
// $contact->from_email = $_POST['email'];
// $contact->subject = $_POST['subject'];
// $subject = $_POST['subject'];

// Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials

// $contact->smtp = array(
//   'host' => 'example.com',
//   'username' => 'example',
//   'password' => 'pass',
//   'port' => '587'
// );

// $contact->add_message( $_POST['name'], 'From');
// $contact->add_message( $_POST['email'], 'Email');
// $contact->add_message( $_POST['message'], 'Message', 10);
// $msg = $_POST['message'];
// echo $contact->send();
// mail($receiving_email_address,$subject,$msg);
