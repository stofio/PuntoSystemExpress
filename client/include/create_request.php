<?php

    session_start();

    include '../../functions.php';

    //include_once 'email_new_request.php';

    $colli = $_POST['colli'];

    echo $colli; 

    echo $_POST;

    return;


    $userid = $_SESSION['user_id'];
    $title = test_input($_POST['title']);
    $from_time = test_input($_POST['from_time']);
    $to_time = test_input($_POST['to_time']);
    $valid_until = test_input($_POST['valid_until']);
    $from_place = test_input($_POST['from_place']);
    $to_place = test_input($_POST['to_place']);
    $note = test_input($_POST['note']);
    $files_names_array = array();

    //files
    $upload_dir = '../uploads/';
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'xml', 'doc', 'docx', 'zip', 'rar');
    $maxsize = 50 * 1024 * 1024; //50 MiB

    //validate
    if(
        (empty($title))or
        (empty($from_time))or
        (empty($to_time))or 
        (empty($valid_until))or
        (empty($from_place))or
        (empty($to_place))
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

    //set request status to LIVE - 1
    //save data to db
    $attach = serialize($files_names_array); //serialized array
    $created = date('Y-m-d h:i:s', time());

    $from_formatted = date('Y-m-d h:i:s', strtotime($from_time));
    $to_formatted = date('Y-m-d h:i:s', strtotime($to_time));
    $expire_formatted = date('Y-m-d h:i:s', strtotime($valid_until));

    $sql = "INSERT INTO requests (useridfk, request_status, title, from_place, to_place, from_time, to_time, valid_until, note, attachments, created)
    VALUES ('$userid', '1', '$title', '$from_place', '$to_place', '$from_formatted', '$to_formatted', '$expire_formatted', '$note', '$attach', '$created')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
        /**
         * send email to all clients
         */
        //sendEmailNewRequest();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
 
?>