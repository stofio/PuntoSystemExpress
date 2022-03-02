<?php $page_title = 'My Offers'; ?>
<?php require_once 'include/header.php'; ?>

 
    <section class="text-center hero-section">
        <div class="breadcrumbs container">
            <span><a href="/supplier">Supplier dashboard</a></span> » 
            <span><?php echo $page_title; ?></span>
        </div>
        <div class="align-items-center">
            <div>
                <h1><?php echo $page_title; ?></h1>
                <p>Discover your active offers</p>
            </div>
        </div>
    </section>

<div class="container main-wrap tabs-container">

    <div class="tab">
        <button id="liveTabBtn" class="tablinks active" onclick="openTab(event, 'liveReq')">PROCESSING</button><!--
        --><button class="tablinks" onclick="openTab(event, 'toShipReq')">TO SHIP</button><!--
        --><button class="tablinks" onclick="openTab(event, 'goingReq')">IN TRANSIT</button><!--
        <button class="tablinks" onclick="openTab(event, 'endedReq')">ENDED</button>-->
    </div>


    <!--    
         LIVE tab
    -->
    <section id="liveReq" class="tabcontent" style="display: block;">

        <div id="target-content">loading...</div>

        <div class="clearfix">
            <ul class="pagination"> <?php include 'include/live_requests/pagination.php'; ?> </ul>
        </div>

    </section>


    <!--    
         TO SHIP tab
    -->
    <section id="toShipReq" class="tabcontent">

        <div id="target-content2">loading...</div>

        <div class="clearfix">
            <ul class="pagination"> <?php include 'include/toship_requests/pagination.php'; ?> </ul>
        </div>

    </section>


    <!--    
         IN TRANSIT tab
    -->
    <section id="goingReq" class="tabcontent">

        <div id="target-content4">loading...</div>

        <div class="clearfix">
            <ul class="pagination"> <?php include 'include/intransit/pagination.php'; ?> </ul>
        </div>

<!-- 
        <div class="single-order">
            <div class="single-order-header">
                <div class="header-details">
                    <h2 class="order-title">Spedizione Express #01135</h2>
                    <div class="order-details">
                        <p><b>From</b> Antwerp, BE</p>
                        <p><b>To</b> Turin, IT</p>
                        <p><b>Available from</b> 31/12/2021 18:00</p>
                        <p><b>Delivered within</b> 01/01/2022 09:00</p>
                        <p>Offer Available Untill 29/12/2021</p>
                        <p><b>Name</b> Nome</p>
                        <p><b>Email</b> Cognome</p>
                        <p><b>Phone</b> 000-000</p>
                    </div>
                </div>
                <div class="header-controls">
                    <span class="order-status">ONGOING</span>
                    <a href="mailto:123@123.com">
                        <button type="button">Send email</button>
                    </a>
                </div>
            </div>
            <div class="live_request single-order-body">
                <div class="single-offer">
                    <div class="offer-type">
                        <span>MY OFFER</span>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br>31/12/2021 18:30</p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br>31/12/2021 18:30</p>
                    </div>
                    <div class="offer-price">
                        <h4>€ 781,90</h4>
                    </div>
                    <div class="offer-conclude">
                        <button class="sped_ritirata" type="button" style="float:right">Shipping withdrawn</button>
                        <form class="conclude_form" enctype="multipart/form-data" autocomplete="off">
                            <button class="sped_conclude" type="submit" style="float:right">Shipment completed</button><br>
                            <label>Attached photo proof <br>
                                <input type="file" name="files[]" id="files" multiple />
                            </label>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->

    </section>


    <!--    
         ENDED tab
    -->
    <!-- <section id="endedReq" class="tabcontent"> 

        <div id="target-content3">loading...</div>

        <div class="clearfix">
            <ul class="pagination"> <?php //include 'include/ended_requests/pagination.php'; ?> </ul>
        </div>

    </section> -->


  
</div> <!-- container -->

    <script src="/supplier/js/offers.js"></script>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>