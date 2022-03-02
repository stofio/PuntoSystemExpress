<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$offer_id = $_POST['offer_id'];
$request_id = $_POST['request_id'];
$final_price_with_comm = test_input($_POST['final_price_with_comm']);
$driver_name = test_input($_POST['driver_name']);
$vehicle_num = test_input($_POST['vehicle_num']);

$final_from_time = $_POST['final_from_time'];
$final_to_time = $_POST['final_to_time'];
$from_formatted = date('Y-m-d h:i:s', strtotime($final_from_time));
$to_formatted = date('Y-m-d h:i:s', strtotime($final_to_time));

//set offer to 3 - CONFIRMED
$sql = "UPDATE offers SET offer_status = 3 WHERE offer_id = $offer_id";

if ($conn->query($sql) === TRUE) {
  echo "Offer updated successfully";
} else {
  echo "Error updating offer: " . $conn->error;
}


//set request to 4 - IN TRANSIT
$sql2 = "UPDATE requests SET 
  request_status = 4, 
  final_price_with_comm = $final_price_with_comm,
  driver_name = '$driver_name',
  vehicle_num = '$vehicle_num',
  final_from_time = '$from_formatted',
  final_to_time = '$to_formatted'
  WHERE id = $request_id";


if ($conn->query($sql2) === TRUE) {
    echo "Request updated successfully";
  } else {
    echo "Error updating request: " . $conn->error;
  }