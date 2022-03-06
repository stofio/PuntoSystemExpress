<?php
//email new request

require_once $_SERVER['DOCUMENT_ROOT'] . '/mail/mail_settings.php';

include_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userId = $_SESSION['user_id'];



/**
 * template ($array_termin near inclusion)
 */
$template = file_get_contents( __DIR__ . '/tmp_supplier.html');  
foreach($array_termin as $row => $value){
    $template = str_replace('{{ '.$row.' }}', $value, $template);
}

//additional templating
$actionButtonLink = "https://express.puntosystemgroup.com/supplier/active";
$buttonText = "MAKE YOUR OFFER";
$template = str_replace('{{ action_btn_link }}', $actionButtonLink, $template);
$template = str_replace('{{ button_text }}', $buttonText, $template);



/**
 * send email
 */
$to = "stofio@live.com"; //supplier emails

//get all supplier emails and send to all
// $sql2 = "SELECT email, contact_email FROM `users` WHERE `users`.`roleidfk` = 1";
// $result2 = mysqli_query($conn, $sql2);  
// while ($user = mysqli_fetch_array($result2)) {
    //     $to = $user['contact_email'] == "" ? $user['email'] : $user['contact_email'];
    //     sendEmail($to, $subject, $content);
    // }


    $subject = "New request of shipment ID #" . $reqId;
    $content = $template;

//TEST EMAIL
sendEmail($to, $subject, $content);

?>