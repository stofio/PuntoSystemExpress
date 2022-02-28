<?php $page_title = 'Waiting Approval'; ?>
<?php require_once 'include/header.php'; ?>


 

<section class="text-center hero-section"> 
    <div class="breadcrumbs container">
        <span><a href="/client">Admin</a></span> » 
        <span><?php echo $page_title; ?></span>
    </div>
    <div class="row align-items-center">
        <div>
            <h1><?php echo $page_title; ?></h1>
            <p>Approve requests waiting for shipment</p>
        </div>
    </div>
</section>

<div id="toapprove_requests" class="container">


    <div id="target-content">loading...</div>

    <div class="clearfix">
        <ul class="pagination"> <?php include 'include/waiting_approval/pagination.php'; ?> </ul>
    </div>


</div>



<script src="/admin/js/waiting_approval.js"></script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  