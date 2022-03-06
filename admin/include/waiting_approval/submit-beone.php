<?php

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$request_id = $_POST['request_id'];
$beone_ref = $_POST['beone_ref'];


//set request to 3 - APPROVED
$sql = "UPDATE requests SET request_status = 3, beone_ref = '$beone_ref' WHERE id = $request_id";

if ($conn->query($sql) === TRUE) {
  echo "Request updated successfully";
  /**
     * send email 
     */
    //get db data
    $reqId = $request_id;
    $beoneRef = $beone_ref;
    $sql = "SELECT * FROM `requests`
    INNER JOIN `offers` ON `requests`.`id` = `offers`.`requestidfk`
    WHERE `id` = $reqId";
    $result = mysqli_query($conn, $sql);  
    $array_termin = mysqli_fetch_assoc($result); //needed for email template
    include $_SERVER['DOCUMENT_ROOT'].'/admin/mails/mail-admin-approve/send_email_client.php';
    include $_SERVER['DOCUMENT_ROOT'].'/admin/mails/mail-admin-approve/send_email_supplier.php';
} else {
  echo "Error updating request: " . $conn->error;
}


?>