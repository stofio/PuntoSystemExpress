<?php

    session_start();

    include $_SERVER['DOCUMENT_ROOT'].'/functions.php';


    $userid = $_SESSION['user_id'];
    $request_id = $_POST['request_id'];
    $good_delivery = test_input($_POST['good_delivery']);
    $good_collection = test_input($_POST['good_collection']);
    $offer_price = test_input($_POST['offer_price']);
    $offer_active_until = test_input($_POST['offer_active_until']);
    $note = test_input($_POST['note']);
    $files_names_array = array();

    //files
    $upload_dir = '../../uploads/';
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'xml', 'doc', 'docx', 'zip', 'rar');
    $maxsize = 50 * 1024 * 1024; //50 MiB

    //validate
    if(
        (empty($request_id))or
        (empty($good_delivery))or
        (empty($good_collection))or
        (empty($offer_price))
    ) {
    //missing fields
        echo 'Missing required fields';
        return 0;
    }

    //upload files and get names
    if(!empty(array_filter($_FILES['files']['name']))) {

        // Loop through each file in files[] array
        foreach ($_FILES['files']['tmp_name'] as $key => $value) {
                
            $file_tmpname = $_FILES['files']['tmp_name'][$key];
            $file_name = $_FILES['files']['name'][$key];
            $file_size = $_FILES['files']['size'][$key];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);

            // Set upload file path
            $filepath = $upload_dir.$file_name;

            // Check file type is allowed or not
            if(in_array(strtolower($file_ext), $allowed_types)) {

                // Verify file size 
                if ($file_size > $maxsize)     
                    echo "Error: File size is larger than the allowed limit.";

                // If file with name already exist then append time in
                // front of name of the file to avoid overwriting of file
                if(file_exists($filepath)) {
                    $filenamewithtime = time().$file_name;
                    $filepath = $upload_dir.$filenamewithtime;
                        
                    if( move_uploaded_file($file_tmpname, $filepath)) {
                        array_push($files_names_array, $filenamewithtime);
                        echo "{$file_name} successfully uploaded <br />";
                    }
                    else {                    
                        echo "Error uploading {$file_name} <br />";
                    }
                }
                else {
                    if( move_uploaded_file($file_tmpname, $filepath)) {
                        array_push($files_names_array, $file_name);
                        echo "{$file_name} successfully uploaded <br />";
                    }
                    else {                    
                        echo "Error uploading {$file_name} <br />";
                    }
                }
            } 
            else {
                // If file extension not valid
                echo "Error uploading {$file_name} ";
                echo "({$file_ext} file type is not allowed)<br / >";
            }
        }
    }

    //status of the shipping request is LIVE - 1
    //save data to db
    $attach = serialize($files_names_array); //serialized array
    $created = date('Y-m-d h:i:s', time());

    $from_formatted = date('Y-m-d h:i:s', strtotime($good_collection));
    $to_formatted = date('Y-m-d h:i:s', strtotime($good_delivery));
    $valid_formatted = date('Y-m-d h:i:s', strtotime($offer_active_until));

    $sql = "INSERT INTO offers (offer_useridfk, requestidfk, offer_status, collect_time, deliver_time, valid_until, price, offer_note, offer_attachments, offer_created)
    VALUES ('$userid', '$request_id', '1', '$from_formatted', '$to_formatted', '$valid_formatted', '$offer_price', '$note', '$attach', '$created')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully <br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


    //mark request as TOCONFIRM
    $sql2 = "SELECT COUNT(offer_id) FROM offers WHERE `requestidfk` = $request_id";
    $sql2result = mysqli_query($conn, $sql2);
    $sql2rows = mysqli_fetch_row($sql2result)[0];  
    
    //if there are 3 or more offers
    if($sql2rows >= 3) {
        //mark request as TOCONFIRM
        $sql3 = "UPDATE requests SET request_status= 2 WHERE id = $request_id";
        if(mysqli_query($conn, $sql3)) {
            echo "Updated request TOCONFIRM <br>";
        }
    }


 
?>