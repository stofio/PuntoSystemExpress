<?php
//email new request

require_once $_SERVER['DOCUMENT_ROOT'] . '/mail/mail_settings.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';


/**
 * template ($array_termin near inclusion)
 */
$template = file_get_contents( __DIR__ . '/tmp_client.html');  
foreach($array_termin as $row => $value){
    $template = str_replace('{{ '.$row.' }}', $value, $template);
}

$priceCommission = getClientCommissionsCalculated($array_termin["price"], $array_termin["id"]);
$template = str_replace('{{ price_with_commission }}', $priceCommission, $template);

$template = str_replace('{{ beone }}', $beoneRef, $template);

//get client email
$sql4 = "SELECT email, contact_email FROM `users` WHERE `userid` = " . $array_termin['useridfk'];
$result4 = mysqli_query($conn, $sql4);  
$userClient = mysqli_fetch_assoc($result4);


/**
 * send email
 */
$to = $userClient['contact_email'] == "" ? $userClient['email'] : $userClient['contact_email']; 


$subject = "Admin approved request ID #" . $reqId;
$content = $template;

sendEmail($to, $subject, $content);

?>