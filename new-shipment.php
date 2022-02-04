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
		

        <link href="/vendor/bootstrap-datetimepicker-master/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
                <button id="loginBtn" type="button">Login</button>
				<!-- <li class="nav-item"><a href="/client/my-requests" class="nav-link">Login</a></li> -->
			</ul>
		</div>
	</header>



    <section class="text-center hero-section">
        <div class="hh align-items-center">
            <div>
                <h1><b><u>New Request</u></b></h1>
                <p>Request a new quote</p>
            </div>
        </div>
    </section>


    <section id="new_request">
        <form id="new_request_form" enctype="multipart/form-data" autocomplete="off"> 
            <div class="new-request-container">

                <div class="row">
                    <div class="col-md-4">
                        <label>Name<br>
                            <input type="text" name="name" placeholder="Name" required/>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Phone number<br>
                            <input type="text" name="phone" placeholder="Name" required/>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Email address<br>
                            <input type="text" name="name" placeholder="Name" required/>
                        </label>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <label>Shipment Ref.<br>
                            <input type="text" name="shipment_ref" placeholder="Shipment Ref." required/>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Commodity<br>
                            <input type="text" name="commodity" placeholder="Commodity" required/>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Transport Requirements<br>
                            <div class="trans-req">
                                <div>
                                    <input type="checkbox" name="adr" id="adr">
                                    <label for="adr">ADR</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="temp_cont" id="temp_cont">
                                    <label for="temp_cont">Temperature Controlled</label>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <label>Country of Origin<br>
                            <select name="from_place" class="request_from" required>
                                <optgroup label="EU" class="request_from_eu_group"></optgroup>
                            </select>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Loading place<br>
                            <input type="text" name="loading_point" placeholder="Loading place" required/>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Cargo available from<br>
                            <input type="text" name="from_time" class="request_available_from" placeholder="Cargo available from" required/>
                        </label>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-4">
                        <label>To<br>
                            <select name="to_place" class="request_to" required>
                                <optgroup label="EU" class="request_to_eu_group"></optgroup>
                                <optgroup label="extra-EU" class="request_to_non_eu_group"></optgroup>
                            </select>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Delivery place<br>
                            <input type="text" name="discharge_point" placeholder="Delivery place" required/>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Requested delivery within<br>
                            <input type="text" name="to_time" class="request_delivered_within" placeholder="Available within" required/>
                        </label>
                    </div>
                </div>

                
                <div class="col-md-12">
                    <label>Packing list
                        <div class="colli-container">
                            <div class="collo-single">
                                <span class="coll-nu">1</span>
                                <div>
                                    <label>Packaging</label><input type="text" class="packaing" placeholder="Packaging" required>
                                </div>
                                <div>
                                    <label>Weight</label><input type="text" class="collo-kg" placeholder="In KG, E.g. 350" required>
                                </div>
                                <div>
                                    <label>Lenght</label><input type="text" class="collo-l" placeholder="In m, E.g. 5" required>
                                </div>
                                <div>
                                    <label>Width</label><input type="text" class="collo-w" placeholder="In m, E.g. 1.2" required>
                                </div>
                                <div>
                                    <label>Height</label><input type="text" class="collo-h" placeholder="In m, E.g. 2.4" required>
                                </div>
                                <div>
                                    <label>Stackable</label>
                                    <input type="checkbox" name="temp_cont">
                                </div>
                            </div>
                            <span id="new-collo">+ Add new</span>
                        </div>
                    </label>
                </div>

                <div class="col-md-12">
                    <label>Note<br>
                        <textarea placeholder="Note" name="note"></textarea>
                    </label>
                </div>
                <div class="col-md-12">
                    <label>Attachments (files larger then 50MB will not be uploaded)<br>
                        <input type="file" name="files[]" id="files" multiple />
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="error-container"></div>
                    <button name="send_request" type="submit">Send request</button>
                </div>

               
            </div>
        </form>
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

<script src="/vendor/bootstrap-datetimepicker-master/bootstrap-datetimepicker.min.js"></script>

<script src="js/new-request.js"></script>

</body>
</html>
