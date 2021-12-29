<?php

session_start();

include '../../../functions.php';

$todeleteId = $_POST['id'];

$sql = "DELETE FROM requests WHERE id=$todeleteId";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}