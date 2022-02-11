<?php
session_start();
include 'functions.php'; 


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

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    	<!-- Google Font Montserrat -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

      <link href="/style.css" rel="stylesheet">

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
		

    <title>Punto System Express</title>

    <style>

    </style>


  </head>
  <body>

  <header class="container py-3 border-bottom">
		<div class="d-flex flex-wrap justify-content-center align-items-center">
			<a href="/" class="logo d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
				<img src="/media/logo.png" />
			</a>

			<ul class="nav">
				<li class="nav-item"><a href="/" class="nav-link" aria-current="page">Home</a></li>
				<li class="nav-item"><a href="/new-shipment" class="nav-link">New Shipment</a></li>
                <button id="loginBtn" type="button" data-toggle="modal" data-target="#loginModalHeader">Login</button>
			</ul>
		</div>
	</header>



    <!-- login popup -->
    <div class="modal fade login-modal" id="loginModalHeader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            
                <div class="modal-body">
                    <div class="form-title text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <form method="post">
                            <div class="form-group">
                            <input type="email" name="username" placeholder="Your email address..." required>
                            </div>
                            <div class="form-group">
                            <input type="password" name="password" placeholder="Your password..." required>
                            </div>
                            <div class="error-container-login-head mt-3"></div>
                            <button name="login" type="submit">Login</button>
                        </form>
                    </div>            
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="signup-section">Not registered yet? 
                        <a href="mailto:info@puntosystemgroup.com"> Request an account</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="js/header.js"></script>