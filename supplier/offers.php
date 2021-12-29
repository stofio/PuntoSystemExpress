<?php $page_title = 'My Offers'; ?>
<?php require_once 'include/header.php'; ?>

 
    <section class="text-center hero-section">
        <div class="breadcrumbs">
            <span><a href="/supplier">Supplier dashboard</a></span> » 
            <span><?php echo $page_title; ?></span>
        </div>
        <div class="row align-items-center">
            <div>
                <h1><?php echo $page_title; ?></h1>
                <p>Discover your active offers</p>
            </div>
        </div>
    </section>

   

    <div class="tab">
        <button id="liveTabBtn" class="tablinks active" onclick="openTab(event, 'liveReq')">LIVE</button><!--
        --><button class="tablinks" onclick="openTab(event, 'toShipReq')">TO SHIP</button><!--
        --><button class="tablinks" onclick="openTab(event, 'endedReq')">ENDED</button>
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
         ENDED tab
    -->
    <section id="endedReq" class="tabcontent">

        <div id="target-content3">loading...</div>

        <div class="clearfix">
            <ul class="pagination"> <?php include 'include/ended_requests/pagination.php'; ?> </ul>
        </div>

        <!-- <div class="single-order">
            <div class="single-order-header">
                <div class="header-details">
                    <h2 class="order-title">Spedizione Express #01135</h2>
                    <div class="order-details">
                        <p><b>From</b> Antwerp, BE</p>
                        <p><b>To</b> Turin, IT</p>
                        <p><b>Available from</b> 31/12/2021 18:00</p>
                        <p><b>Delivered within</b> 01/01/2022 09:00</p>
                        <p>Offer Available Untill 29/12/2021</p>
                    </div>
                </div>
                <div class="header-controls">
                    <span class="order-status">ENDED</span>
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
                </div>
            </div>
        </div> -->

    </section>


  



    <script src="/supplier/js/offers.js"></script>

<?php require_once 'include/footer.php'; ?>