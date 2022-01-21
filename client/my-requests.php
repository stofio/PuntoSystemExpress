<?php $page_title = 'My Requests'; ?>
<?php require_once 'include/header.php'; ?>

 
    <section class="text-center hero-section">
        <div class="breadcrumbs">
            <span><a href="/client">Client dashboard</a></span> » 
            <span><?php echo $page_title; ?></span>
        </div>
        <div class="row align-items-center">
            <div>
                <h1><?php echo $page_title; ?></h1>
                <p>Discover your currently active requests</p>
            </div>
        </div>
    </section>

    <div class="tab">
        <button id="liveTabBtn" class="tablinks active" onclick="openTab(event, 'liveReq')">LIVE</button><!--
    --><button class="tablinks" onclick="openTab(event, 'toConfReq')">TO CONFIRM</button><!--
    --><button class="tablinks" onclick="openTab(event, 'toShipReq')">TO SHIP</button>
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



    <script src="/client/js/my-requests.js"></script>

<?php require_once 'include/footer.php'; ?> 