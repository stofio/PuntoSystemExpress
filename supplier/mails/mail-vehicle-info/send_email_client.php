<?php
//email new request

require_once $_SERVER['DOCUMENT_ROOT'] . '/mail/mail_settings.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';


//get client email
$sql2 = "SELECT * FROM `users` 
            INNER JOIN `requests` on `users`.`userid` = `requests`.`useridfk` WHERE `id`= " . $reqId;
$result2 = mysqli_query($conn, $sql2);  
$requestAndClient = mysqli_fetch_assoc($result2);

/**
 * template ($array_termin near inclusion)
 */ 
$template = file_get_contents( __DIR__ . '/tmp_client.html');  
foreach($array_termin as $row => $value){
    $template = str_replace('{{ '.$row.' }}', $value, $template);
}
foreach($requestAndClient as $row => $value){
    $template = str_replace('{{ '.$row.' }}', $value, $template);
}

$priceCommission = getClientCommissionsCalculated($array_termin['price'], $array_termin["id"]);
$template = str_replace('{{ price_with_commission }}', $priceCommission, $template);


/**
 * send email
 */
$to = $requestAndClient['contact_email'] == "" ? $requestAndClient['email'] : $requestAndClient['contact_email']; //client email

$subject = "Vehicle in transit ID #" . $reqId;
$content = $template;

sendEmail($to, $subject, $content);

?>