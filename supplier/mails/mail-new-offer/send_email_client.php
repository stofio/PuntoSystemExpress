<?php
//email new request

require_once $_SERVER['DOCUMENT_ROOT'] . '/mail/mail_settings.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userId = $array_termin['useridfk'];

//get client email
$sql2 = "SELECT email, contact_email FROM `users` WHERE `users`.`userid` = $userId";
$result2 = mysqli_query($conn, $sql2);  
$client = mysqli_fetch_assoc($result2);

/**
 * template
 */ 
$template = file_get_contents( __DIR__ . '/tmp_client.html');  
foreach($array_termin as $row => $value){
    $template = str_replace('{{ '.$row.' }}', $value, $template);
}

$priceCommission = getClientCommissionsCalculated($array_termin['price'], $array_termin["id"]);
$template = str_replace('{{ price_with_commission }}', $priceCommission, $template);


/**
 * send email
 */
$to = $client['contact_email'] == "" ? $client['email'] : $client['contact_email']; //client email
$subject = "New offer for ID #" . $reqId;
$content = $template;

sendEmail($to, $subject, $content);

?>