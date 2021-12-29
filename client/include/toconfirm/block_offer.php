<?php

session_start();

include '../../../functions.php';

$offer_id = $_POST['offer_id'];
$request_id = $_POST['request_id'];

//set offer to 2 - BLOCKED
$sql = "UPDATE offers SET offer_status = 2 WHERE offer_id = $offer_id";

if ($conn->query($sql) === TRUE) {
  echo "Offer updated successfully";
} else {
  echo "Error updating offer: " . $conn->error;
}


//set request to 3 - TOSHIP
$sql2 = "UPDATE requests SET request_status = 3 WHERE id = $request_id";

if ($conn->query($sql2) === TRUE) {
    echo "Request updated successfully";
  } else {
    echo "Error updating request: " . $conn->error;
  }