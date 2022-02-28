<?php $page_title = 'Archived'; ?>
<?php require_once 'include/header.php'; ?>
 

<section class="text-center hero-section">
        <div class="breadcrumbs container">
            <span><a href="/client">Client dashboard</a></span> » 
            <span><?php echo $page_title; ?></span>
        </div>
        <div class="row align-items-center">
            <div>
                <h1><?php echo $page_title; ?></h1>
                <p>Here are all your archived requests</p>
            </div>
        </div>
    </section>

<div class="container main-wrap">

    <!--    
         archived requests
    -->
    <section id="my_shipped_request">

        <div id="target-content">loading...</div>

        <div class="clearfix">
            <ul class="pagination"> <?php include 'include/archived_requests/pagination.php'; ?> </ul>
        </div>    

    </section>


    
</div> <!-- container -->
    
<script src="/client/js/archived.js"></script>


<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  