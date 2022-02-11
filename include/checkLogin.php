<?php
session_start();

require $_SERVER['DOCUMENT_ROOT'].'/functions.php';

//return false if wrong email or passw

if ((!empty($_POST['usernameCheck'])&&(!empty($_POST['passwordCheck'])))) {

  $username = test_input($_POST['usernameCheck']);
  $password = md5(test_input($_POST['passwordCheck']));

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
      echo 0;
      //NOT A CLIENT
    }
    else if($role == 2) { // CLIENT - 2 
      $_SESSION['user_id'] = $id;
      $_SESSION['role_id'] = $role;
      echo 1;
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