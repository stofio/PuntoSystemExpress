<?php
//email new request

require_once $_SERVER['DOCUMENT_ROOT'] . '/mail/mail_settings.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';



/**
 * template ($array_termin near inclusion)
 */ 
$template = file_get_contents( __DIR__ . '/tmp_admin.html');  
foreach($requestAndOffer as $row => $value){
    $template = str_replace('{{ '.$row.' }}', $value, $template);
}


/**
 * send email
 */
$to = $AdminEmail; //client email

$subject = "Shipping completed #" . $reqId;
$content = $template;

sendEmail($to, $subject, $content);

?>