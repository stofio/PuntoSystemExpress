<?php
session_start();
// if(!isset($_SESSION["role_id"])){
// header("Location: /");
// exit(); }
if(isset($_SESSION["role_id"])):
  if($_SESSION["role_id"] == 1) { //if supplier
    header("Location: /supplier");
  }
  else if($_SESSION["role_id"] == 2) { //if client
    header("Location: /client");
  }
endif;

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Home</title>
  </head>
  <body>

  <section class="container">
    <h1 class="mb-5" style="text-align:center">Login</h1>
    <form class="border border-light" method="post" autocomplete="off">
        <input type="text" name="username" placeholder="Email" autocomplete="off" required>
        <input type="password" name="password" placeholder="Password" autocomplete="off" required>
        <button type="submit" name="login">Login</button>
    </form>
    <div class="row">
      <div class="col-md-6">
        <h2><a href="/supplier">Supplier</a></h2>
      </div>
      <div class="col-md-6">
        <h2><a href="/client">Client</a></h2>
      </div>
    </div>
  </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>

<?php

include 'functions.php';
if(isset($_POST['login'])):
if ((!empty($_POST['username'])&&(!empty($_POST['password']))))
{
    $username = test_input($_POST['username']);
    $password = md5(test_input($_POST['password']));

    $query = "SELECT * FROM `users` WHERE email='$username' and passwd='".$password."'";

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
      <br/>Click here to <a href='login.php'>Login</a></div>";
	  }

}
else
{
    echo 'Unesi podatke';
}
endif; //if submit

?>