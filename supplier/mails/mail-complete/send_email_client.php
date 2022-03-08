<?php
//email new request

require_once $_SERVER['DOCUMENT_ROOT'] . '/mail/mail_settings.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';


//get client email
$sql3 = "SELECT email, contact_email FROM `users` WHERE `userid` = " . $requestAndOffer['useridfk'];
$result3 = mysqli_query($conn, $sql3);  
$client = mysqli_fetch_assoc($result3);


/**
 * template ($array_termin near inclusion)
 */ 
$template = file_get_contents( __DIR__ . '/tmp_client.html');  
foreach($requestAndOffer as $row => $value){
    $template = str_replace('{{ '.$row.' }}', $value, $template);
}


/**
 * send email
 */
$to = $client['contact_email'] == "" ? $client['email'] : $client['contact_email']; //client email

$subject = "Shipping completed #" . $reqId;
$content = $template;

sendEmail($to, $subject, $content);

?>