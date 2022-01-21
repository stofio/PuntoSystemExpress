<?php

include_once '../mail/mail_conn.php';

$mail->IsHTML(true);
$mail->AddAddress("dejanstofio@gmail.com", "recipient-name");
$mail->SetFrom($from, "PuntoSystemExpress");
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