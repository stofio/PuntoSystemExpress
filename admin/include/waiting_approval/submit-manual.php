<?php

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$request_id = $_POST['request_id'];


//set request to 3 - APPROVED
$sql = "UPDATE requests SET request_status = 0 WHERE id = $request_id";

if ($conn->query($sql) === TRUE) {
  echo "Request updated successfully";
} else {
  echo "Error updating request: " . $conn->error;
}


?>