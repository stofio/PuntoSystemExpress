<?php

session_start();


include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$commid = $_POST['commid'];
$userid = $_POST['userid'];
$min_commission = $_POST['min_commission'];
$mol_percent = $_POST['mol_percent'];

//update commission
if($commid == null) {
    $sql = "REPLACE into commissions (userid_FK, min_commission, mol_percent) 
    values($userid, $min_commission, $mol_percent)
    ";
}
else {
    $sql = "REPLACE into commissions (commid, userid_FK, min_commission, mol_percent) 
    values($commid, $userid, $min_commission, $mol_percent)
    ";
}


if ($conn->query($sql) === TRUE) {
  echo "Offer updated successfully";
} else {
  echo "Error updating offer: " . $conn->error;
}
