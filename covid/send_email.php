<?php
session_start();
$email = $_SESSION['email'];

// echo $email;

$name = "onTime";
// $email = "sonivivek050@gmail.com";
$subject = "invoice";
$message = "Hi, Your Booking Has Been Confirmed !!!";

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->port = 587;

$mail->Username = "1js20cs185@gmail.com";
$mail->Password = "domiacfwclyltczm";

$mail->setFrom($email, $name);
$mail->addAddress("$email", "vivek");

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();
// echo"email sent";
header('location: /covid/bill_pdf.php');


?>