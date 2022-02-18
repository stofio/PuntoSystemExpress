<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';

//return false if wrong email or passw

if ((!empty($_POST['username'])&&(!empty($_POST['password'])))) {

    $username = test_input($_POST['username']);
    $password = md5(test_input($_POST['password']));

    $query = "SELECT * FROM `users` WHERE email='$username' and password='".$password."'";

    $result = mysqli_query($conn,$query);
    $rows = mysqli_num_rows($result);

    //exist
    if($rows==1) {
      
      $user = mysqli_fetch_array($result);

      $id = $user['userid']; 
      $role = $user['roleidfk']; 

      if($role == 1) { // SUPPLIER - 1 
        $_SESSION['user_id'] = $id;
        $_SESSION['role_id'] = $role;        
        echo 1;
      }
      else if($role == 2) { // CLIENT - 2 
        $_SESSION['user_id'] = $id;
        $_SESSION['role_id'] = $role;        
        echo 2;
      }
      else if($role == 3) { // ADMIN - 3
        $_SESSION['user_id'] = $id;
        $_SESSION['role_id'] = $role;        
        echo 3;
      }
      
    } 
    else {
      echo 0;
    }
}
else {
  echo 'Username or password cant be empty';
}

?>