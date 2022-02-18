<?php
/** save account data CLIENT */

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userId = $_SESSION['user_id'];


$name = $_POST['name'];
$surname = $_POST['surname'];
$company_name = $_POST['company_name'];
$contact_email = $_POST['contact_email'];
$login_email = $_POST['email'];
$phone = $_POST['phone'];
$def_load_place = $_POST['def_load_place'];
$def_deliv_place = $_POST['def_deliv_place'];

$sql = "UPDATE users SET 
name='$name',
surname='$surname',
company_name='$company_name',
contact_email='$contact_email',
email='$login_email',
phone='$phone',
def_loading_place='$def_load_place',
def_disch_place='$def_deliv_place'
WHERE userid=$userId";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  header('Location: /client/account');
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?>