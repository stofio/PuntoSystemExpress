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