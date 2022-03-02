<?php $page_title = 'Shipped'; ?>
<?php require_once 'include/header.php'; ?>


    <section class="text-center hero-section">
        <div class="breadcrumbs container">
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

    <div class="container main-wrap">

        <section id="supp_offers_list">

            <div id="target-content">loading...</div>
    
            <div class="clearfix">
                <ul class="pagination"> <?php include 'include/shipped_requests/pagination.php'; ?> </ul>
            </div>

        </section>

    </div>

    
    <script src="/supplier/js/shipped.js"></script>


    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>