<?php $page_title = 'My Account'; ?>
<?php require_once 'include/header.php'; ?>

<div class="container main-wrap">

    <section class="text-center hero-section">
        <div class="breadcrumbs">
            <span><a href="/supplier">Client dashboard</a></span> » 
            <span><?php echo $page_title; ?></span>
        </div>
        <div class="row align-items-center">
            <div>
                <h1><?php echo $page_title; ?></h1>
                <p>View and edit your account details</p>
            </div>
        </div>
    </section>


    <section id="my_account_client">

        <form id="my_account_client_form">
            <div class="my-account-client-container row">
                <div class="col-md-6">
                    <label>Full Name<br>
                        <input type="text" name="full_name" placeholder="Full Name" required/>
                    </label>
                    <label>Company Name<br>
                        <input type="text" name="company_name" placeholder="Company Name" required/>
                    </label>
                    <label>Default Loading place<br>
                        <input type="text" name="def_load_place" placeholder="Default Loading place" required/>
                    </label>
                </div>
                <div class="col-md-6">
                    <label>Phone<br>
                        <input type="text" name="phone" placeholder="Phone" required/>
                    </label>
                    <label>Email<br>
                        <input type="text" name="company_name" placeholder="Email" required/>
                    </label>
                    <label>Default Delivery place<br>
                        <input type="text" name="def_deliv_place" placeholder="Default Delivery place" required/>
                    </label>
                </div>
                <div class="col-md-12">
                    <button type="submit">Save Data</button>
                </div>
            </div>
        </form>
    </section>

</div> <!-- container -->


<script src="/client/js/my-requests.js"></script>


<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  