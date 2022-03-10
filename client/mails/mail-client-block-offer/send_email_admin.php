<?php
//email new request

require_once $_SERVER['DOCUMENT_ROOT'] . '/mail/mail_settings.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';


/**
 * template ($array_termin near inclusion)
 */
$template = file_get_contents( __DIR__ . '/tmp_admin.html');  
foreach($array_termin as $row => $value){
    $template = str_replace('{{ '.$row.' }}', $value, $template);
}

$priceCommission = getClientCommissionsCalculated($array_termin['price'], $array_termin["id"]);
$template = str_replace('{{ price_with_commission }}', $priceCommission, $template);

//create pdf admin
include $_SERVER['DOCUMENT_ROOT'] . '/client/include/pdfs/create_admin_pdf.php';
$pdfName = $PdfName;

/**
 * send email
 */
$to = $AdminEmail; //admin email
$ccArray = $ccAdminEmail;

$subject = "New Custom Offer Received ID #" . $reqId;
$content = $template;

sendEmail($to, $subject, $content, $ccArray, $pdfName);

?>