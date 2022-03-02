<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$request_id = $_GET['reqId'];


//set request as DELIVERED - 5
$sql = "UPDATE requests SET request_status = 5 WHERE id = $request_id";


if ($conn->query($sql) === TRUE) {
  echo "Offer updated successfully";
} else {
  echo "Error updating offer: " . $conn->error;
}



?>