<?php $page_title = 'Active Requests'; ?>
<?php require_once 'include/header.php'; ?>

<link href="/vendor/bootstrap-datetimepicker-master/bootstrap-datetimepicker.min.css" rel="stylesheet">


    <section class="text-center hero-section">
        <div class="breadcrumbs container"> 
            <span><a href="/supplier">Supplier dashboard</a></span> » 
            <span><?php echo $page_title; ?></span>
        </div>
        <div class="align-items-center">
            <div>
                <h1><?php echo $page_title; ?></h1>
                <p>Discover currently active requests of shipment</p>
            </div>
        </div>
    </section>

<div class="container main-wrap">

        <section id="active_requests">

            <div id="target-content">loading...</div>

            <div class="clearfix">
                <ul class="pagination"> <?php include 'include/active_requests/pagination.php'; ?> </ul>
            </div>     

        </section>

</div> <!-- container -->

    


    <script src="/vendor/bootstrap-datetimepicker-master/bootstrap-datetimepicker.min.js"></script>
    <script src="/supplier/js/active.js"></script>


<?php require_once $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>

