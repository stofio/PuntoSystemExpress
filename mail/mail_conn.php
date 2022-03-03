<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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
$mail->Password   = "qmcbrnbedwifplya";


$mail->IsHTML(true);
$mail->AddAddress("stofio@live.com", "recipient-name");
$mail->SetFrom("dev.test.dejan@gmail.com", "from-name");
$mail->AddReplyTo("sghefio@live.com", "reply-to-name");
$mail->AddCC("sghefio@live.com", "cc-recipient-name");
$mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
$content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";

$mail->MsgHTML($content); 
if(!$mail->Send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
  echo "Email sent successfully";
}




?>