<?php

session_start();

include '../../../functions.php';

$offer_id = $_POST['offer_id'];
$request_id = $_POST['request_id'];

//set offer to 3 - SHIPPED
$sql = "UPDATE offers SET offer_status = 3 WHERE offer_id = $offer_id";

if ($conn->query($sql) === TRUE) {
  echo "Offer updated successfully";
} else {
  echo "Error updating offer: " . $conn->error;
}


//set request to 4 - SHIPPED
$sql2 = "UPDATE requests SET request_status = 4 WHERE id = $request_id";

if ($conn->query($sql2) === TRUE) {
    echo "Request updated successfully";
  } else {
    echo "Error updating request: " . $conn->error;
  }