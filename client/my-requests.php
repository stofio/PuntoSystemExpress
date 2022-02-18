<?php $page_title = 'My Quotes'; ?>
<?php require_once 'include/header.php'; ?>
 
    <section class="text-center hero-section"> 
        <div class="breadcrumbs container">
            <span><a href="/client">Client dashboard</a></span> » 
            <span><?php echo $page_title; ?></span>
        </div>
        <div class="row align-items-center">
            <div>
                <h1><?php echo $page_title; ?></h1>
                <p>Discover your request history</p>
            </div>
        </div>
    </section>

<div class="container main-wrap tabs-container">
 
    <div class="tab">
        <button id="liveTabBtn" class="tablinks active" onclick="openTab(event, 'liveReq')">PROCESSING</button><!--
    --><button class="tablinks" onclick="openTab(event, 'toConfReq')">BOOKED</button><!--
    --><button class="tablinks" onclick="openTab(event, 'toShipReq')">IN TRANSIT</button>
    </div>

    <!--    
         LIVE tab
    -->
    <section id="liveReq" class="tabcontent" style="display: block;">

        <div id="target-content">loading...</div>

        <div class="clearfix">
            <ul class="pagination"> <?php include 'include/live/pagination.php'; ?> </ul>
        </div>

    </section>


    <!--    
         TO CONFIRM tab
    -->
    <section id="toConfReq" class="tabcontent">

        <div id="target-content2">loading...</div>

        <div class="clearfix">
            <ul class="pagination"> <?php include 'include/toconfirm/pagination.php'; ?> </ul>
        </div>

    </section>
 

    <!--    
         TO SHIP tab
    -->
    <section id="toShipReq" class="tabcontent"> 

        <div id="target-content3">loading...</div>

        <div class="clearfix">
            <ul class="pagination"> <?php include 'include/toship/pagination.php'; ?> </ul>
        </div>
        
    </section>



</div> <!-- container -->
    

<script src="/client/js/my-requests.js"></script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  