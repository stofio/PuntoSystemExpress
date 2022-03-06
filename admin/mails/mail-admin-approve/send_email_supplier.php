<?php
//email new request

require_once $_SERVER['DOCUMENT_ROOT'] . '/mail/mail_settings.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';


/**
 * template ($array_termin near inclusion)
 */
$template = file_get_contents( __DIR__ . '/tmp_supplier.html');  
foreach($array_termin as $row => $value){
    $template = str_replace('{{ '.$row.' }}', $value, $template);
}

$template = str_replace('{{ beone }}', $beoneRef, $template);

//get supplier email
$sql2 = "SELECT email, contact_email FROM `users`
INNER JOIN `offers` ON `users`.`userid` = `offers`.`offer_useridfk`
AND `offers`.`requestidfk` = " . $array_termin['useridfk'];
$result2 = mysqli_query($conn, $sql2);  
$userSupplier = mysqli_fetch_assoc($result2);


/**
 * send email
 */
$to = $userSupplier['contact_email'] == "" ? $userSupplier['email'] : $userSupplier['contact_email']; 

$subject = "Admin approved request ID #" . $reqId;
$content = $template;

sendEmail($to, $subject, $content, $ccArray);

?>