<?php
/**
 * SWITCH EMAIL ON/OFF
 */
define('EMAILS_ACTIVATED', true);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require $_SERVER['DOCUMENT_ROOT'].'/mail/PHPMailer/src/Exception.php';
require $_SERVER['DOCUMENT_ROOT'].'/mail/PHPMailer/src/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'].'/mail/PHPMailer/src/SMTP.php';


//GLOBALS
$AdminEmail = 'sales@puntosystemgroup.com'; //sales@puntosystemgroup.com
//$ccAdminEmail = [];
$ccAdminEmail = ["nicholas.schibuola@puntosystemgroup.com"];

/**
 * $to - email
 * $subject - text
 * $content - text
 * $ccArary - array (email=>name)
 */
function sendEmail($to, $subject, $content, $ccArray = null, $attachment = '') {
    if(!EMAILS_ACTIVATED) return;

    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->IsSMTP();
    $mail->Mailer = "smtp";

    $mail->SMTPDebug  = 2;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "ssl";
    $mail->Port       = 465;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "puntosystemexpress@gmail.com";
    $mail->Password   = "ookylxsyngyyoxqp"; // google App Password
    //ookylxsyngyyoxqp



    $mail->IsHTML(true);
    $mail->SetFrom("puntosystemexpress@gmail.com", "Punto System Express"); 
    // puntosystemexpress@gmail.com

    $mail->AddAddress($to);

    if(isset($ccArray)):
        foreach($ccArray as $email) {
            $mail->AddCC($email);
        }
    endif;
    //$mail->AddReplyTo("dev.test.dejan@gmail.com", "reply-to-name");
    //$mail->AddCC("stofio@gmail.com", "cc-recipient-name");

    $mail->Subject = $subject;
    $content = $content;

    if($attachment !== '') {
        $mail->addAttachment($_SERVER['DOCUMENT_ROOT']."/pdfSaved/".$attachment);
    }

    $mail->MsgHTML($content); 
    if(!$mail->Send()) {
    echo "Error while sending Email.";
    var_dump($mail);
    } else {
    echo "Email sent successfully";
    }
}

?>