<?php
/** save account data CLIENT */

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userId = $_SESSION['user_id'];


//get user data
$sql = "SELECT * FROM users WHERE `userid` = $userId";  
$result = mysqli_query($conn, $sql);  

$account_data = mysqli_fetch_assoc($result);



?>