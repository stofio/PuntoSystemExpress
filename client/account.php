<?php $page_title = 'My Account'; ?>
<?php require_once 'include/header.php'; ?>

<?php 
require_once 'include/account/get_account_data.php'; 
$a = $account_data;
?>

 

    <section class="text-center hero-section">
        <div class="container">
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
        </div>
    </section>


    <section class="my_account">

        <form id="my_account_client_form" action="include/account/save_account_data.php" method="post">
            <div class="my-account-client-container">
                <div class="row">
                    <div class="col-md-6">
                        <label>Name<br>
                            <input type="text" value="<?php echo $a['name'] ?>" name="name" placeholder="Name" required/>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label>Surname<br>
                            <input type="text" value="<?php echo $a['surname'] ?>" name="surname" placeholder="Surname" required/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Contact email <small>(if none, login email will be used)</small><br>
                            <input type="text" value="<?php echo $a['contact_email'] ?>" name="contact_email" placeholder="Contact email"/>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label>Login email<br>
                            <input type="text" value="<?php echo $a['email'] ?>" name="email" placeholder="Login email" required/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Company Name<br>
                            <input type="text" value="<?php echo $a['company_name'] ?>" name="company_name" placeholder="Company Name"/>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label>Phone<br>
                            <input type="text" value="<?php echo $a['phone'] ?>" name="phone" placeholder="Phone"/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Default Loading place (Exact Address)<br>
                            <input type="text" value="<?php echo $a['def_loading_place'] ?>" name="def_load_place" placeholder="Default Loading place"/>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label>Default Delivery place (Exact Address)<br>
                            <input type="text" value="<?php echo $a['def_disch_place'] ?>" name="def_deliv_place" placeholder="Default Delivery place"/>
                        </label>
                    </div>
                </div>
                <div class="col-md-12">
                    <button type="submit">Save Data</button>
                </div>
            </div>
        </form>

    </section>


<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  