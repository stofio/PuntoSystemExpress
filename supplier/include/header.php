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
		

    <title><?php echo $page_title; ?> - PuntoSystem Support</title>
  </head>
  <body>


	
	<header class="container py-3 mb-4 border-bottom">
		<div class="d-flex flex-wrap justify-content-center align-items-center">
			<a href="/" class="logo d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
				<img src="/media/logo.png" />
			</a>

			<ul class="nav">
				<li class="nav-item"><a href="/supplier" class="nav-link" aria-current="page">Dashboard</a></li>
				<li class="nav-item"><a href="/supplier/today" class="nav-link">Today Requests</a></li>
				<li class="nav-item"><a href="/supplier/offers" class="nav-link">My Offers</a></li>
				<li class="nav-item"><a href="/supplier/shipped" class="nav-link">Shipped</a></li>
				<li class="nav-item"><a href="/supplier/logout" class="nav-link">Log out</a></li>
				<li class="nav-account"><a href="/supplier/account"><img src="/media/account-icon.svg"/></a></li>
			</ul>
		</div>
	</header>


	<div class="container main-wrap">

	