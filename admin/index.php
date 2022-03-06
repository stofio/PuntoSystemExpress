<?php $page_title = 'Admin'; ?>
<?php require_once 'include/header.php'; ?>

<div class="container pt-5">

    <h1 style="text-align: center;">Admin dashboard</h1>

    <div class="dashboard-box mt-5">

        <div class="row">
            <div class="col-md-6">
                <a href="/admin/waiting-approval">
                    <span>Waiting approval</span>
                    Approve requests waiting for shipment
                </a>
            </div>
            <div class="col-md-6">
                <a href="/admin/manual">
                    <span>Manual Requests</span>
                    View requests completed manually
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <a href="/admin/archive">
                    <span>Archive</span>
                    View archived or processed requests
                </a>
            </div>
            <div class="col-md-4">
                <a href="/admin/account">
                    <span>Commissions</span>
                    Edit commissions by default or by user
                </a>
            </div>
            <div class="col-md-4">
                <a href="/logout"><span>Logout</span></a>
            </div>
        </div>

    </div>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/include/footer.php'; ?>  