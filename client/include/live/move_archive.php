<?php

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$reqId = $_POST['reqId'];

//set to archived 
$sql = "UPDATE requests SET request_status = 9 WHERE id = $reqId";


if ($conn->query($sql) === TRUE) {
    echo "Request updated successfully";
  } else {
    echo "Error updating request: " . $conn->error;
  }



?>