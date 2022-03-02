<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

var_dump($_FILES);

$reqId = $_POST['request_id'];

//files
$files_names_array = array();
$upload_dir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
$allowed_types = array('jpg', 'png', 'jpeg', 'gif', 'pdf', 'xml', 'doc', 'docx', 'zip', 'rar');
$maxsize = 50 * 1024 * 1024; //50 MiB

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
$pod = serialize($files_names_array); //serialized array images


//set request as COMPLETED - 6
$sql = "UPDATE requests SET 
        request_status = 9,
        POD = '$pod'
        WHERE id = $reqId";


if ($conn->query($sql) === TRUE) {
  echo "Offer updated successfully";
} else {
  echo "Error updating offer: " . $conn->error;
}



?>