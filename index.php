<?php
session_start();

if(isset($_SESSION["role_id"])):
  if($_SESSION["role_id"] == 1) { //if supplier
    header("Location: /supplier");
  }
  else if($_SESSION["role_id"] == 2) { //if client
    header("Location: /client");
  }
endif;

/**
 * Login
 */
include 'include/login.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Login - Punto System Express</title>

    <style>

    section#login {
      height: 60vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    #login form {
      display: flex;
      flex-direction: column;
    }

    #login button {
      outline: none;
      border: none;
      width: 100%;
      height: 60px;
      background-color: #E6342A;
      color: #fff;
      font-weight: bold;
      margin-top: 10px;
    }

    #login button:hover {
      box-shadow: 0px 3px 6px 1px rgba(0, 0, 0, 0.36);
    }

    #login input {
      border: 1px solid #343434;
  color: #212529;
  height: 50px;
  border-radius: 0;
  padding-left: 8px;
  margin-top: 6px;
    }


    </style>
  </head>
  <body>

  <section id="login" class="container text-center">
    <img class="mb-2" src="/media/logo.png" width="160" />
    <h1 class="mb-4" style="text-align:center"><u>EXPRESS</u></h1>
    <form class="border border-light" method="post" autocomplete="off">
        <input class="mb-2" type="text" name="username" placeholder="Email" autocomplete="off" required>
        <input class="mb-2" type="password" name="password" placeholder="Password" autocomplete="off" required>
        <button type="submit" name="login">Login</button>
    </form>
  </section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
