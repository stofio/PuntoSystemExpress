<?php

    session_start();
    include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

    $userid = $_SESSION['user_id'];
    $code = $_POST['code'];
    $percent = $_POST['percent'];
    $reqId = $_SESSION["last_request_id"];

    //check if user already used the discount
    $discountUsed = mysqli_query($conn, "SELECT * FROM user_discounts WHERE useridfk='$userid' and disc_code='$code'");
    if(mysqli_num_rows($discountUsed) > 0){
        return;    
    }
    else {
        $sql = "INSERT INTO user_discounts (useridfk, requestidfk, disc_code, disc_percent)
        VALUES ('$userid', '$reqId', '$code', '$percent')";
    
    
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

 
?>