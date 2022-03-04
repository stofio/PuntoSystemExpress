<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require $_SERVER['DOCUMENT_ROOT'].'/mail/PHPMailer/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'].'/mail/PHPMailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/mail/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 2;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "ssl";
$mail->Port       = 465;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "dev.test.dejan@gmail.com";
$mail->Password   = "qmcbrnbedwifplya"; // google App Password


$mail->IsHTML(true);
$mail->SetFrom("dev.test.dejan@gmail.com", "Punto System Express");
$mail->AddAddress("stofio@live.com");
//$mail->AddReplyTo("dev.test.dejan@gmail.com", "reply-to-name");
//$mail->AddCC("stofio@gmail.com", "cc-recipient-name");
$mail->Subject = "Test Email Gmail SMTP Server - PHP Mailer";
$content = "<b>Content of the test email.</b>";

$mail->MsgHTML($content); 
if(!$mail->Send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
  echo "Email sent successfully";
}


?>