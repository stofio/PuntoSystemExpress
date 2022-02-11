<?php $page_title = 'Shipped'; ?>
<?php require_once 'include/header.php'; ?>

<div class="container main-wrap">

 
    <section class="text-center hero-section">
        <div class="breadcrumbs">
            <span><a href="/client">Client dashboard</a></span> » 
            <span><?php echo $page_title; ?></span>
        </div>
        <div class="row align-items-center">
            <div>
                <h1><?php echo $page_title; ?></h1>
                <p>Discover your shipped requests</p>
            </div>
        </div>
    </section>

    <section id="my_shipped_request">

        <div id="target-content">loading...</div>

        <div class="clearfix">
            <ul class="pagination"> <?php include 'include/shipped_requests/pagination.php'; ?> </ul>
        </div>    

    </section>


    
</div> <!-- container -->
    
<script src="/client/js/shipped.js"></script>


<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  