<?php
//email new request

require_once $_SERVER['DOCUMENT_ROOT'] . '/mail/mail_settings.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';


//get supplier email
$sql4 = "SELECT email, contact_email FROM `users` WHERE `userid` = " . $requestAndOffer['offer_useridfk'];
$result4 = mysqli_query($conn, $sql4);  
$supplier = mysqli_fetch_assoc($result4);


/**
 * template ($array_termin near inclusion)
 */ 
$template = file_get_contents( __DIR__ . '/tmp_supplier.html');  
foreach($requestAndOffer as $row => $value){
    $template = str_replace('{{ '.$row.' }}', $value, $template);
}


/**
 * send email
 */
$to = $supplier['contact_email'] == "" ? $supplier['email'] : $supplier['contact_email']; //client email

$subject = "Shipping completed #" . $reqId;
$content = $template;

sendEmail($to, $subject, $content);

?>