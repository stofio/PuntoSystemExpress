<?php

$userid = $_SESSION['user_id'];

$theQuoteId = $quoteId; //passed near inclusion of this file


$sql = "SELECT * FROM requests WHERE `id` = $theQuoteId AND `useridfk` = $userid AND `request_status` = 1"; 

//if is already set then nothing
if ($result = mysqli_query($conn, $sql)) {
    // Fetch one and one row
    while ($row = mysqli_fetch_row($result)) {
      printf ("%s (%s)\n", $row[0], $row[2]);
    }
    // $row = mysqli_fetch_row($result);
    // printf ("%s (%s)\n", $row[0], $row[1]);
    mysqli_free_result($result);
}


?>