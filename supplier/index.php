<?php $page_title = 'Express'; ?>
<?php require_once 'include/header.php'; ?>

<div class="container mt-5">

    <h1 style="text-align: center;">Supplier dashboard</h1>

    <div class="dashboard-box mt-5">

        <div class="row">
            <div class="col-md-8">
                <a href="/supplier/active">
                    <span>Active Requests</span>
                    Discover and make an offer to active shipping requests
                </a>
            </div>
            <div class="col-md-4">
                <a href="/supplier/offers">
                    <span>My Offers</span>
                    See your active offers and processing one
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <a href="/supplier/shipped">
                    <span>Archive</span>
                    See your archived/completed requests
                </a>
            </div>
            <div class="col-md-4">
                <a href="/supplier/account">
                    <span>My Account</span>
                    Edit your profile info
                </a>
            </div>
            <div class="col-md-4">
                <a href="/logout"><span>Logout</span></a>
            </div>
        </div>

    </div>

</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>