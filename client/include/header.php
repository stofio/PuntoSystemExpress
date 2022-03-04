<?php 
/**
 * CLIENT header
 */
require_once 'include/auth.php';  

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
		

    <title><?php echo $page_title; ?> - PuntoSystem Client</title>
  </head>
  <body>
 
 
	
	<header class="container py-3 border-bottom">
		<div class="d-flex flex-wrap justify-content-center align-items-center">
			<a href="/" class="logo d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
				<img src="/media/logo.png" />
			</a>

			<ul class="nav">
				<li class="nav-item"><a href="/client" class="nav-link" aria-current="page">Dashboard</a></li>
				<li class="nav-item"><a href="/client/new-request" class="nav-link">New shipment</a></li>
				<li class="nav-item"><a href="/client/my-requests" class="nav-link">My quotes</a></li>
				<li class="nav-item"><a href="/client/archived" class="nav-link">Archive</a></li>
				<li class="nav-item"><a href="/client/account" class="nav-link">My account</a></li>
				<li class="nav-item"><a href="/logout" class="nav-link">Log out</a></li>
			</ul>
		</div>
	</header>

	<script src="js/header.js"></script>


	

	