<?php
//email new request

require_once $_SERVER['DOCUMENT_ROOT'] . '/mail/mail_settings.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';


/**
 * template
 */
$template = file_get_contents( __DIR__ . '/tmp_admin.html');  
foreach($array_termin as $row => $value){
    $template = str_replace('{{ '.$row.' }}', $value, $template);
}


/**
 * send email
 */
$to = "dejanstofio@gmail.com"; //admin email
//$to = "enquiries@puntosystemgroup.com"; //admin email
$subject = "New request of shipment ID #" . $reqId;
$content = $template;
$ccArray = ["nicholas.schibuola@puntosystemgroup.com"];

//sendEmail($to, $subject, $content, );
sendEmail($to, $subject, $content, $ccArray);

?>