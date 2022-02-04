<?php
/*
session_start();

if(isset($_SESSION["role_id"])):
  if($_SESSION["role_id"] == 1) { //if supplier
    header("Location: /supplier");
  }
  else if($_SESSION["role_id"] == 2) { //if client
    header("Location: /client");
  }
endif; 
*/
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

  <header class="container py-3 mb-4 border-bottom">
		<div class="d-flex flex-wrap justify-content-center align-items-center">
			<a href="/" class="logo d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
				<img src="/media/logo.png" />
			</a>

			<ul class="nav">
				<li class="nav-item"><a href="/" class="nav-link" aria-current="page">Home</a></li>
				<li class="nav-item"><a href="/new-shipment" class="nav-link">New Shipment</a></li>
        <button id="loginBtn" type="button">Login</button>
				<!-- <li class="nav-item"><a href="/client/my-requests" class="nav-link">Login</a></li> -->
			</ul>
		</div>
	</header>

  <!-- <section id="login" class="container text-center">
    <form class="border border-light" method="post" autocomplete="off">
        <input class="mb-2" type="text" name="username" placeholder="Email" autocomplete="off" required>
        <input class="mb-2" type="password" name="password" placeholder="Password" autocomplete="off" required>
        <button type="submit" name="login">Login</button>
    </form>
  </section> -->


  <section class="container-fluid hero">
    <div class="row">
      <div class="col-md-6">
        <div style="background-color: #e5352a; width:500px; height: 500px"></div>
      </div>
      <div class="col-md-6 hero-right">
        <h1>Plan@Express</h1>
        <h4>Your new tool for <br>Dedicated Express Transports</h4>
        <a class="mt-3" href="/new-shipment">
          <button type="button" class="new-req-btn">Request new shipment</button>
        </a>
      </div>
    </div>
  </section>

  <section class="what-we-offer mt-5">
    <div class="container">
      <div class="row">
        <h2 class="text-center mb-5"><b><u>What we offer</u></b></h2>
        <div class="col-md-4 text-center offer-cont p-5 pt-0 pb-0 border-right">
          <h4><b>GLOBAL COVERAGE</b></h4>
          <img class="mb-3 mt-2" src="media/logo.png">
          <p>We will collect your cargo, be it standard, dangerous or temperature controlled, in 3 hours from your request, everywhere in the European Union.</p>
        </div>
        <div class="col-md-4 text-center offer-cont p-5 pt-0 pb-0 border-right">
          <h4><b>SPEED</b></h4>
          <img class="mb-3 mt-2" src="media/logo.png">
          <p>The trucks we employ have a maximum payload of 1000 kg, and they guarantee an express delivery without stops or deviations everywhere in the European Union.</p>
        </div>
        <div class="col-md-4 text-center offer-cont p-5 pt-0 pb-0">
          <h4><b>SAVINGS</b></h4>
          <img class="mb-3 mt-2" src="media/logo.png">
          <p>Whereas normal dedicated services require payment of both legs of the journey of the truck, we will charge you only the outward trip.</p>
        </div>
      </div>
    </div>
  </section>


  <section class="container-fluid pt-5 pb-5 how-it-work">
    <div class="container">
      <div class="col-md-6">
        <h2 class="mb-5"><b><u>How it works</u></b></h2>
        <ul>
          <li>Punto System provides more than 1150 trucks, ready for pick up, in all parts of the European Union. Once we have received your request, we will find the closest truck to the loading place and the shipment begins.</li>
          <li>Thanks to the payload limit of 1000 kgs, the driver can drive without stops, delivering the cargo to its destination based on the pure driving time.</li>
          <li>We will provide you the proof of delivery within 5 minutes from the unloading of the cargo.</li>
          <li>In addition, with a 48h notice: We can provide the same service also for the neighbouring states to the European Union, managing the import and export customs at the boarder as well. </li>
        </ul>
      </div>
      <div class="col-md-6"></div>
    </div>
  </section>


  <footer class="mt-5 pt-5 pb-5">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h2 class="mb-4">Discover what else Punto System can do for you</h2>
          <p>
          Headquarters <br>
          Via Meloni di Quartirolo, 8 <br>
          41012 Carpi (MO) Italy <br>
          Tel: +39 (059) 63.22.511 <br>
          E-mail: sales@puntosystemgroup.com <br>
          <a href="https://puntosystemgroup.com/">www.puntosystemgroup.com</a>
          </p>
        </div>
        <div class="col-md-4 footer-right">
          <img class="mb-5 mt-2" src="media/logo.png" width="200">
          <div class="social d-flex justify-content-end">
            <a href="#">
              <img src="media/logo.png" />
            </a>
            <a href="#">
              <img src="media/logo.png" />
            </a>
            <a href="#">
              <img src="media/logo.png" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </footer>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
