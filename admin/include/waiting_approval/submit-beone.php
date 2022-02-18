<?php

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$request_id = $_POST['request_id'];
$beone_ref = $_POST['beone_ref'];


//set request to 3 - APPROVED
$sql = "UPDATE requests SET request_status = 3, beone_ref = '$beone_ref' WHERE id = $request_id";

if ($conn->query($sql) === TRUE) {
  echo "Request updated successfully";
} else {
  echo "Error updating request: " . $conn->error;
}


?>