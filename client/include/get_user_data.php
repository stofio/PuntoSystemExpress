<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userid = $_SESSION['user_id'];

$sql = "SELECT * from users WHERE userid = $userid";
$result = mysqli_query($conn, $sql);

$userData = mysqli_fetch_assoc($result);

echo json_encode($userData);


?>