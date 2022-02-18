<?php $page_title = 'Commissions'; ?>
<?php require_once 'include/header.php'; ?>


<section class="text-center hero-section"> 
    <div class="breadcrumbs container">
        <span><a href="/client">Admin</a></span> » 
        <span><?php echo $page_title; ?></span>
    </div>
    <div class="row align-items-center">
        <div>
            <h1><?php echo $page_title; ?></h1>
            <p>Edit commissions by default or by user</p>
        </div>
    </div>
</section>

<div id="users" class="container">

    <div class="row def-commissions mt-5">
        <h2>Default commission</h2>
        <?php include_once 'include/commissions/get_default_commissions.php'; ?>
    </div>


    <div class="row def-commissions">
        <h2>Users commissions</h2>
        <?php include_once 'include/commissions/get_users_commissions.php'; ?>
    </div>

</div>


<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  