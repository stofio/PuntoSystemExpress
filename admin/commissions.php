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

    <div class="row def-commissions mt-3">
        <h2 class="mb-5">Default commission</h2>

        <?php include_once 'include/commissions/get_default_commissions.php'; ?>
        <form class="def_comm_form" enctype="multipart/form-data" autocomplete="off">
            <div class="commissions-box">
                <div class="c-values">
                    <label class="me-5"> Min Commission = 
                        <input type="text" name="min_commission" class="only-numb" placeholder="I.e. 300" required value="<?php echo $minComm; ?>" /> €
                    </label>
                    <label class="me-5"> MOL =  
                        <input type="text" name="mol_perc" class="only-numb" placeholder="I.e. 30" required value="<?php echo $molPerc; ?>"/> %
                    </label>
                    <label class="me-5"> Margin =  
                        <input type="text" name="margin" class="only-numb" placeholder="I.e. 1500" required value="<?php echo $margin; ?>"/> €
                    </label>
                </div>
                <button type="submit">Save</button>
            </div>
            <p class="mt-4">If supplier offer is > <?php echo $margin; ?>€ always apply <?php echo $molPerc; ?>%.</p>
            <p>If supplier offer is < <?php echo $margin; ?>€ apply <?php echo $minComm; ?>€ or <?php echo $molPerc; ?>% if bigger.</p>
        </form>

    </div>


    <div class="row user-commissions">
        <h2 class="mb-5">Users commissions</h2>

        <?php include_once 'include/commissions/get_users_commissions.php'; ?>

    </div>

</div>


<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  

<script src="/admin/js/commissions.js"></script>