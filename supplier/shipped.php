<?php $page_title = 'Shipped'; ?>
<?php require_once 'include/header.php'; ?>


    <section class="text-center hero-section">
        <div class="breadcrumbs">
            <span><a href="/supplier">Supplier dashboard</a></span> » 
            <span><?php echo $page_title; ?></span>
        </div>
        <div class="row align-items-center">
            <div>
                <h1><?php echo $page_title; ?></h1>
                <p>Discover your shipments</p>
            </div>
        </div>
    </section>

    <section id="supp_offers_list">

        <div id="target-content">loading...</div>

        <div class="clearfix">
            <ul class="pagination"> <?php include 'include/shipped_requests/pagination.php'; ?> </ul>
        </div>

    </section>

    
    <script src="/supplier/js/shipped.js"></script>


<?php require_once 'include/footer.php'; ?>