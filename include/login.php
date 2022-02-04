<?php

include 'functions.php'; 

if(isset($_POST['login'])):
  if ((!empty($_POST['username'])&&(!empty($_POST['password']))))
  {
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
          header("Location: /supplier");
        }
        else if($role == 2) { // CLIENT - 2 
          $_SESSION['user_id'] = $id;
          $_SESSION['role_id'] = $role;
          header("Location: /client");
        }
        
      } 
      else {
        echo "<div class='form'>
        <h3>Username/password is incorrect.</h3>
        <br/>Click here to <a href='/'>Login</a></div>";
      }

  }
  else
  {
      echo 'Fields cannot be empty';
  }
endif; //if submit

?>