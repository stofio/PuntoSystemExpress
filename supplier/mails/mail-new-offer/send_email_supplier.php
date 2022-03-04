<?php
//email new request

require_once $_SERVER['DOCUMENT_ROOT'] . '/mail/mail_settings.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userId = $array_termin['offer_useridfk'];

//get supplier email
$sql2 = "SELECT email, contact_email FROM `users` WHERE `users`.`userid` = $userId";
$result2 = mysqli_query($conn, $sql2);  
$supplier = mysqli_fetch_assoc($result2);

/**
 * template
 */ 
$template = file_get_contents( __DIR__ . '/tmp_supplier.html');  
foreach($array_termin as $row => $value){
    $template = str_replace('{{ '.$row.' }}', $value, $template);
}

/**
 * send email
 */
$to = $supplier['contact_email'] == "" ? $supplier['email'] : $supplier['contact_email']; //supplier email
$subject = "New offer for ID #" . $reqId;
$content = $template;

sendEmail($to, $subject, $content);

?>