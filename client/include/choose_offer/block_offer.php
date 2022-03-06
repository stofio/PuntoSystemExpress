<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$offer_id = $_POST['offer_id'];
$request_id = $_POST['request_id'];

//set offer to 2 - BLOCKED
$sql = "UPDATE offers SET offer_status = 2 WHERE offer_id = $offer_id";

if ($conn->query($sql) === TRUE) {
  echo "Offer updated successfully";
} else {
  echo "Error updating offer: " . $conn->error;
}
 

//set request to 2 - BOOKED
$sql2 = "UPDATE requests SET request_status = 2 WHERE id = $request_id";
echo $sql2;

 
if ($conn->query($sql2) === TRUE) {
    echo "Request updated successfully";
    /**
     * send email 
     */
    //get db data
    $reqId = $request_id;
    $offerId = $offer_id;
    $sql = "SELECT * FROM `requests` INNER JOIN `offers`
                ON `requests`.`id` = `offers`.`requestidfk`
                WHERE `requests`.`id` = $reqId AND `offers`.`offer_id` = $offerId";
    $result = mysqli_query($conn, $sql);  
    $array_termin = mysqli_fetch_assoc($result); //needed for email template
    include $_SERVER['DOCUMENT_ROOT'].'/client/mails/mail-client-block-offer/send_email_admin.php';
    include $_SERVER['DOCUMENT_ROOT'].'/client/mails/mail-client-block-offer/send_email_client.php';

  } else {
    echo "Error updating request: " . $conn->error;
  }